<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/libs/course.php';
require_once __DIR__ . '/../src/libs/dashboard.php';
?>

<?php
view('header', [
    'title' => $course['Course_name'], 'stylesheets' => [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        'coursepage'
    ]
]);
?>

<?php if (isset($attd_date)): ?>
<div class='popup' id="popupattendance" style="width: 100%;height:100%;display:flex;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                Date
            </h3>
            <button id="closepopupattendance" onclick="myFunction1()" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <form action='course.php?course_id=<?= $course_id ?>' method='post'>
                <input hidden name='action' value='confirm_attendance'>
                <input hidden name='date' value='<?= $attd_date ?>'>
                <div class="pendingassignment">
                    <div class="card shadow">
                        <table class="table align-items-center table-flush" style="display:block;border-collapse: collapse;height:auto;text-align:center">
                            <tbody style="display: block;">
                                <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                    <th style="text-align: center;">Student Id</th>
                                    <th style="text-align: center;">Mark</th>
                                </tr>
                                <?php
                                    foreach ($attd_students as $student) {
                                        $id = $student['Stu_id'];
                                        if ($student['Present']) {
                                            $present = 'checked';
                                            $absent = '';
                                        } else {
                                            $present = '';
                                            $absent = 'checked';
                                        }
                                        echo <<<END
                                        <tr>
                                            <td>{$student['Off_id']}</td>
                                            <td style="display: grid;grid-auto-flow:column;">
                                                <input $present type="radio" id="present-$id" name="attendance-$id" value="1">
                                                <label for="present-$id" style="text-align: left;">Present</label>
                                                <input $absent type="radio" id="absent-$id" name="attendance-$id" value="0">
                                                <label for="absent-$id" style="text-align: left;">Absent</label>
                                            </td>
                                        </tr>
                                        END;
                                    }
                                ?>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div style="width: 100%;justify-content:center;display:flex">
                    <button id="confirmpopupattendance" onclick="myFunction1()" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif ?>
<?php if (isset($grade_assn)): ?>
<div class='popup' id="popupassignment" style="width: 100%;height:100%;display:flex;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                <?= $grade_assn['Assn_name'] ?>
            </h3>
            <button id="closepopupassignment" onclick="myFunction3()" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <form action="course.php?course_id=<?=$course_id?>" method="post">
                <input hidden name='action' value='confirm_grade_assignment'>
                <input hidden name='assn_id' value='<?= $assn_id ?>'>
                <div class="pendingassignment">
                    <div class="card shadow">
                        <table class="table align-items-center table-flush" style="display:block;border-collapse: collapse;height:auto;text-align:center">
                            <tbody style="display: block;">
                                <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                    <th style="text-align: center;">Student Id</th>
                                    <th style="text-align: center;">Submission Date</th>
                                    <th style="text-align: center;">Marks</th>
                                </tr>   
                                <?php
                                    if ($assn_submissions) {
                                        foreach ($assn_submissions as $submission) {
                                            $name = "{$submission['User_id']}";
                                            echo <<<END
                                            <tr>
                                                <td>{$submission['Off_id']}
                                                    <a href="uploaded_files/{$submission['Sub_file']}" download><i class="fa fa-download"></i></a>
                                                </td>
                                                <td>{$submission['Sub_time']}</td>
                                                <td>
                                                    <input type="number" id="grade-$name" name="$name" value="{$submission['Grade']}" min="0" max="100">
                                                </td>
                                            </tr>
                                            END;
                                        }
                                    } else {
                                        echo "<tr><td>No submissions</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div style="width: 100%;justify-content:center;display:flex">
                    <button id="confirmpopupassignment" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif ?>
<?php if (isset($marks_type)): ?>
<div class='popup' id="popupexams" style="width: 100%;height:100%;display:flex;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                <?= $marks_type ?>
            </h3>
            <button id="closepopupexam" onclick="myFunction5()" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <form action='course.php?course_id=<?= $course_id ?>' method='post'>
                <input hidden name='action' value='confirm_marks'>
                <input hidden name='column' value='<?= $marks_column ?>'>
                <div class="pendingassignment">
                    <div class="card shadow">
                        <table class="table align-items-center table-flush" style="display:block;border-collapse: collapse;height:auto;text-align:center">
                            <tbody style="display: block;">
                                <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                    <th style="text-align: center;">Student Id</th>
                                    <th style="text-align: center;">Marks</th>
                                </tr>
                                <?php
                                foreach ($stu_marks as $stu) {
                                    $name = $stu['User_id'];
                                    $marks = $stu[$marks_column];
                                    echo <<<END
                                    <tr>
                                        <td>{$stu['Off_id']}</td>
                                        <td>
                                            <input type="number" id="$name" name="$name" value="$marks" min="0" max="100">
                                        </td>
                                    </tr>
                                    END;
                                }
                                ?>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div style="width: 100%;justify-content:center;display:flex">
                    <button id="confirmpopupexam" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif ?>
<div class='popupendcourse' id="endcoursepopup" style="width: 100%;height:100%;display:none;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                End Course
            </h3>
            <button id="closeendcoursepopup" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer" onclick="myFunction7()"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <form action='course.php?course_id=<?=$course_id?>' method="post">
                <input hidden="true" name="action" value="endcourse">
                <div class="pendingassignment">
                    <div class="card shadow">
                        <table class="table align-items-center table-flush" style="display:block;border-collapse: collapse;height:auto;text-align:center">
                            <tbody style="display: block;">
                                <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                    <th style="text-align: center;">Grade</th>
                                    <th style="text-align: center;">Starting Marks(Included)</th>
                                    <th style="text-align: center;">Ending Marks(Included)</th>
                                </tr>
                                <tr>
                                    <td>AA(10)</td>
                                    <td><input type="number" id="startingmarksAA" name="startingmarksAA" max="100" min="0" value="0" 
                                    onchange="document.getElementById('endingmarksAB').value=(document.getElementById('startingmarksAA').value-1);
                                    document.getElementById('startingmarksAB').max=(document.getElementById('startingmarksAA').value-1)">
                                    </td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>AB(9)</td>
                                    <td><input type="number" id="startingmarksAB" name="startingmarksAB" max="100" min="0" value="0"
                                    onchange="document.getElementById('endingmarksBB').value=(document.getElementById('startingmarksAB').value-1);
                                    document.getElementById('startingmarksBB').max=(document.getElementById('startingmarksAB').value-1)">
                                    </td>
                                    <td><input type="number" id="endingmarksAB" disabled max="100" min="0" value="0"></td>
                                </tr>
                                <tr>
                                    <td>BB(8)</td>
                                    <td><input type="number" id="startingmarksBB" name="startingmarksBB" max="100" min="0" value="0"
                                    onchange="document.getElementById('endingmarksBC').value=(document.getElementById('startingmarksBB').value-1);
                                    document.getElementById('startingmarksBC').max=(document.getElementById('startingmarksBB').value-1)">
                                    </td>
                                    <td><input type="number" id="endingmarksBB" value="0" max="100" min="0" disabled></td>
                                </tr>
                                <tr>
                                    <td>BC(7)</td>
                                    <td><input type="number" id="startingmarksBC" name="startingmarksBC" max="100" min="0" value="0"
                                    onchange="document.getElementById('endingmarksCC').value=(document.getElementById('startingmarksBC').value-1);
                                    document.getElementById('startingmarksCC').max=(document.getElementById('startingmarksBC').value-1)">
                                    </td>
                                    <td><input type="number" id="endingmarksBC" max="100" min="0" value="0" disabled></td>
                                </tr>
                                <tr>
                                    <td>CC(6)</td>
                                    <td><input type="number" id="startingmarksCC" name="startingmarksCC" max="100" min="0" value="0"
                                    onchange="document.getElementById('endingmarksCD').value=(document.getElementById('startingmarksCC').value-1);
                                    document.getElementById('startingmarksCD').max=(document.getElementById('startingmarksCC').value-1)">
                                    </td>
                                    <td><input type="number" id="endingmarksCC" max="100" min="0" value="0" disabled></td>
                                </tr>
                                <tr>
                                    <td>CD(5)</td>
                                    <td><input type="number" id="startingmarksCD" name="startingmarksCD" max="100" min="0" value="0"
                                    onchange="document.getElementById('endingmarksDD').value=(document.getElementById('startingmarksCD').value-1);
                                    document.getElementById('startingmarksDD').max=(document.getElementById('startingmarksCD').value-1)">
                                    </td>
                                    <td><input type="number" id="endingmarksCD" max="100" min="0" value="0" disabled></td>
                                </tr>
                                <tr>
                                    <td>DD(4)</td>
                                    <td><input type="number" id="startingmarksDD" name="startingmarksDD" max="100" min="0" value="0" onchange="document.getElementById('endingmarksFF').value=(document.getElementById('startingmarksDD').value-1)"></td>
                                    <td><input type="number" id="endingmarksDD" max="100" min="0" value="0" disabled></td>
                                </tr>
                                <tr>
                                    <td>FF(0)</td>
                                    <td>0</td>
                                    <td><input type="number" id="endingmarksFF" max="100" min="0" value="0" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        <br>
                <div style="width: 100%;justify-content:center;display:flex">
                    <button id="confirmendcoursepopup" type="submit">End</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class='dashboard'>
    <?= view('navbar'); ?>
    <div class='dashboard-app'>
        <header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
            <h1 style="position: absolute;text-align: center;width: 100%;z-index: -1;color: #443ea2;">College</h1>
            <?php if ($user_type !== 'student'): ?>
            <button style="position: absolute;right:0;padding:5px;" onclick="myFunction6()">End Course</button>
            <?php endif ?>
        </header>
        <div class='dashboard-content'>


            <section class="home-section">
                <div class="card">
                    <div class="card-header" style="display: grid;grid-auto-flow:column;grid-template-columns:none;">
                        <h2>
                            Course Name: <?= $course['Course_name'] ?>
                        </h2>
                        <h2>
                            Department: <?= $course['Dept_name'] ?>
                        </h2>
                        <h2>
                            Faculty: <?= $course['Fac_fname'] . ' ' . $course['Fac_lname']?>
                        </h2>
                        <?php if($user_type==='student'): ?>
                        <h2>
                            Grade : <?= $gradecourse['Grade'] ?>
                        </h2>
                        <?php endif ?>
                    </div>
                </div>
                <!-- books begin -->

                <div class='card'>
                    <div class="card-header" style="grid-template-columns: none;">
                        <h2>Study Material</h2>
                        <?php if ($user_type !== 'student'): ?>
                        <form action='course.php?course_id=<?=$course_id?>' method="post" enctype="multipart/form-data">
                            <input hidden name="action" value="upload_material">
                            <button type="submit" style="width: 10%;left:65%;position:relative;cursor:pointer;" id="uploadbut">Upload</button>
                            <input style="width: 20%;left:70%;position:relative;cursor:pointer;" name="course-material" type="file" id="uploadfile">
                        </form>
                        <?php endif?>
                    </div>
                    <div class="card-body">
                        <div class="cardcourses-wrapper">
                            <?php
                            foreach ($material as $mat) {
                                echo <<<END
                                <div class="cardcourses">
                                    <h3>{$mat['Mat_name']}</h3>  
                                    <p><a href="uploaded_files/{$mat['Mat_file']}" download>Download</a></p>
                                </div>
                                END;
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- books end-->

                <div class="container2">
                    <div class="card">
                    <div class="card-header">
                        <h2>Assignments</h2>
                        
                    </div>
                    <div class="card-body">
                    <div class="pendingassignment">
            <div class="card shadow">
                    <table class="table align-items-center table-flush" style="border-collapse: collapse;text-align:center">
                            <tbody style="display: block;height: 225px;overflow: auto;">
                                <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                <?php
                                    function ifAllowed($str) {
                                        global $user_type;
                                        if ($user_type !== 'student') {
                                            echo $str;
                                        }
                                    }
                                ?>
                                <?= ifAllowed("<form action='course.php?course_id=$course_id' method='post'>") ?>
                                    <input hidden="true" name="action" value="newassignment">
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Topic<br>
                                        <?= ifAllowed('<input type="text" id="newassignmenttopic" name="newassignmenttopic" style="width: 100px;">') ?>
                                    </th>
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Date<br>
                                        <?= ifAllowed('<input type="datetime-local" id="newassignmentdate" name="newassignmentdate" style="width: 100px;">') ?>
                                    </th>
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Grade<br>
                                        <?= ifAllowed('<button type="submit">Add</button>') ?>
                                    </th>
                                    <!-- <th style="text-align: center;">Last Date</th>
                                    <th style="text-align: center;">Submit</th> -->
                                <?= ifAllowed('</form>') ?>
                                            </tr>
                                            <?php
                            foreach ($assignments as $ass) {
                                if ($user_type !== 'student') {
                                    echo <<<END
                                    <tr>
                                        <form action="course.php?course_id=$course_id" method="post">
                                            <input hidden name="action" value="grade_assignment">
                                            <input hidden name="assn_id" value="{$ass['Assn_id']}">
                                            <th scope="row" style="padding-left:0px;padding-right:0px;">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{$ass['Assn_name']}</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td style="padding-left:0px;padding-right:0px;">{$ass['Due_time']}</td>
                                            <td style="padding-left:0px;padding-right:0px;"><button type="submit">Grade</button></td>
                                        </form>
                                    </tr>
                                    END;
                                } else if ($ass['Sub_exists']) {
                                    $grade = $ass['Grade'] ? $ass['Grade'] : 'Submitted';
                                    echo <<<END
                                    <tr>
                                        <input hidden name="assn_id" value="{$ass['Assn_id']}">
                                        <th scope="row" style="padding-left:0px;padding-right:0px;">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm">{$ass['Assn_name']}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td style="padding-left:0px;padding-right:0px;">{$ass['Due_time']}</td>
                                        <td style="padding-left:0px;padding-right:0px;">$grade</td>
                                    </tr>
                                    END;
                                } else {
                                    echo <<<END
                                    <tr>
                                        <form action="course.php?course_id=$course_id" method="post"  enctype="multipart/form-data">
                                            <input hidden name="action" value="assn_submission">
                                            <input hidden name="assn_id" value="{$ass['Assn_id']}">
                                            <th scope="row" style="padding-left:0px;padding-right:0px;">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{$ass['Assn_name']}</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td style="padding-left:0px;padding-right:0px;">{$ass['Due_time']}</td>
                                            <td style="padding-left:0px;padding-right:0px;">
                                                <button type="submit" name="assgnsubmit">
                                                    Submit
                                                    <input type="file" id="submitassign{$ass['Assn_id']}" name="submitassign{$ass['Assn_id']}" style="display:none" onchange="document.getElementById('assign{$ass['Assn_id']}file').innerHTML=document.getElementById('submitassign{$ass['Assn_id']}').files[0].name">
                                                </button>
                                                <span style="width:min-content;" onclick="document.getElementById('submitassign{$ass['Assn_id']}').click()"><i class="fa fa-upload" style="cursor:pointer"></i></span>
                                                <div>
                                                    <p id="assign{$ass['Assn_id']}file" style="margin:0px;">No File</p>
                                                </div>
                                            </td>                                        
                                        </form>
                                    </tr>
                                    END;
                                }
                            }
                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Attendance</h2>
                        </div>
                        <div class="card-body">
                        <div class="pendingassignment">
            <div class="card shadow">
                    <table class="table align-items-center table-flush" style="border-collapse: collapse;text-align:center;">
                            <tbody style="display: block;height: 225px;overflow: auto;">
                            <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                            <?php ifAllowed("<form action='course.php?course_id=$course_id' method='post'>
                                             <input hidden='true' name='action' value='new_attendance'>"); ?>
                                
                                <th style="text-align: center;padding-left:5px;padding-right:5px;">Date<br>
                                <?php ifAllowed('<input type="date" id="newattendance" name="newattendance" style="width: 100px;"></th>'); ?>
                                <th style="text-align: center;padding-left:5px;padding-right:5px;">Status<br>
                                <?php ifAllowed('<button type="submit">Add</button></th>'); ?>
                            </form>
                            <?php ifAllowed('</form>') ?>
                                </tr>
                                <?php
                                foreach ($attendance as $att) {
                                    switch ($user_type) {
                                        case 'faculty':
                                        case 'HOD':
                                        case 'admin':
                                            $date = $att['Date'];
                                            echo <<<END
                                            <tr>
                                                <form action="course.php?course_id=$course_id" method="post">
                                                    <input hidden name="action" value="edit_attendance">
                                                    <input hidden name="date" value="$date">
                                                    <th>$date</th>
                                                    <td><button type="submit"">Edit</button></td>
                                                </form>
                                            </tr>
                                            END;
                                        break;
                                        case 'student':
                                            $date = $att['Date'];
                                            $status = $att['Present'] ? 'Present' : 'Absent';
                                            echo <<<END
                                            <tr>
                                                <form action="course.php?course_id=$course_id" method="post">
                                                    <input hidden name="action" value="edit_attendance">
                                                    <input hidden name="date" value="$date">
                                                    <th>$date</th>
                                                    <td>$status</td>
                                                </form>
                                            </tr>
                                            END;
                                    }
                                }
                                ?>
            </tbody>
              </table>
            
            
        </div>
    </div>
                            </div>
                        </div>
                        <div class="card" >
                        <div class="card-header">
                            <h2>Marks</h2>
                        </div>
                        <div class="card-body">
                        <div class="pendingassignment">
            <div class="card shadow">
                    <table class="table align-items-center table-flush" style="border-collapse: collapse;text-align:center;">
                            <tbody style="display: block;height: 225px;overflow: auto;">
                            <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Exam</th>
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Marks</th>
                                </tr>
                <?php
                $mark_names = ['Sessional 1', 'Sessional 2', 'Endsem'];
                $column_names = ['Marks_s1', 'Marks_s2', 'Marks_endsem'];
                for ($i = 0; $i < sizeof($mark_names); ++$i) {
                    $mark_name = $mark_names[$i];
                    $column_name = $column_names[$i];
                    switch ($user_type) {
                        case 'faculty':
                        case 'HOD':
                        case 'admin':
                            echo <<<END
                            <tr>
                                <form action="course.php?course_id=$course_id" method="post">
                                    <input hidden name='action' value='edit_marks'>
                                    <input hidden name='type' value='$mark_name'>
                                    <input hidden name='column' value='$column_name'>
                                    <th>$mark_name</th>
                                    <td><button type="submit">Edit</button></td>
                                </form>
                            </tr> 
                            END;
                            break;
                        case 'student':
                            $marks = $stu_marks[$column_name];
                            $marks = $marks ? $marks : ' - ';
                            echo <<<END
                            <tr>
                                <form action="course.php?course_id=$course_id" method="post">
                                    <input hidden name='action' value='edit_marks'>
                                    <input hidden name='type' value='$mark_name'>
                                    <input hidden name='column' value='$column_name'>
                                    <th>$mark_name</th>
                                    <td>$marks</td>
                                </form>
                            </tr> 
                            END;
                    }
                    
                }
                ?>
                
            </tbody>
              </table>
            
            
        </div>
    </div>
                        </div>
                    </div>
                </div>
                <!-- marks end -->
        </div>
    </div>
</div>
</section>

<!-- <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script> -->


</div>
</div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
<script src="scripts/dashboardpage.js"></script>
<script>
    function myFunction() {
        document.getElementById("popupattendance").style.display = "flex";
    }

    function myFunction1() {
        document.getElementById("popupattendance").style.display = "none";
    }

    function myFunction2() {
        document.getElementById("popupassignment").style.display = "flex";
    }

    function myFunction3() {
        document.getElementById("popupassignment").style.display = "none";
    }

    function myFunction4() {
        document.getElementById("popupexams").style.display = "flex";
    }

    function myFunction5() {
        document.getElementById("popupexams").style.display = "none";
    }
    function myFunction6()
    {
        document.getElementById("endcoursepopup").style.display="flex";
    }
    function myFunction7()
    {
        document.getElementById("endcoursepopup").style.display="none";
 
    }
</script>

<?php view('footer') ?>