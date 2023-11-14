<div class="dashboard-nav">
    <header><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a><a href="#" class="brand-logo"><i class="fas fa-book"></i> <span>College</span></a></header>
    <nav class="dashboard-nav-list"><a href="dashboard.php" class="dashboard-nav-item"><i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-photo-video"></i> Courses </a>
            <div class='dashboard-nav-dropdown-menu'>
                <?php
                global $user_courses;
                    foreach ($user_courses as $course) {
                        $link = "course.php?course_id={$course['course_id']}";
                        echo "<a href=\"$link\" class=\"dashboard-nav-dropdown-item\">{$course['course_name']}</a>";
                    }
                ?>
            </div>
        </div>
        <a href="login.php" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
    </nav>
</div>