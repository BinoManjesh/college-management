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

function getAssignment($assn_id) {
    $sql = '
        SELECT *
        FROM assignments
        WHERE Assn_id = :assn_id
    ';
    return make_query($sql, [':assn_id' => $assn_id], true, true);
}

function getAssignments($course_id) {
    $sql = '
        SELECT Assn_name, Due_date, Assn_id
        FROM assignments
        WHERE Course_id = :course_id
    ';
    return make_query($sql, [':course_id' => $course_id], true,false);
}

function getSubmissions($assn_id) {
    $sql = '
        SELECT *
        FROM submission
        JOIN user
        ON User_id = Stu_id
        WHERE Assn_id = :assn_id
    ';
    return make_query($sql, [':assn_id' => $assn_id]);
}

function getMaterial($course_id) {
    $sql = '
        SELECT *
        FROM coursematerial
        WHERE Course_id = :course_id
    ';
    return make_query($sql, [':course_id' => $course_id], true);
}

function getAttendanceDates($course_id)
{
    $sql = '
        SELECT DISTINCT(Date) as Date
        FROM attendance
        WHERE Course_id = :course_id
    ';
    return make_query($sql, [':course_id' => $course_id], true);
}

function getAttendanceForDate($date, $course_id) {
    $sql = '
        SELECT Stu_id, Present, Off_id
        FROM attendance
        INNER JOIN user
        ON User_id = Stu_id
        WHERE Date = :date AND Course_id = :course_id
    ';
    return make_query($sql, [':date' => $date, ':course_id' => $course_id], true);
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
                        INSERT INTO assignments(Assn_name, Due_date, Course_id)
                        VALUES (:asign_name, :asign_date, :course_id);
                    ';
                make_query($sql, [':course_id'=>$course_id, ':asign_name'=>$assignmentname, ':asign_date'=> $assignmentdate]);
            }
            break;
        case 'new_attendance':
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
        case 'grade_assignment':
            $assn_id = $_POST['assn_id'];
            $grade_assn = getAssignment($assn_id);
            $assn_submissions = getSubmissions($assn_id);
            break;
        case 'edit_attendance':
            $attd_date = $_POST['date'];
            $attd_students = getAttendanceForDate($attd_date, $course_id);
            break;
        case 'confirm_attendance':
            $date = $_POST['date'];
            $attd_students = getAttendanceForDate($date, $course_id);
            $sql = '
                UPDATE attendance
                SET Present = :present
                WHERE Stu_id = :stu_id AND Date = :date AND Course_id = :course_id
            ';
            foreach ($attd_students as $student) {
                $stu_id = $student['Stu_id'];
                $present = $_POST["attendance-$stu_id"];
                make_query($sql, [':present' => $present, ':stu_id' => $stu_id,
                    ':date' => $date, ':course_id' => $course_id]);
            }
            break;
        case 'edit_marks':
            $marks_type = $_POST['type'];
            $marks_column = $_POST['column'];
            $sql = "
                SELECT Off_id, User_id, $marks_column
                FROM user
                INNER JOIN stucourse
                ON User_id = Stu_id AND Course_id = :course_id
            ";
            $stu_marks = make_query($sql, [':course_id' => $course_id], true);
            break;
        case 'confirm_marks':
            echo "CONFIRM";
            $marks_column = $_POST['column'];
            $get_students = '
                SELECT Stu_id
                FROM stucourse
                WHERE Course_id = :course_id
            ';
            $students = make_query($get_students, [':course_id' => $course_id], true);
            $update_marks = "
                UPDATE stucourse
                SET $marks_column = :marks
                WHERE Stu_id = :stu_id AND Course_id = :course_id
            ";
            foreach ($students as $stu) {
                $stu_id = $stu['Stu_id'];
                $marks = $_POST[$stu_id];
                make_query($update_marks, [':marks'=> $marks,
                    ':stu_id' => $stu_id, ':course_id' => $course_id]);
            }
            break;
    }
}

$material = getMaterial($course_id);
$assignments = getAssignments($course_id);
$attendance = getAttendanceDates($course_id);

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