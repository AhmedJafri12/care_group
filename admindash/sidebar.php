<?php session_start(); if (!isset($_SESSION['logged_in'])) { header('Location: ../login.php'); exit(); } ?>
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="../pages/dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="../pages/doctors.php">Manage Doctors</a></li>
            <li class="nav-item"><a class="nav-link" href="../pages/patients.php">Manage Patients</a></li>
            <li class="nav-item"><a class="nav-link" href="../pages/cities.php">Manage Cities</a></li>
            <li class="nav-item"><a class="nav-link" href="../pages/appointments.php">Manage Appointments</a></li>
            <li class="nav-item"><a class="nav-link" href="../login.php?logout=1">Logout</a></li>
        </ul>
    </div>
</nav>