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

<div class='popup' id="popup" style="width: 100%;height:100%;display:none;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                Courses
            </h3>
            <button id="closepopup" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer" onclick="myFunction1()"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <form method="post" action="dashboard.php">
                <input hidden="true" name="action" value="enroll">
            <div class="addcourse" style="display: none;grid-auto-flow: column">
            <label for="coursename">Course-Name:</label>
            <input type="text" id="coursename" style="width: 100px;">
            <label for="Departmentname">Department:</label>
            <input type="text" id="Departmentname" style="width: 75px;">
            <label for="FacultyIdname">Faculty-Id:</label>
            <input type="text" id="FacultyIdname" style="width: 75px;">
            <label for="Creditsname">Credits:</label>
            <input type="number" id="Creditsname" style="width: 50px;">
            <button id="addcoursebutton">Add</button>
            <!-- coursename,facultyid,credits,department -->
        </div>
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
                                <?php
                                    foreach ($enroll_courses as $course) {
                                        EnrollCourseRow($course);
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="width: 100%;justify-content:center;display:flex">
                    <button id="confirmpopup" type="submit" onclick="myFunction1()">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                <input hidden="true" name="action" value="enroll">
            <div class="adduser" style="display: grid;grid-auto-flow: row">
            <label for="Officialid">Official Id:</label>
            <input type="text" id="Officialid" style="width: 100%;">
            <label for="passwordregister">Password:</label>
            <input type="text" id="passwordregister" style="width: 100%;">
            <label for="firstnameregister">First Name:</label>
            <input type="text" id="firstnameregister" style="width: 100%;">
            <label for="lastnameregister">Last Name:</label>
            <input type="text" id="lastnameregister" style="width: 100%;">
            <label for="departmentregister">Department Name:</label>
            <input type="text" id="departmentregister" style="width: 100%;">
            <label for="branchregister">Branch Name:</label>
            <input type="text" id="branchregister" style="width: 100%;">
            <label for="Typeregister">Type:</label>
            <input type="text" id="Typeregister" style="width: 100%;">
            <label for="Semesterregister">Semester:</label>
            <input type="number" id="Semesterregister" style="width: 100%;">            
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
            <button style="position: absolute;right:0;padding:5px;" onclick="myFunction2()">Register User</button>
        </header>
        <div class='card'>
            <div class='card-header' style="grid-template-columns: none;">
                <!-- <div class="profile-img"><button type='submit' id="profilepic" style="background:white;opacity:0.5;width:100%;overflow:hidden;height:25%;border:none;z-index:10;cursor:pointer;position:relative;top:75%">Edit</button></div> -->
                <div style="display: flex;align-items: center;">
                    <h3 class='data1'>Name:<br><br>Id:</h3>
                </div>
                <div style="display: flex;align-items: center;">
                    <h3 class='data1'>Department:<br><br>Credits:</h3>
                </div>
                <div style="display: flex;align-items: center;">
                    <h3 class='data1'>CGPA/Salary:<br><br>Semester:</h3>
                </div>
                <p style="position: absolute;bottom:0;right:0;margin:0;">Administrator</p>
            </div>
        </div>
        <div class='card'>
            <div class="card-header">
                <h2>Courses</h2>
                <button type="submit" style="width: 10%;left:90%;position:relative;cursor:pointer;" id="enrollbut" onclick="myFunction()">Enroll/Add</button>
            </div>
            <div class="card-body">
                <div class="cardcourses-wrapper">
                    <?php
                        foreach($user_courses as $course) {
                            CardCourse($course);
                        }
                    ?>
                </div>
            </div>
        </div>
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
                                            AssignmentRow($data);
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
                                            Notification($notification);
                                        }
                                    ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
<script src="scripts/dashboardpage.js"></script>
<script>
    function myFunction() {
        document.getElementById("popup").style.display = "flex";
    }
    function myFunction1() {
        document.getElementById("popup").style.display = "none";
    }
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