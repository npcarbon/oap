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
                            <a class="nav-link" href="index.php">
                                <span data-feather="home"></span> หน้าหลัก
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewjob.php">
                                <span data-feather="file"></span> รายละเอียดงาน
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="upload.php">
                                <span data-feather="file"></span> นำเข้าไฟล์ข้อมูล <span class="sr-only">(current)</span>
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
		<div style="padding-top:50px;">
		<!-- Start Content Here -->

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">สร.3</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">GPS Tracking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li> -->
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form action="function/database.php" method="post" name="mainfrm" enctype="multipart/form-data">
                    <div class="jumbotron">
                        <h1 class="display-8">อัพโหลดไฟล์ (สร.3)</h1>
                        <div style="padding-top:10px;">
                            <div class="col-xs-3">
                                <input type="file" name="fileUpload">
                                <div style="padding-top: 10px">
                                    <p style="color:red;">*หมายเหตุ : อัพโหลดเฉพาะไฟล์ CSV เท่านั้น</p>
                                    <a target="_blank" href="https://drive.google.com/open?id=1DkZH_9WqApw7CYJVwmenS6O32V0VMLWr">รูปแบบการบรรทึก สร.3</a> ||
                                    <a target="_blank" href="assets/Excel2CSV.pdf">วิธีการแปลงไฟล์จาก xlmn(Excel) เป็น CSV</a>
                                </div>
                                <div style="padding-top:20px;">
                                <button type="submit" class="btn btn-primary" name="UL">อัพโหลดไฟล์</button>
                                </div>
                            </div>
                        </div>
                    </div>                      
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="jumbotron">
                <h1 class="display-8">อัพโหลดไฟล์ (GPS Tracking)</h1>
                    <div style="padding-top:10px;">
                        <div class="col-xs-3">
                        <form action="function/database.php" method="post">
                            <input type="file" name="fileUpload" class="form-control">
                            <p style="color:red;">*หมายเหตุ : อัพโหลดเฉพาะไฟล์ KML เท่านั้น</p>
                            <div style="padding-top:20px;">
                                <button type="submit" class="btn btn-primary" name="kmlUL">อัพโหลดไฟล์</button>
                            </div>
                        
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
		<!-- End Content Here -->
		</div>
		</main>
		<?php
require '__layout/footer.php';
?>