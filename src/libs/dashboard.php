<?php
$notifications = [
    ['course_name' => 'c1', 'content'=>'blah blah blah'],
    ['course_name' => 'c2', 'content'=>'blah blah blah'],
    ['course_name' => 'c3', 'content'=>'blah blah blah']
];
function calculateCGPA() {
    $stu_id = $_SESSION['user_data']['User_id'];
    $sql='
            SELECT stucourse.Grade, course.Credits
            FROM stucourse inner join course on stucourse.Course_id=course.Course_id
            WHERE stucourse.Stu_id= :stu_id; 
            ';
    $subject1=make_query($sql,[":stu_id" => $stu_id], true);
    
    $gradePoints = [
        'AA' => 10.0,
        'AB' => 9.0,
        'BB' => 8.0,
        'BC' => 7.0,
        'CC' => 6.0,
        'CD' => 5.0,
        'DD' => 4.0,
        'FF' => 0.0,
    ];

    $totalCreditPoints = 0;
    $totalGradePoints = 0;
    // var_dump($subject1);
    foreach($subject1 as $subject) {
     
        $grades = $subject['Grade'];
        $subjectCredits = $subject['Credits']; 
        $totalGradePoints += isset($gradePoints[$grades]) ? $gradePoints[$grades]*$subjectCredits : 0;
        $totalCreditPoints += isset($gradePoints[$grades]) ? $subjectCredits : 0;
    }
    // $num += $gradePoint * $subjectCredits;
    $cgpa=NULL;
    if($totalCreditPoints!==0)
    $cgpa = $totalGradePoints/$totalCreditPoints;
    return $cgpa;
}
function getuser($user_id)
{
    $sql='
    SELECT *
    FROM user
    Where User_id= :user_id;
    ';
    return make_query($sql,[':user_id'=>$user_id],true,true);
}
function getcoursesstudent($user_id)
{
    $sql = '
    Select stucourse.Course_id as course_id, course.Course_name as course_name, CONCAT(user.First_name,\' \',user.Last_name) as faculty_name
    From stucourse inner join course on stucourse.Course_id=course.Course_id inner join user on course.Fac_id=user.User_id
    where stucourse.Stu_id= :user_id;
    ';
    return make_query($sql,[':user_id'=>$user_id],true);
}
function getcoursesfaculty($user_id)
{
    $sql = '
    Select course.Course_id as course_id, course.Course_name as course_name, CONCAT(user.First_name,\' \',user.Last_name) as faculty_name
    From course inner join user on course.Fac_id=user.User_id
    where user.User_id= :user_id;
    ';
    return make_query($sql,[':user_id'=>$user_id],true);
}
function getcoursesenroll($user_id)
{
    $sql = '
    Select course.Course_id as course_id,
    CASE when course.Course_id in (
        SELECT Course_id
        FROM stucourse
        WHERE Stu_id = :user_id
    ) then 1
    else 0
    END AS enrolled,course.Course_name as course_name,course.Dept_name as department_name, CONCAT(user.First_name,\' \',user.Last_name) as faculty_name
    from course inner join user on course.Fac_id=user.User_id
    ';
    return make_query($sql,[':user_id'=>$user_id],true);
}
function getpendingassignments($user_id)
{
    if($_SESSION['user_data']['type']==='student')
    $sql='Select assignments.Assn_name as assn_name, course.Course_name as course_name, assignments.Due_time as due_time
    from assignments inner join course on assignments.Course_id=course.Course_id
    where assignments.Course_id in (
        Select stucourse.Course_id as course_id
    From stucourse inner join course on stucourse.Course_id=course.Course_id inner join user on course.Fac_id=user.User_id
    where stucourse.Stu_id= :user_id
    )
     and assignments.Assn_id not in (select Assn_id from submission where Stu_id= :user_id);
    ';
    else if($_SESSION['user_data']['type']==='faculty')
    $sql='Select assignments.Assn_name as assn_name, course.Course_name as course_name, assignments.Due_time as due_time
    from assignments inner join course on assignments.Course_id=course.Course_id
    where assignments.Course_id in (
        Select course.Course_id as course_id
        From course inner join user on course.Fac_id=user.User_id
        where user.User_id= :user_id
    )
     and assignments.Assn_id not in (select Assn_id from submission where Stu_id= :user_id);
    ';
    return make_query($sql,[':user_id'=>$user_id],true);
}
$user_id = $_SESSION['user_data']['User_id'];
$user = getuser($user_id);
$showenroll=NULL;
if (is_post_request()) {
    if ($_POST['action'] === 'enroll') {
        $enroll_courses = getcoursesenroll($user_id);
        updateEnrollment($_SESSION['user_data']['User_id']);
        $showenroll=NULL;
    }
    else if($_POST['action']==='enrollclose')
    {
        $showenroll=NULL;
    }
    else if($_POST['action']==='addcourse')
    {
        $sql='
        INSERT INTO course(Course_name,Dept_name,Fac_id,Credits)
        Values (:course_name, :dept_name, :fac_id, :credits)
        ';
        if($_POST['coursename'] && $_POST['Departmentname'] && $_POST['FacultyIdname'] && $_POST['Creditsname'])
        {
            make_query($sql,[':course_name'=>$_POST['coursename'],':dept_name'=>$_POST['Departmentname'],':fac_id'=>$_POST['FacultyIdname'],':credits'=>$_POST['Creditsname']]);
            $enroll_courses = getcoursesenroll($user_id);
            $showenroll=1;
        }
    }
    else if($_POST['action']==='enrolloraddcourses')
    {
        $enroll_courses = getcoursesenroll($user_id);
        $showenroll=1;
    }
}
function updateEnrollment($stu_id) {
    global $enroll_courses;
    // var_dump($choice);
    $add_course = '
        INSERT INTO stucourse(Stu_id, Course_id)
        VALUES (:Stu_id, :Course_id)
    ';
    $remove_course = '
        DELETE FROM stucourse
        WHERE Stu_id = :Stu_id AND Course_id = :Course_id
    ';
    foreach ($enroll_courses as $course) {
        $current = $course['enrolled'];
        $new = isset($_POST['course'.$course['course_id']]);
        // var_dump($current);
        // var_dump($new);
        if ($new != $current) {
            $data = [':Stu_id' => $stu_id, ':Course_id' => $course['course_id']];
            if ($new) {
                make_query($add_course, $data);
            } else {
                make_query($remove_course, $data);
            }
        }
    }
    $enroll_courses = getcoursesenroll($stu_id);
}
if($user['type']==='faculty'){
    $user_courses = getcoursesfaculty($user_id);
}
else if($user['type']==='student' || 1){
    $user_courses = getcoursesstudent($user_id);
}
$assn_query = getpendingassignments($user_id);
// var_dump($user_courses);
