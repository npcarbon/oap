<?php 
require 'function/database.php';
    if (!@isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }

    if (!empty($_POST['button'])) {
        $trader = $conn->query("SELECT `trader_id` FROM traders WHERE auth_id =" . $_SESSION['uid']);
                $trader_id = $trader->fetch_assoc();
        addAccident($trader_id['trader_id']);
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
    <link rel="stylesheet" type="text/css" href="assets/jquery.datetimepicker.css"/>

    <!-- Bootstrap core CSS -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script>
            /*jslint browser:true*/
            /*global jQuery, document*/

            jQuery(document).ready(function () {
                'use strict';

                jQuery('#search-from-date').datetimepicker({format:'Y-m-d H:i:s'});
            });
        </script>
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
<style>
/* css กำหนดความกว้าง ความสูงของแผนที่ */
#map_canvas { 
    width:70%;
    height:400px;
    margin:auto;
}
/* css กำหนดส่วนของการแสดง list menu */
div#list_menu_place{
    width:550px;
    margin:auto;    
}

</style>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <span data-feather="home"></span> หน้าหลัก 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewjob.php">
                            <span data-feather="file"></span> รายละเอียดงาน <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">
                            <span data-feather="file"></span> นำเข้าไฟล์ข้อมูล
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="accident.php">
                            <span data-feather="file"></span> รายงานปัญหาระหว่างขนย้ายวัสดุกัมมันตรังสี <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
<body>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div style="padding:20px;">
        <!-- Start Content Here -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> รายงานปัญหาระหว่างขนย้ายวัสดุกัมมันตรังสี </h3>
                </div>
                <!-- /.card-header -->
                <div style="padding-top: 20px">
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="card-body">
                            <form action"" method="post">
                                <div class="container">
                                    <h4 style="padding-left: 20px"> 1.Enter Information </h4>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong><label>วันเวลาที่เกิดเหตุ</label></strong>
                                            <input required type="text" name="date" id="search-from-date" class="form-control" placeholder="วันเวลาที่เกิดเหตุ" style="margin-bottom: 10px" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong><label for="inputProducer">ทะเบียนรถ</label></strong>
                                            <input type="text" class="form-control" name="carLicence" placeholder="ทะเบียนรถ" require>
                                        </div>
                                    </div>
                                    <div class="form-row" style="padding-bottom:20px;">
                                        <div class="form-group col-md-12">
                                            <strong><label for="inputProductName">รายละเอียดการเกิดปัญหา</label></strong>
                                            <textarea class="form-control" style="min-height:110px;" name="accident" require></textarea>
                                        </div>
                                    </div>
                                    <h3 class="card-title"> 2.Select Location </h3>
                                    <?php require 'test.php'; ?>
                                    <input type="submit" class="btn btn-primary btn-block" name="button" id="button" value="บันทึก" />  
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div><!-- /.container-fluid -->
                </section> <!-- /.content -->
            </div> <!-- /.card -->
        <!-- End Content Here -->
        </div>
    </main>
    <script src="assets/jquery.js"></script>
    <script src="assets/build/jquery.datetimepicker.full.js"></script>


<?php
require '__layout/footer.php';
?>
