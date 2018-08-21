<?php 
require 'function/database.php';
    if (!@isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }
    if (isset($_POST['saveJob'])) {
    addjob();
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
    $( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
  } );
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
                        <a class="nav-link active" href="viewjob.php">
                            <span data-feather="file"></span> รายละเอียดงาน <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">
                            <span data-feather="file"></span> นำเข้าไฟล์ข้อมูล
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="accident.php">
                            <span data-feather="file"></span> รายงานปัญหาระหว่างขนย้ายกัมมันตรังสี <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <body>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div style="padding-top:20px;">
                  <!-- Start Content Here -->
                  <section class="content">
                    <div class="container-fluid">
                        <!-- search -->
                        <div class="row">
                            <div class="col">
                                <form class="form-inline" method="post">
                                    <div class="form-group mb-2" style="padding-right: 10px;">
                                        <input type="text" class="form-control" name="txtSearch" placeholder="ค้นหา">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
                                </form>
                            </div>
                            <div class="col">
                              <button type="submit" class="btn btn-success mb-2 float-right" data-toggle="modal" data-target="#exampleModal">เพิ่ม</button>
                              <a target="_blank" type="button" class="btn btn-primary mb-2 float-right" href="pdf1.php">PDF</a>                            
                            </div>
                        </div>
                    <!-- end search -->
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title"> รายละเอียดงาน </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th class="align-middle"> ธาตุ-เลขมวล </th>
                    <th class="align-middle"> รุ่น/รหัสสินค้า </th>
                    <th class="align-middle"> ปริมาณ </th>
                    <th class="align-middle"> จำนวน </th>
                    <th class="align-middle"> จุดเริ่มต้น </th>
                    <th class="align-middle"> จุดหมาย </th>
                    <th class="align-middle"> วันที่เริ่ม-สิ้นสุด </th>
                    <th class="align-middle"> ผู้ควบคุม </th>
                    <th class="align-middle"> ทะเบียนรถ </th>
                    <th style="text-align:center"> เส้นทางการวิ่งของรถ </th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if (isset($_POST['txtSearch'])) {
                    getJob($_POST['txtSearch']);
                }else {
                    getJob($_POST['txtSearch']);
                }
            ?>                            
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->
</div><!-- /.container-fluid -->
</section> <!-- /.content -->
<!-- End Content Here -->


<!--Modal -->

<form action="" method="post">
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มรายละเอียด</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="card card-default">
                        <div class="card-header">
                            <h5 class="card-title"> รายละเอียดวัสดุพลอยได้ </h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputElement">ธาตุเลขมวล</label>
                                    <input type="text" class="form-control" name="chmName" placeholder="ธาตุเลขมวล">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputNumber">หมายเลข</label>
                                    <input type="text" class="form-control" name="chmNumber" placeholder="หมายเลข">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputProductName">รหัสสินค้า</label>
                                    <input type="text" class="form-control" name="chmCode" placeholder="รหัส/รุ่น">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputProductName">ผู้ผลิต</label>
                                    <input type="text" class="form-control" name="chmProducer" placeholder="ชื่อผู้ผลิต">
                                </div>


                                <div class="form-group col-md-6">
                                        <label for="inputProducer">สถานะทางกายภาพ</label>
                                    <select name="chmStatus" class="form-control">
                                        <option selected>เลือก</option>
                                        <option>ของแข็ง</option>
                                        <option>ของเหลว</option>
                                        <option>ก๊าซ</option>
                                    </select>
                                </div>
                            </div>                        
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputNumber">ปริมาณ</label>
                                    <input type="text" class="form-control" name="chmVolume" placeholder="ปริมาณ">
                                </div>
                                <div class="col-md-4">
                                    <label>ตรวจสอบวันที่</label>
                                    <input required type="text" name="chkDate" class="form-control" placeholder="วันที่ตรวจสอบ" style="margin-bottom: 10px">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputMany">จำนวน</label>
                                    <input type="text" class="form-control" name="chmQty" placeholder="จำนวน">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputVol">การนำไปใช้งาน</label>
                                    <input type="text" class="form-control" name="spending" placeholder="การนำไปใช้งาน">
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->                    
                    <div class="card card-default">
                        <div class="card-header">
                            <h5 class="card-title"> ภาชนะบรรจุ/เครื่องมือ/เครื่องจักร </h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputProducer">ผู้ผลิต</label>
                                    <input type="text" class="form-control" name="pckProducer" placeholder="ชื่อผู้ผลิต">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputProCode">รหัส/รุ่นสินค้า</label>
                                    <input type="text" class="form-control" name="pckCode" placeholder="รุ่น/รหัสสินค้า">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputNumber">หมายเลข</label>
                                    <input type="text" class="form-control" name="pckNumber" placeholder="ชื่อผู้ผลิต">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputVol">ความจุ/น้ำหนักสูงสุด</label>
                                    <input type="text" class="form-control" name="pckVol" placeholder="ความจุ/น้ำหนักสูงสุด">
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->                    
                    <div class="card card-default">
                        <div class="card-header">
                            <h5 class="card-title"> รายละเอียดงาน </h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputOlLoc">สถานที่เดิม</label>
                                    <input type="text" class="form-control" name="fromPlace" placeholder="สถานที่ตั้ง">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputNewLoc">ไปสถานที่</label>
                                    <input type="text" class="form-control" name="toPlace" placeholder="ไปสถานที่">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>จากวันที่</label>
                                    <input required type="text" name="from_date" id="datepicker1" class="form-control" placeholder="จากวันที่" style="margin-bottom: 10px" autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label>ถึงวันที่</label>
                                    <input required type="text" name="to_date" id="datepicker2" class="form-control" placeholder="ถึงวันที่" style="margin-bottom: 10px" autocomplete="off">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputControl">ชื่อผู้ควบคุม</label>
                                    <input type="text" class="form-control" name="jobController" placeholder="ชื่อผู้ควบคุม">
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->                    
                    <div class="card card-default">
                        <div class="card-header">
                            <h5 class="card-title"> รายละเอียดรถที่ขนย้าย </h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCar">ทะเบียนรถ</label>
                                    <input type="text" class="form-control" name="carLicense" placeholder="สถานที่ตั้ง">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputCarNum">เลขตัวถัง</label>
                                    <input type="text" class="form-control" name="carChasis" placeholder="เลขตัวถัง">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputBrand">ยี่ห้อ</label>
                                    <input type="text" class="form-control" name="carBrand" placeholder="ยี่ห้อ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputModel">รุ่น</label>
                                    <input type="text" class="form-control" name="carModel" placeholder="รุ่น">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputModel">ประเภทรถ</label>
                                    <input type="text" class="form-control" name="carType" placeholder="ประเภทรถ">
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->                    
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary" name="saveJob">บันทึก</button>
            </div>
        </div>
    </div><!--Modal End-->
</form>

</main>

<?php
require '__layout/footer.php';
?>