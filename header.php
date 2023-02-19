<?php
require_once('backend/connection.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASSCAT || APPOINTMENT</title>

    <link rel="preconnect" href="../https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="shortcut icon" href="../assets/images/asscat.png" type="image/x-icon">
    <link rel="stylesheet" href="../assetss/css/style.css">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <span style="font-size: 15px;">APPOINTMENT SYSTEM</span>
                            <img src="../assets/images/asscat.png" alt="">
                        </div>
                        
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                    <div style="margin-left: 20%;">
                    <img alt="" width="70%" style="border-radius: 50%;"
                    <?php
                   if($_SESSION['user1']['gender']=='1'){
                    echo 'src="../assets/images/avatar1.png"';
                  }else{
                    echo 'src="../assets/images/avatar2.png"';
                  }
                ?>>
                </div><br>
                <h5 class="text-center" style="font-weight: bold;">ID: <?php echo $_SESSION['user1']['username'];?></h5>
                <h5 class="text-center" style="font-weight: bold;"><?php echo $_SESSION['user1']['fname']; echo "&nbsp;"; echo $_SESSION['user1']['lname'];?></h5>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="appointment.php" class='sidebar-link'>
                                <i class="fa fa-list"></i>
                                <span>Request Appointment</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="changepass.php" class='sidebar-link'>
                                <i class="fa fa-key"></i>
                                <span>Change Pass</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="backend/logout.php" class='sidebar-link'>
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>

                    </div>
                    
                       

                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>