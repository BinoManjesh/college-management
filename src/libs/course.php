<?php

function getCourse($course_id) {
    $sql = '
        SELECT Course_id, Course_name, Fac_id, Credits, First_name as Fac_fname, Last_name as Fac_lname, user.Dept_name
        FROM course
        INNER JOIN user
        ON user.User_id = course.Fac_id;
        WHERE Course_id = :course_id
    ';
    return make_query($sql, [':course_id' => $course_id], true, true);
}
function getassignment($course_id) {
    $sql = '
        SELECT Assn_name, Due_time
        FROM assignments
        WHERE Course_id = :course_id
    ';
    return make_query($sql, [':course_id' => $course_id], true,false);
}
function getMaterial($course_id) {
    $sql = '
        SELECT *
        FROM coursematerial
        WHERE Course_id = :course_id
    ';
    return make_query($sql, [':course_id' => $course_id], true);
}
function getattendance($course_id)
{
    $sql = '
        SELECT *
        FROM attendance
        WHERE Course_id = :course_id
    ';
    return make_query($sql, [':course_id' => $course_id], true);
}
$students = [
    ['User_id'=>0, 'Off_id'=>'BT21CSE000'],
    ['User_id'=>1, 'Off_id'=>'BT21CSE001'],
    ['User_id'=>2, 'Off_id'=>'BT21CSE002'],
    ['User_id'=>3, 'Off_id'=>'BT21CSE003'],
    ['User_id'=>4, 'Off_id'=>'BT21CSE004'],
    ['User_id'=>5, 'Off_id'=>'BT21CSE005']
];
$course_id = $_GET['course_id'];
$course = getCourse($course_id);

if (is_post_request()) {
    switch($_POST['action']) {
        case 'upload_material':
            $mat_name = $_FILES['course-material']['name'];
            if ($mat_name) {
                $file = upload_file('course-material');
                $sql = '
                    INSERT INTO coursematerial(Course_id, Mat_file, Mat_name)
                    VALUES (:course_id, :mat_file, :mat_name);
                ';
                make_query($sql, [':course_id'=>$course_id, ':mat_file'=>$file, ':mat_name'=> $mat_name]);
            }
            break;
        case 'endcourse':
            $AA=(int)$_POST['startingmarksAA'];
            $AB=(int)$_POST['startingmarksAB'];
            $BB=(int)$_POST['startingmarksBB'];
            $BC=(int)$_POST['startingmarksBC'];
            $CC=(int)$_POST['startingmarksCC'];
            $CD=(int)$_POST['startingmarksCD'];
            $DD=(int)$_POST['startingmarksDD'];
            $FF=(int)0;
            $sql1 = '
            UPDATE stucourse
            SET Grade = CASE 
            WHEN Marks_s1+Marks_s2+Marks_endsem>= :AA THEN \'AA\'
            WHEN Marks_s1+Marks_s2+Marks_endsem>= :AB THEN \'AB\'
            WHEN Marks_s1+Marks_s2+Marks_endsem>= :BB THEN \'BB\'
            WHEN Marks_s1+Marks_s2+Marks_endsem>= :BC THEN \'BC\'
            WHEN Marks_s1+Marks_s2+Marks_endsem>= :CC THEN \'CC\'
            WHEN Marks_s1+Marks_s2+Marks_endsem>= :CD THEN \'CD\'
            WHEN Marks_s1+Marks_s2+Marks_endsem>= :DD THEN \'DD\'
            ELSE \'FF\'
            END;
            WHERE Course_id = :course_id
            ';
            make_query($sql1, [':AA'=>$AA,':AB'=>$AB,':BB'=>$BB,':BC'=>$BC,':CC'=>$CC,':CD'=>$CD,':DD'=>$DD, ':course_id'=>$course_id]);
            break;
        case 'newassignment':
            $assignmentname=$_POST['newassignmenttopic'];
            $assignmentdate=$_POST['newassignmentdate'];
            if($assignmentname && $assignmentdate)
            {
                $sql = '
                        INSERT INTO assignments(Assn_name, Due_time, Course_id)
                        VALUES (:asign_name, :asign_date, :course_id);
                    ';
                make_query($sql, [':course_id'=>$course_id, ':asign_name'=>$assignmentname, ':asign_date'=> $assignmentdate]);
            }
            break;
        case 'newattendance1':
            $attendancedate=$_POST['newattendance'];
            if($attendancedate)
            {
                $sql = '
                        INSERT INTO attendance(Stu_id, Date, Course_id)
                        SELECT Stu_id, :date as Date, Course_id
                        From stucourse
                        Where Course_id= :course_id;
                    ';
                make_query($sql,[':course_id'=>$course_id,':date'=>$attendancedate]);
            }
            break;
    }
}

$material = getMaterial($course_id);
$assignments = getassignment($course_id);
$attendance = getattendance($course_id);
function AttendanceRow($student) {
    $id = $student['User_id'];
    echo <<<END
        <tr>
            <td>{$student['Off_id']}</td>
            <td style="display: grid;grid-auto-flow:column;">
                <input type="radio" id="present-$id" name="attendance-$id" value="present">
                <label for="present-$id" style="text-align: left;">Present</label>
                <input type="radio" id="absent-$id" name="attendance-$id" value="absent">
                <label for="absent-$id" style="text-align: left;">Absent</label>
            </td>
        </tr>
    END;
}

function GradeRow($submission) {
    echo <<<END
        <tr>
            <td>Student Id
                <a href='uploaded_files/{$submission['Sub_file']}'><i class="fa fa-download"></i></a>
            </td>
            <td> Date </td>
            <td>
                <input type="number" id="marks-{$submission['Stu_id']}" name="marks-{$submission['Stu_id']}" min="0" max="100">
            </td>
        </tr>
    END;
}