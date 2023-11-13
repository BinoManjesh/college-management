<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/libs/course.php';
?>

<?php
view('header', [
    'title' => 'Dashboard', 'stylesheets' => [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        'coursepage'
    ]
]);
?>

<div class='popup' id="popupattendance" style="width: 100%;height:100%;display:none;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                Date
            </h3>
            <button id="closepopupattendance" onclick="myFunction1()" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <div class="pendingassignment">
                <div class="card shadow">
                    <table class="table align-items-center table-flush" style="display:block;border-collapse: collapse;height:auto;text-align:center">
                        <tbody style="display: block;">
                            <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                <th style="text-align: center;">Student Id</th>
                                <th style="text-align: center;">Mark</th>
                                <!-- <th style="text-align: center;">Department</th>
                                    <th style="text-align: center;">Faculty</th> -->
                            </tr>
                            <?php
                                foreach ($students as $student) {
                                    AttendanceRow(($student));
                                }
                            ?>
                        </tbody>
                    </table>


                </div>
            </div>
            <div style="width: 100%;justify-content:center;display:flex">
                <button id="confirmpopupattendance" onclick="myFunction1()" type="submit">Confirm</button>
            </div>
        </div>
    </div>
</div>
<div class='popup' id="popupassignment" style="width: 100%;height:100%;display:none;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                Assignment 1
            </h3>
            <button id="closepopupassignment" onclick="myFunction3()" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <div class="pendingassignment">
                <div class="card shadow">
                    <table class="table align-items-center table-flush" style="display:block;border-collapse: collapse;height:auto;text-align:center">
                        <tbody style="display: block;">
                            <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                <th style="text-align: center;">Student Id</th>
                                <th style="text-align: center;">Submission Date</th>
                                <th style="text-align: center;">Marks</th>
                                <!-- <th style="text-align: center;">Department</th>
                                    <th style="text-align: center;">Faculty</th> -->
                            </tr>
                            <tr>
                                <td>Student Id
                                    <button><i class="fa fa-download"></i></button>
                                </td>
                                <td> Date </td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id
                                <button><i class="fa fa-download"></i></button>
                                </td>
                                <td> Date </td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id
                                <button><i class="fa fa-download"></i></button>
                                </td>
                                <td> Date </td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id
                                <button><i class="fa fa-download"></i></button>
                                </td>
                                <td> Date </td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id
                                <button><i class="fa fa-download"></i></button>
                                </td>
                                <td> Date </td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id
                                <button><i class="fa fa-download"></i></button>
                                </td>
                                <td> Date </td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
            <div style="width: 100%;justify-content:center;display:flex">
                <button id="confirmpopupassignment" onclick="myFunction3()" type="submit">Confirm</button>
            </div>
        </div>
    </div>
</div>
<div class='popup' id="popupexams" style="width: 100%;height:100%;display:none;justify-content:center;position:absolute;z-index:1001;backdrop-filter: blur(10px);">
    <div class='card' style="width: 50%;">
        <div class="card-header" style="text-align:center;grid-template-columns:none">
            <h3 style="text-align: center;">
                Exam 1
            </h3>
            <button id="closepopupexam" onclick="myFunction5()" style="width:auto;position:absolute;right:0;border:none;background:none;cursor:pointer"><i class="fa fa-close"></i></button>
        </div>
        <div class="card-body" style="grid-template-columns:none;justify-content:center;overflow: scroll;">
            <div class="pendingassignment">
                <div class="card shadow">
                    <table class="table align-items-center table-flush" style="display:block;border-collapse: collapse;height:auto;text-align:center">
                        <tbody style="display: block;">
                            <tr style="color: #443ea2;background-color: #5e9ad9;text-transform:uppercase;">
                                <th style="text-align: center;">Student Id</th>
                                <th style="text-align: center;">Marks</th>
                                <!-- <th style="text-align: center;">Department</th>
                                    <th style="text-align: center;">Faculty</th> -->
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Id</td>
                                <td>
                                    <input type="number" id="grade" name="attendanceradio" value="present" min="0" max="100">
                                </td>
                            </tr>

                        </tbody>
                    </table>


                </div>
            </div>
            <div style="width: 100%;justify-content:center;display:flex">
                <button id="confirmpopupexam" onclick="myFunction5()" type="submit">Confirm</button>
            </div>
        </div>
    </div>
</div>
<div class='dashboard'>
    <?= view('navbar'); ?>
    <div class='dashboard-app'>
        <header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
            <h1 style="position: absolute;text-align: center;width: 100%;z-index: -1;color: #443ea2;">College</h1>
        </header>
        <div class='dashboard-content'>


            <section class="home-section">
                <div class="card">
                    <div class="card-header" style="display: grid;grid-auto-flow:column;grid-template-columns:none;">
                        <h2>
                            Course Name:
                        </h2>
                        <h2>
                            Department:
                        </h2>
                        <h2>
                            Faculty:
                        </h2>
                    </div>
                </div>
                <!-- books begin -->

                <div class='card'>
                    <div class="card-header" style="grid-template-columns: none;">
                        <h2>Study Material</h2>
                        <button type="submit" style="width: 10%;left:90%;position:relative;cursor:pointer;" id="uploadbut" onclick="document.getElementById('uploadfile').click()">Upload</button>
                        <input type="file" style="display: none;" id="uploadfile">
                    </div>
                    <div class="card-body">
                        <div class="cardcourses-wrapper">
                            <div class="cardcourses">
                                <h3>Book1</h3>
                                <p><a href="">Download</a></p>
                            </div>
                            <div class="cardcourses">
                                <h3>Book1</h3>
                                <p><a href="">Download</a></p>
                            </div>
                            <div class="cardcourses">
                                <h3>Book1</h3>
                                <p><a href="">Download</a></p>
                            </div>
                            <div class="cardcourses">
                                <h3>Book1</h3>
                                <p><a href="">Download</a></p>
                            </div>
                            <div class="cardcourses">
                                <h3>Book1</h3>
                                <p><a href="">Download</a></p>
                            </div>
                            <div class="cardcourses">
                                <h3>Book1</h3>
                                <p><a href="">Download</a></p>
                            </div>
                            <div class="cardcourses">
                                <h3>Book1</h3>
                                <p><a href="">Download</a></p>
                            </div>
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
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Topic<br><input type="text" style="width: 100px;"></th>
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Date<br><input type="date" style="width: 100px;"></th>
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Grade<br><button>Add</button></th>
                                    <!-- <th style="text-align: center;">Last Date</th>
                                    <th style="text-align: center;">Submit</th> -->
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">Course</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>Date</td>
                                                <td><button type="submit" onclick="myFunction2()">Grade</button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">Course</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>Date</td>
                                                <td>
                                                    Grade text if student
                                                    <!-- <button type="submit" onclick="myFunction2()">Grade</button> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">Course</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>Date</td>
                                                <td><button type="submit" onclick="myFunction2()">Grade</button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">Course</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>Date</td>
                                                <td><button type="submit" onclick="myFunction2()">Grade</button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">Course</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>Date</td>
                                                <td><button type="submit" onclick="myFunction2()">Grade</button></td>
                                            </tr>
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
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Date<br><input type="date" style="width: 100px;"></th>
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Edit<br><button>Add</button></th>
                                </tr>
                <tr>
                    <th >Date</th>
                    <td><button type="submit" onclick="myFunction()">Edit</button></td>
                </tr> 
                <tr>
                    <th >Date</th>
                    <td>
                        Present/absent text if student
                        <button type="submit" onclick="myFunction()">Edit</button>
                    </td>
                </tr>
                <tr>
                    <th >Date</th>
                    <td><button type="submit" onclick="myFunction()">Edit</button></td>
                </tr>
                <tr>
                    <th >Date</th>
                    <td><button type="submit" onclick="myFunction()">Edit</button></td>
                </tr>
                <tr>
                    <th >Date</th>
                    <td><button type="submit" onclick="myFunction()">Edit</button></td>
                </tr>
                <tr>
                    <th >Date</th>
                    <td><button type="submit" onclick="myFunction()">Edit</button></td>
                </tr>
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
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Exam<br><input type="text" style="width: 100px;"></th>
                                    <th style="text-align: center;padding-left:5px;padding-right:5px;">Edit<br><button>Add</button></th>
                                </tr>
                <tr>
                    <th >Exam</th>
                    <td>
                        Marks if student
                        <!-- <button type="submit" onclick="myFunction4()">Edit</button> -->
                    </td>
                </tr> 
                <tr>
                    <th >Exam</th>
                    <td><button type="submit" onclick="myFunction4()">Edit</button></td>
                </tr> 
                <tr>
                    <th >Exam</th>
                    <td><button type="submit" onclick="myFunction4()">Edit</button></td>
                </tr> 
                <tr>
                    <th >Exam</th>
                    <td><button type="submit" onclick="myFunction4()">Edit</button></td>
                </tr> 
                <tr>
                    <th >Exam</th>
                    <td><button type="submit" onclick="myFunction4()">Edit</button></td>
                </tr> 
                
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
</script>

<?php view('footer') ?>