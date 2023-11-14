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

function getAssignmentsForFaculty($course_id) {
    $sql = '
        SELECT Assn_name, Due_time, Assn_id
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
    return make_query($sql, [':assn_id' => $assn_id], true);
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

function getAssignmentsForStudent($stu_id, $course_id) {
    $sql = '
        SELECT Course_id, assignments.Assn_id, Assn_name, Due_time, Grade, submission.Assn_id as Sub_exists
        FROM assignments
        LEFT JOIN submission
        ON assignments.Assn_id = submission.Assn_id AND Stu_id = :stu_id
        WHERE assignments.Course_id = :course_id
    ';
    return make_query($sql, [':stu_id' => $stu_id, ':course_id' => $course_id], true);
}

function getStudentAttendance($stu_id, $course_id) {
    $sql = '
        SELECT Date, Present
        FROM attendance
        WHERE Stu_id = :stu_id
    ';
    return make_query($sql, [':stu_id' => $stu_id], true);
}

$user_id = $_SESSION['user_data']['User_id'];
$user_type = $_SESSION['user_data']['type'];
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
                update_notification("Sutdy Material Uploaded - ".$mat_name);
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
            END
            WHERE Course_id = :course_id;
            ';
            make_query($sql1, [':AA'=>$AA,':AB'=>$AB,':BB'=>$BB,':BC'=>$BC,':CC'=>$CC,':CD'=>$CD,':DD'=>$DD, ':course_id'=>$course_id]);
            $sql1='
            UPDATE course
            SET Open=0
            WHERE Course_id = :course_id;
            ';
            make_query($sql1,[':course_id'=>$course_id]);
            update_notification("Course Ended");
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
                update_notification("New Assignment Added - ".$assignmentname);
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
                update_notification("New Attendance Added - ".$attendancedate);
            }
            break;
        case 'grade_assignment':
            $assn_id = $_POST['assn_id'];
            $grade_assn = getAssignment($assn_id);
            $assn_submissions = getSubmissions($assn_id);
            break;
        case 'confirm_grade_assignment':
            echo "HMM";
            $assn_id = $_POST['assn_id'];
            $get_students = '
                SELECT Stu_id
                FROM submission
                JOIN user
                ON User_id = Stu_id
                WHERE Assn_id = :assn_id
            ';
            $stu_ids = make_query($get_students, [':assn_id' => $assn_id], true);
            var_dump($stu_ids);
            $update_assn_grade = '
                UPDATE submission
                SET Grade = :grade
                WHERE Stu_id = :stu_id AND Assn_id = :assn_id
            ';
            foreach ($stu_ids as $stu) {
                $id = $stu['Stu_id'];
                $grade = $_POST[$id];
                make_query($update_assn_grade, [':grade' => $grade,
                    ':stu_id' => $id, ':assn_id' => $assn_id]);
            }
            update_notification("Assignment - ".$grade_assn['Assn_name']." Graded");
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
            update_notification("Attendance of date - ".$date." Edited");
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
            update_notification("Marks of - ".$marks_column." Edited");
            break;
        case 'assn_submission':
            $assn_id=$_POST['assn_id'];
            $assgnfilename = $_FILES['submitassign'.$assn_id]['name'];
            if($assgnfilename)
            {
                $file = upload_file('submitassign'.$assn_id);
                $sql = '
                        INSERT INTO submission(Assn_id, Stu_id, Sub_file)
                        VALUES (:assgn_id, :stu_id, :sub_file);
                    ';
                make_query($sql,[':assgn_id'=>$assn_id,':stu_id'=>$user_id,':sub_file'=>$file]);
            }
            break;
    }
}

$material = getMaterial($course_id);
echo $user_type === 'student';
switch($user_type) {
    case 'faculty':
        $assignments = getAssignmentsForFaculty($course_id);
        $attendance = getAttendanceDates($course_id);
        break;
    case 'student':
        $assignments = getAssignmentsForStudent($user_id, $course_id);
        $attendance = getStudentAttendance($user_id, $course_id);
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

// this updates notification in stunotification and notification table.
function update_notification(string $message)
{
    global $course_id;
    $sql='
        Insert into notification(Course_id,Announcement)
        values(:course_id,:message);
    ';

    make_query($sql,[":course_id"=>$course_id,":message"=>$message],false);

    $sql='
        Select Not_id from notification ORDER BY Not_id DESC LIMIT 1;
    ';

    $not_id=make_query($sql,[],true)[0]["Not_id"];

    $sql='
        Insert into stunotification(Not_id,Stu_id)
        Select :not_id as Not_id, Stu_id from stucourse
        where course_id=:course_id;
    ';

    make_query($sql,[":not_id"=>$not_id,":course_id"=>$course_id],false);
}
$gradecourse=make_query('Select Grade from stucourse where Course_id=:course_id and Stu_id=:stu_id',[':course_id'=>$course['Course_id'],':stu_id'=>$_SESSION['user_data']['User_id']],true,true);