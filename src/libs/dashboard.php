<?php
ensureLogin();

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
    foreach($subject1 as $subject) {
     
        $grades = $subject['Grade'];
        $subjectCredits = $subject['Credits']; 
        $totalGradePoints += isset($gradePoints[$grades]) ? $gradePoints[$grades]*$subjectCredits : 0;
        $totalCreditPoints += isset($gradePoints[$grades]) ? $subjectCredits : 0;
    }
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
function getcoursesHOD()
{
    $sql = '
    Select course.Course_id as course_id, course.Course_name as course_name, CONCAT(user.First_name,\' \',user.Last_name) as faculty_name
    From course inner join user on course.Fac_id=user.User_id
    where course.Dept_name= :dept_name;
    ';
    return make_query($sql,[':dept_name'=>$_SESSION['user_data']['Dept_name']],true);
}
function getcoursesadmin()
{
    $sql = '
    Select course.Course_id as course_id, course.Course_name as course_name, CONCAT(user.First_name,\' \',user.Last_name) as faculty_name
    From course inner join user on course.Fac_id=user.User_id
    ';
    return make_query($sql,[],true);
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
    where course.Open=1;
    ';
    return make_query($sql,[':user_id'=>$user_id],true);
}
function getpendingassignments($user_id)
{
    $sql='Select assignments.Assn_id as assn_id,assignments.Assn_name as assn_name, course.Course_name as course_name, assignments.Due_time as due_time
    from assignments inner join course on assignments.Course_id=course.Course_id
    where assignments.Course_id in (
        Select stucourse.Course_id as course_id
    From stucourse inner join course on stucourse.Course_id=course.Course_id inner join user on course.Fac_id=user.User_id
    where stucourse.Stu_id= :user_id
    )
     and assignments.Assn_id not in (select Assn_id from submission where Stu_id= :user_id);
    ';
    return make_query($sql,[':user_id'=>$user_id],true);
}
$user_id = $_SESSION['user_data']['User_id'];
$user = getuser($user_id);
$notifications = read_notification($user_id);
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
            $temp=make_query('SELECT User_id from user where Off_id=:fac_id',[':fac_id'=>$_POST['FacultyIdname']],true,true)['User_id'];
            make_query($sql,[':course_name'=>$_POST['coursename'],':dept_name'=>$_POST['Departmentname'],':fac_id'=>$temp,':credits'=>$_POST['Creditsname']]);
            $enroll_courses = getcoursesenroll($user_id);
            $showenroll=1;
        }
    }
    else if($_POST['action']==='enrolloraddcourses')
    {
        $enroll_courses = getcoursesenroll($user_id);
        $showenroll=1;
    }
    else if($_POST['action']==='submitassgndash')
    {
        $assgnid=$_POST['assgn_id'];
        $assgnfilename = $_FILES['submitassign'.$assgnid]['name'];
        if($assgnfilename)
        {
            $file = upload_file('submitassign'.$assgnid);
            $sql = '
                    INSERT INTO submission(Assn_id, Stu_id, Sub_file)
                    VALUES (:assgn_id, :stu_id, :sub_file);
                ';
            make_query($sql,[':assgn_id'=>$assgnid,':stu_id'=>$user_id,':sub_file'=>$file]);
        }
    }
    else if($_POST['action']==='enrolluser')
    {
        $sql = '
        INSERT INTO user(Username,Password,First_name,Last_name,Off_id,Dept_name,Branch_name,type,Semester)
        values (:username,:pass,:fname,:lname,:offid,:deptname,:branchname,:type,:sem);
        ';
        make_query($sql,[':username'=>$_POST['Usernameregister'],':pass'=>$_POST['passwordregister'],':fname'=>$_POST['firstnameregister'],':lname'=>$_POST['lastnameregister'],':offid'=>$_POST['Officialidregister'],
        ':deptname'=>$_POST['departmentregister'],':branchname'=>$_POST['branchregister'],':type'=>$_POST['Typeregister'],':sem'=>$_POST['Semesterregister']]);
        if($_POST['Typeregister']==='HOD')
        {
            $temp=make_query('Select User_id from user ORDER BY User_id DESC LIMIT 1;',[],true,true);
            $sql = '
                UPDATE Department
                SET Head_id=:user_id
                Where Dept_name=:deptname;
                ';
            make_query($sql,[':deptname'=>$_POST['departmentregister'],':user_id'=>$temp['User_id']]);
        }
    }
    else if($_POST['action']==='deletenotification')
    {
        delete_notification($_POST['notificationdel']);
        $notifications = read_notification($user_id);
    }
    else if($_POST['action']==='adddepartment')
    {
        if($_POST['departmentaddname'])
        {
            make_query('INSERT INTO department(Dept_name)
            VALUES (:temp)',[':temp'=>$_POST['departmentaddname']]);
        }
    }
}
function updateEnrollment($stu_id) {
    global $enroll_courses;
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
else if($user['type']==='student'){
    $user_courses = getcoursesstudent($user_id);
}
else if($user['type']==='HOD'){
    $user_courses = getcoursesHOD();
}
else if($user['type']==='admin'){
    $user_courses = getcoursesadmin();
}
$assn_query = getpendingassignments($user_id);

// returns all the students data for dashboard.
function fetch_user_data ($userid){
    $sql='
        SELECT First_name,
        Last_name,
        Off_id,
        Dept_name,
        Branch_name,
        Semester
        From user 
        Where User_id = :user_id
    ';
    $result = make_query($sql, [":user_id" => $userid], true);

    return $result;
}

//returns all the courses in which the student has enrolled.
function get_stu_course($user_id)
{   
    $sql='
        SELECT Course_name 
        From stucourse
        Where Stu_id= :user_id
    ';

    return make_query($sql, [":user_id" => $user_id], true);
}

//return all marks and nottt grades
function get_marks($stu_id,$course_id)
{
    $sql='
        Select Marks_s1,Marks_s2,Marks_endsem
        From stucourse
        Where Course_id= :course_id and Stu_id=:stu_id;
    ';
    return make_query($sql, [":course_id" => $course_id,":stu_id" => $stu_id], true);
}

//returns a pending assignments of a student
function pend_task($stu_id)
{
    $sql='
        SELECT Assn_id
        from assignments
        where Course_id in (Select Course_id 
        From stucourse
        where Stu_id= :stu_id)
        and
        Assn_id NOT in (Select Assn_id
        from submission
        where Stu_id = :stu_id)
    ';

    return make_query($sql, [":stu_id" => $stu_id], true);       
}

// notification function is pending!!!!!!
function read_notification($stu_id)
{
    $sql='
        Select course.course_name, notification.Announcement as content,notification.not_id as not_id
        From stunotification, notification, course
        where stunotification.not_id = notification.not_id
        and stunotification.stu_id=:stu_id 
        and notification.course_id=course.course_id
        order by notification.not_id desc;
    ';
    
    return make_query($sql,[":stu_id"=>$stu_id],true);

}

//delete notification
function delete_notification($not_id)
{
    global $user_id;
    $sql='
        Delete from stunotification
        where stu_id=:stu_id and not_id=:not_id;
    ';
    make_query($sql,[":stu_id"=>$user_id,":not_id"=>$not_id]);
}