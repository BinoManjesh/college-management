<?php
$assn_query = [
    ['assn_name'=>'A1', 'course_name'=>'C1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A2', 'course_name'=>'C1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A3', 'course_name'=>'C1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A4', 'course_name'=>'C1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A5', 'course_name'=>'C1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A6', 'course_name'=>'C1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A7', 'course_name'=>'C1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A8', 'course_name'=>'C1', 'due_date'=>'1/2/3'],
];
$notifications = [
    ['course_name' => 'c1', 'content'=>'blah blah blah'],
    ['course_name' => 'c2', 'content'=>'blah blah blah'],
    ['course_name' => 'c3', 'content'=>'blah blah blah']
];
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
$user_id = $_SESSION['user_data']['User_id'];
$user = getuser($user_id);
$enroll_courses = getcoursesenroll($user_id);
// var_dump($enroll_courses);
if (is_post_request()) {
    if ($_POST['action'] === 'enroll') {
        // if (!isset($_POST['course'])) {
        //     $_POST['course'] = [];
        // }
        // var_dump($_POST);
        updateEnrollment($_SESSION['user_data']['User_id']);
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
        var_dump($current);
        var_dump($new);
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
if($user['type']==='student'){
    $user_courses = getcoursesstudent($user_id);
}
else if($user['type']==='faculty'){
    $user_courses = getcoursesfaculty($user_id);
}