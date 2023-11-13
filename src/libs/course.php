<?php

function AttendanceRow($student) {
    echo <<<END
        <tr>
            <td>{$student['']}</td>
            <td style="display: grid;grid-auto-flow:column;">
                <input type="radio" id="attendp" name="attendanceradio" value="present">
                <label for="attendp" style="text-align: left;">Present</label>
                <input type="radio" id="attenda" name="attendanceradio" value="absent">
                <label for="attenda" style="text-align: left;">Absent</label>
            </td>
        </tr>
    END;
}