<?php

$students = [
    ['User_id'=>0, 'Off_id'=>'BT21CSE000'],
    ['User_id'=>1, 'Off_id'=>'BT21CSE001'],
    ['User_id'=>2, 'Off_id'=>'BT21CSE002'],
    ['User_id'=>3, 'Off_id'=>'BT21CSE003'],
    ['User_id'=>4, 'Off_id'=>'BT21CSE004'],
    ['User_id'=>5, 'Off_id'=>'BT21CSE005']
];

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

function GradeRow($stu_assn) {
    echo <<<END
        <tr>
            <td>{$stu_assn['Off_id']}</td>
            <td>{$stu_assn['Dat']}</td>
            <td>
                <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
            </td>
        </tr>
    END;
}