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
            <button id="closepopup" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <form method="post" action="dashboard.php">
                <input hidden="true" name="action" value="enroll">
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
                    <button id="confirmpopup" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class='dashboard'>
    <div class="dashboard-nav">
        <header><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a><a href="#" class="brand-logo"><i class="fas fa-book"></i> <span>College</span></a></header>
        <nav class="dashboard-nav-list"><a href="#" class="dashboard-nav-item"><i class="fas fa-home"></i>
                Home </a><a href="#" class="dashboard-nav-item active"><i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-photo-video"></i> Courses </a>
                <div class='dashboard-nav-dropdown-menu'>
                    <?php
                        foreach ($user_courses as $course) {
                            $link = "course.php?course_id={$course['course_id']}";
                            echo "<a href=\"$link\" class=\"dashboard-nav-dropdown-item\">{$course['course_name']}</a>";
                        }
                    ?>
                </div>
            </div>
            <a href="#" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
        </nav>
    </div>
    <div class='dashboard-app'>
        <header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
            <h1 style="position: absolute;text-align: center;width: 100%;z-index: -1;color: #443ea2;">College</h1>
        </header>
        <div class='card'>
            <div class='card-header'>
                <div class="profile-img"><button type='submit' id="profilepic" style="background:white;opacity:0.5;width:100%;overflow:hidden;height:25%;border:none;z-index:10;cursor:pointer;position:relative;top:75%">Edit</button></div>
                <h3 class='data1'>Name:</h3>
                <h3 class='data1'>Id:</h3>
                <h3 class='data1'>CGPA/Salary:</h3>
                <p style="position: absolute;bottom:0;right:0;margin:0;">Administrator</p>
            </div>
        </div>
        <div class='card'>
            <div class="card-header">
                <h2>Courses</h2>
                <button type="submit" style="width: 10%;left:90%;position:relative;cursor:pointer;" id="enrollbut">Enroll</button>
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
                                        <th style="text-align: center;">Status</th>
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
    document.getElementById("enrollbut").addEventListener("click", myFunction);
    document.getElementById("closepopup").addEventListener("click", myFunction1);
    document.getElementById("confirmpopup").addEventListener("click", myFunction1);

    function myFunction() {
        document.getElementById("popup").style.display = "flex";
    }

    function myFunction1() {
        document.getElementById("popup").style.display = "none";
    }
</script>

<?php view('footer') ?>