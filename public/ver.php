<?php
require_once __DIR__ . '/../src/bootstrap.php';
// require_once __DIR__ . '/../src/libs/dashboard.php';
// var_dump(fetch_user_data(1));
// var_dump(get_course(1));
// var_dump(pend_task(1));
// echo "Hello";
// echo (get_marks(1,1)[0]);

update_notification(1,'DBMS attendance updated.');

function get_course($user_id)
{   
    $sql='
        SELECT Course_id
        From stucourse
        Where Stu_id= :user_id
    ';

    return make_query($sql, [":user_id" => $user_id], true,false);

}

// function pend_task ($stu_id)
// {
//     $sql='
//         SELECT Assn_id
//         from assignments
//         where Course_id in (Select Course_id 
//         From stucourse
//         where Stu_id= :stu_id)
//         and
//         Assn_id NOT in (Select Assn_id
//         from submission
//         where Stu_id = :stu_id)
//     ';

//     return make_query($sql, [":stu_id" => $stu_id,":stu_id" => $stu_id], true);
       
// }


// next bunch of functions is to get course page details
function course_info($course_id)
{
    $sql='
        Select Course_name, Dept_name, First_name, Last_name
        From course,user 
        Where Fac_id=User_id and Course_id=:course_id
    '; //return fac_id instead of fac name, now call get_faculty() to get name.
    return make_query($sql, [":course_id" => $course_id], true);
}

function get_faculty($fac_id)
{
    $sql='
        Select First_name,
        Last_name
        from user 
        Where User_id = :fac_id
    ';

    return make_query($sql, [":fac_id" => $fac_id], true);
}


// returns grade of a course of a stu

// function getGradesFromDatabase($stu_id,$course_id)
// {
//     $sql='
//         Select Grade
//         From stucourse
//         where Stu_id= :stu_id and Course_id= :course_id
//     ';
//     return make_query($sql, [":stu_id" => $stu_id,":course_id" => $course_id], true);
// }

//return credits of a course

function getCreditFromDatabase($course_id)
{
    $sql='
        Select Credits
        from course
        where Course_id= :course_id
    ';
    return make_query($sql, [":course_id" => $course_id], true);
}

//return s1marks
// function get_marks($stu_id,$course_id)
// {
//     $sql='
//         Select Marks_s1,Marks_s2,Marks_endsem
//         From stucourse
//         Where Course_id= :course_id and Stu_id=:stu_id;
//     ';
//     return make_query($sql, [":course_id" => $course_id,":stu_id" => $stu_id], true);
// }

function getS2MarksFromDB($stu_id,$course_id)
{
    echo $course_id." ".$stu_id;
    $sql='
        Select *
        From stucourse
        Where Course_id= :course_id and Stu_id=:stu_id;
    ';
    return make_query($sql, [], true);
}

function getEndSemMarksFromDB($stu_id,$course_id)
{
    $sql='
        Select Marks_endsem
        from stucourse
        where Stu_id=:stu_id and Course_id= :course_id
    ';
    return make_query($sql, [":stu_id" => $stu_id,":course_id" => $course_id], true);
}


//marks 

