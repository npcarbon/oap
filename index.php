<?php 
require 'function/database.php';
    if (!@isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>สำนักงานปรมาณูเพื่อสันติ</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
</head>
<nav class="navbar fixed-top flex-md-nowrap p-0 shadowrt2f" style="background-color: #1aa3ff;">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php" style="color:#FFF;"> <h5>OAP GPS</h5> </a>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="function/logout.php" style="color:#FFF;">ออกจากระบบ</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <span data-feather="home"></span> หน้าหลัก <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewjob.php">
                                <span data-feather="file"></span> รายละเอียดงาน
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="upload.php">
                                <span data-feather="file"></span> นำเข้าไฟล์ข้อมูล
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="accident.php">
                                <span data-feather="file"></span> รายงานปัญหาระหว่างขนย้ายวัสดุกัมมันตรังสี <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

<body>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <!-- Start Content Here -->
            <div class="text-center" style="padding-top:50px;">
                <img src="assets/images/oap-banner-white.png" alt="" class="rounded mx-auto d-block">
                <div style="padding-top: 20px">
                    <h2>ยินดีต้อนรับสู่ระบบติดตามยานพาหนะขนส่งวัสดุกัมมันตรังสี</h2>
                </div>
            </div>
        <!-- End Content Here -->

    </main>
<?php
require '__layout/footer.php';
?>
