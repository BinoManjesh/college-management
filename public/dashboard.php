<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/libs/dashboard.php';
?>

<?php
view('header', ['title' => 'Dashboard', 'stylesheets'=>[
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
    'dashboardpage'
]]);
?>
<?php if(isset($showenroll)): ?>
<div class='popup' id="popup" style="width: 100%;height:100%;display:flex;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                Courses
            </h3>
            <form method="post" action="dashboard.php">
            <input hidden="true" name="action" value="enrollclose">
            <button id="closepopup" name="closepopup" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer"><i class="fa fa-close"></i></button>
            </form>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
        <?php if($_SESSION['user_data']['type']==='admin'): ?>
        <form method="post" action="dashboard.php">
            <input hidden="true" name="action" value="addcourse">
            <div class="addcourse" style="display: grid;grid-auto-flow: column">
            <label for="coursename">Course-Name:</label>
            <input type="text" id="coursename" name="coursename" style="width: 100px;">
            <label for="Departmentname">Department:</label>
            <input type="text" id="Departmentname" name="Departmentname" style="width: 75px;">
            <label for="FacultyIdname">Faculty-Id:</label>
            <input type="text" id="FacultyIdname" name="FacultyIdname" style="width: 75px;">
            <label for="Creditsname">Credits:</label>
            <input type="number" id="Creditsname" name="Creditsname" style="width: 50px;">
            <button id="addcoursebutton" type="submit">Add</button>
            <!-- coursename,facultyid,credits,department -->
        </div>
    </form>
    <?php endif ?>
        <form method="post" action="dashboard.php">
            <div class="pendingassignment">
                    <div class="card shadow">
                        <table class="table align-items-center table-flush" style="display:block;border-collapse: collapse;height:auto;text-align:center">
                            <tbody style="display: block;">
                                <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                    <th style="text-align: center;">Select</th>
                                    <th style="text-align: center;">Course</th>
                                    <th style="text-align: center;">Department</th>
                                    <th style="text-align: center;">Faculty</th>
                                </tr>
                                <input hidden="true" name="action" value="enroll">
                                <?php
                                    foreach ($enroll_courses as $course) {
                                        $checked = $course['enrolled'] ? 'checked' : '';
                                        echo <<<EOS
                                            <tr>
                                                <th scope="row">
                                                    <input name="course{$course['course_id']}" $checked value="{$course['course_id']}" type="checkbox">
                                                </th>
                                                <td>{$course['course_name']}</td>
                                                <td>{$course['department_name']}</td>
                                                <td>{$course['faculty_name']}</td>
                                            </tr>
                                        EOS;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="width: 100%;justify-content:center;display:flex">
                    <button id="confirmpopup" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif ?>
<div class='popupregister' id="registerpopup" style="width: 100%;height:100%;display:none;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                New User
            </h3>
            <button id="closepopupregister" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer" onclick="myFunction3()"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <form method="post" action="dashboard.php">
                <input hidden="true" name="action" value="enrolluser">
            <div class="adduser" style="display: grid;grid-auto-flow: row">
            <label for="Officialidregister">Official Id:</label>
            <input type="text" id="Officialidregister" name="Officialidregister" style="width: 100%;">
            <label for="Usernameregister">Username:</label>
            <input type="text" id="Usernameregister" name="Usernameregister" style="width: 100%;">
            <label for="passwordregister">Password:</label>
            <input type="text" id="passwordregister" name="passwordregister" style="width: 100%;">
            <label for="firstnameregister">First Name:</label>
            <input type="text" id="firstnameregister" name="firstnameregister" style="width: 100%;">
            <label for="lastnameregister">Last Name:</label>
            <input type="text" id="lastnameregister" name="lastnameregister" style="width: 100%;">
            <label for="departmentregister">Department Name:</label>
            <input type="text" id="departmentregister" name="departmentregister" style="width: 100%;">
            <label for="branchregister">Branch Name:</label>
            <input type="text" id="branchregister" name="branchregister" style="width: 100%;">
            <label for="Typeregister">Type:</label>
            <select name="Typeregister" id="Typeregister">
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
                <option value="HOD">HOD</option>
            </select>
            <!-- <input type="text" id="Typeregister" name="Typeregister" style="width: 100%;"> -->
            <label for="Semesterregister">Semester:</label>
            <input type="number" id="Semesterregister" name="Semesterregister" style="width: 100%;">            
            <!-- coursename,facultyid,credits,department -->
        </div>
        <br>
                <div style="width: 100%;justify-content:center;display:flex">
                    <button id="confirmpopupregister" type="submit" onclick="myFunction3()">Add</button>
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
            <?php if($_SESSION['user_data']['type']==='admin'): ?><button style="position: absolute;right:0;padding:5px;" onclick="myFunction2()">Register User</button><?php endif ?>
        </header>
        <div class='card'>
            <div class='card-header' style="grid-template-columns: none;">
            <?php
            $CGPA=calculateCGPA();
            if(!isset($CGPA))
            $CGPA='-';
            echo<<< END
                <div style="display: flex;align-items: center;">
                    <h3 class='data1'>Name: {$user['First_name']} {$user['Last_name']}<br><br>Id: {$user['Off_id']}</h3>
                </div>
                <div style="display: flex;align-items: center;">
                    <h3 class='data1'>Department: {$user['Dept_name']}<br><br>Branch: {$user['Branch_name']}</h3>
                </div>
                <div style="display: flex;align-items: center;">
                    <h3 class='data1'>CGPA:{$CGPA}<br><br>Semester: {$user['Semester']}</h3>
                </div>
                <p style="position: absolute;bottom:0;right:0;margin:0;">{$user['type']}</p>
                END;
            ?>
            </div>
        </div>
        <div class='card'>
            <div class="card-header">
                <h2>Courses</h2>
                <form method="post" action="dashboard.php">
            <input hidden="true" name="action" value="enrolloraddcourses">
            <?php if($_SESSION['user_data']['type']==='admin'): ?><button style="width: 10%;left:90%;position:relative;cursor:pointer;" id="enrollbut" onclick="myFunction()">Add Courses</button><?php endif ?>
                <?php if($_SESSION['user_data']['type']==='student'): ?><button style="width: 10%;left:90%;position:relative;cursor:pointer;" id="enrollbut" onclick="myFunction()">Enroll for Courses</button><?php endif ?>
                </form>
            </div>
            <div class="card-body">
                <div class="cardcourses-wrapper">
                    <?php
                        foreach($user_courses as $course) {
                            echo <<<EOS
                            <div class="cardcourses">
                                <h3><a href="course.php?course_id={$course['course_id']}">{$course['course_name']}</a></h3>
                                <p>{$course['faculty_name']}</p>
                            </div>
                        EOS;
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php if($_SESSION['user_data']['type']==='student'): ?>
        <div class="container2">
            <div class="card">
                <div class="card-header">
                    <h2>Assignments</h2>
                </div>
                <div class="card-body">
                    <div class="pendingassignment">
                        <div class="card shadow">
                            <table class="table align-items-center table-flush" style="border-collapse: collapse;text-align:center">
                                <tbody style="display: block;height: 150px;overflow: auto;">
                                    <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                        <th style="text-align: center;">Assignment</th>
                                        <th style="text-align: center;">Course</th>
                                        <th style="text-align: center;">Last Date</th>
                                        <th style="text-align: center;">Submit</th>
                                        
                                    </tr>
                                    <?php
                                        foreach($assn_query as $data) {
                                            echo <<<EOS
                                            <tr>
                                            <form method="post" action="dashboard.php" enctype="multipart/form-data">
                                                <input hidden="true" name="action" value="submitassgndash">
                                                <input hidden="true" name="assgn_id" value="{$data['assn_id']}">
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">{$data['assn_name']}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>{$data['course_name']}</td>
                                                <td>{$data['due_time']}</td>
                                                <td><button type="submit" name="assgnsubmit">Submit
                                                <input type="file" id="submitassign{$data['assn_id']}" name="submitassign{$data['assn_id']}" style="display:none" onchange="document.getElementById('assign{$data['assn_id']}file').innerHTML=document.getElementById('submitassign{$data['assn_id']}').files[0].name"></button>
                                                <span style="width:min-content;" onclick="document.getElementById('submitassign{$data['assn_id']}').click()"><i class="fa fa-upload" style="cursor:pointer"></i></span>
                                                <div><p id="assign{$data['assn_id']}file" style="margin:0px;">No File</p></div>
                                                </td>
                                            </form>
                                            </tr>
                                        EOS;
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
                    <h2>Notifications</h2>
                </div>
                <div class="card-body">
                    <div class="pendingassignment">
                        <div class="card shadow">
                            <table class="table align-items-center table-flush" style="border-collapse: collapse;">
                                <tbody style="display: block;height: 150px;overflow: auto;">
                                    <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                        <th>Course</th>
                                        <th style="width:80%;text-align:left;">Announcement</th>
                                    </tr>
                                    <?php
                                        foreach ($notifications as $notification) {
                                            echo <<<EOS
                                            <tr>
                                            <form method="post" action="dashboard.php">
                                                <input hidden="true" name="action" value="deletenotification">
                                                <input hidden="true" name="notificationdel" value="{$notification['not_id']}">
                                                <th>{$notification['course_name']}</th>
                                                <td style="width:70%;text-align:left;">{$notification['content']}</td>
                                                <td style="width:10%"><button type="submit"><i class="fa fa-trash"></i></button></td>
                                            </form>
                                            </tr>
                                        EOS;
                                        }
                                    ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>
</div>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
<script src="scripts/dashboardpage.js"></script>
<script>
    function myFunction2()
    {
        document.getElementById("registerpopup").style.display="flex";
        // console.log("debug");
    }
    function myFunction3(){
        document.getElementById("registerpopup").style.display="none";
        // console.log("debug");
    }
</script>

<?php view('footer') ?>