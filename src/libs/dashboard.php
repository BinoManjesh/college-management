<?php

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
                <input $checked value="{$course['course_id']}" type="checkbox">
            </th>
            <td>{$course['course_name']}</td>
            <td>{$course['department_name']}</td>
            <td>{$course['faculty_name']}</td>
        </tr>
    EOS;
}
