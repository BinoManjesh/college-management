<?php
if (is_post_request()) {
    if ($_POST['action'] === 'enroll') {
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
        $new = isset($choice[$course['user_id']]);
        if ($new != $current) {
            $data = [':Stu_id' => $stu_id, ':Course_id' => $course['course_id']];
            if ($new) {
                make_query($add_course, $data);
            } else {
                make_query($remove_course, $data);
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
