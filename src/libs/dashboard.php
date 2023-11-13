<?php

$user_courses = [
    ['course_id'=>0, 'course_name'=>'CName1', 'faculty_name'=>'fName'],
    ['course_id'=>1, 'course_name'=>'CName2', 'faculty_name'=>'fName'],
    ['course_id'=>2, 'course_name'=>'CName3', 'faculty_name'=>'fName'],
    ['course_id'=>3, 'course_name'=>'CName4', 'faculty_name'=>'fName'],
    ['course_id'=>4, 'course_name'=>'CName5', 'faculty_name'=>'fName'],
    ['course_id'=>5, 'course_name'=>'CName6', 'faculty_name'=>'fName'],
    ['course_id'=>6, 'course_name'=>'CName7', 'faculty_name'=>'fName'],
    ['course_id'=>7, 'course_name'=>'CName8', 'faculty_name'=>'fName'],
    ['course_id'=>8, 'course_name'=>'CName9', 'faculty_name'=>'fName'],
];
$assn_query = [
    ['assn_name'=>'A1', 'course_name'=>'C1', 'submitted'=>'1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A2', 'course_name'=>'C1', 'submitted'=>'0', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A3', 'course_name'=>'C1', 'submitted'=>'1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A4', 'course_name'=>'C1', 'submitted'=>'1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A5', 'course_name'=>'C1', 'submitted'=>'1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A6', 'course_name'=>'C1', 'submitted'=>'1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A7', 'course_name'=>'C1', 'submitted'=>'1', 'due_date'=>'1/2/3'],
    ['assn_name'=>'A8', 'course_name'=>'C1', 'submitted'=>'1', 'due_date'=>'1/2/3'],
];
$notifications = [
    ['course_name' => 'c1', 'content'=>'blah blah blah'],
    ['course_name' => 'c2', 'content'=>'blah blah blah'],
    ['course_name' => 'c3', 'content'=>'blah blah blah']
];
$enroll_courses = [
    ['course_id' => 0, 'enrolled' => 0, 'course_name' => 'c1', 'department_name'=>'D1', 'faculty_name'=>'F1'],
    ['course_id' => 1, 'enrolled' => 0, 'course_name' => 'c2', 'department_name'=>'D1', 'faculty_name'=>'F1'],
    ['course_id' => 2, 'enrolled' => 0, 'course_name' => 'c3', 'department_name'=>'D1', 'faculty_name'=>'F1'],
    ['course_id' => 3, 'enrolled' => 0, 'course_name' => 'c4', 'department_name'=>'D1', 'faculty_name'=>'F1'],
];

if (is_post_request()) {
    if ($_POST['action'] === 'enroll') {
        var_dump($_POST);
        if (!isset($_POST['course'])) {
            $_POST['course'] = [];
        }
        updateEnrollment($_SESSION['user_data']['User_id'], $enroll_courses, $_POST['course']);
    }
}

function updateEnrollment($stu_id, $enroll_courses, $choice) {
    $add_course = '
        INSERT INTO stucourse(Stu_id, Course_id)
        VALUES (:Stu_id, :Course_id)
    ';
    $remove_course = '
        DELET FROM stucourse
        WHERE Stu_id = :Stu_id AND Course_id = :Course_id
    ';
    foreach ($enroll_courses as $course) {
        $current = $course['enrolled'];
        $new = isset($choice[$course['course_id']]);
        if ($new != $current) {
            try {
                $data = [':Stu_id' => $stu_id, ':Course_id' => $course['course_id']];
                if ($new) {
                    make_query($add_course, $data);
                } else {
                    make_query($remove_course, $data);
                }
            } catch (PDOException $e) {
                
            }
        }
    }
}

function CardCourse(array $course) {
    echo <<<EOS
        <div class="cardcourses">
            <h3><a href="course.php?course_id={$course['course_id']}">{$course['course_name']}</a></h3>
            <p>{$course['faculty_name']}</p>
        </div>
    EOS;
}

function AssignmentRow(array $data) {
    $status = $data['submitted'] ? 'Submitted': 'Pending';
    echo <<<EOS
        <tr>
            <th scope="row">
                <div class="media align-items-center">
                    <div class="media-body">
                        <span class="mb-0 text-sm">{$data['assn_name']}</span>
                    </div>
                </div>
            </th>
            <td>{$data['course_name']}</td>
            <td>$status</td>
            <td>{$data['due_date']}</td>
            <td><button type="submit">Submit</button></td>
        </tr>
    EOS;
}

function Notification(array $notification) {
    echo <<<EOS
        <tr>
            <th>{$notification['course_name']}</th>
            <td style="width:80%;text-align:left;">{$notification['content']}</td>
        </tr>
    EOS;
}

function EnrollCourseRow(array $course) {
    $checked = $course['enrolled'] ? 'checked' : '';
    echo <<<EOS
        <tr>
            <th scope="row">
                <input name="course[]" $checked value="{$course['course_id']}" type="checkbox">
            </th>
            <td>{$course['course_name']}</td>
            <td>{$course['department_name']}</td>
            <td>{$course['faculty_name']}</td>
        </tr>
    EOS;
}
