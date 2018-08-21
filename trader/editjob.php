<?php
$index = "";
$addjob = "active";
$user = "";
$upload = "";
$trader = "";
$report = "";
$reportuse = "";
require '../__layout/header.php';
require '../__layout/navi.php';
if ($_SESSION['role_id'] != 3) {
  echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");window.history.go(-1);</script>';
}
if (isset($_POST['editJob'])) {
    editJob($_GET["jobid"]);
    // if (editChm($_GET["jobid"])) {
    //     if (editPackage($_GET["jobid"])) {
    //         if (editTruck($_GET["jobid"])) {
    //             echo "<script>alert('เพิ่มรายละเอียดการขนย้ายเรียบร้อยแล้ว');window.location='addjob.php';</script>";

    //         }
                
    //     }
            
    // }
}
$job = getEditJob($_GET["jobid"]);
?>


<body>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div style="padding-top:20px;">
      <!-- Start Content Here -->
      <section class="content">
        <div class="container-fluid">

          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> แก้ไขรายละเอียดงาน </h3>
              <input type="hidden" name="job_id" value="<?= $_GET["jobid"] ?>">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form action="" method="post">

<div class="card card-default">
        <div class="card-header">
            <h5 class="card-title"> รายละเอียดวัสดุพลอยได้ </h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputElement">ธาตุเลขมวล</label>
                    <select required name="chmName" class="form-control" style="margin-bottom: 10px" width="500px">
                    <option value="<?= $job['chem_name']; ?>" ><?= $job['chem_name']; ?></option>
                        <?php getChm(); ?>
                    </select>

                </div>
                <div class="form-group col-md-4">
                    <label for="inputNumber">หมายเลข</label>
                    <input type="text" class="form-control" name="chmNumber" placeholder="หมายเลข" value="<?= $job['chem_no']; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputProductName">รหัสสินค้า</label>
                    <input type="text" class="form-control" name="chmCode" placeholder="รหัส/รุ่น" value="<?= $job['chem_code']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputProductName">ผู้ผลิต</label>
                    <input type="text" class="form-control" name="chmProducer" placeholder="ชื่อผู้ผลิต" value="<?= $job['chem_producer']; ?>">
                </div>


                <div class="form-group col-md-6">
                        <label for="inputProducer">สถานะทางกายภาพ</label>
                    <select name="chmStatus" class="form-control">
                        <option value="<?= $job['chem_status']; ?>" selected> <?= $job['chem_status']; ?></option>
                        <option>ของแข็ง</option>
                        <option>ของเหลว</option>
                        <option>ก๊าซ</option>
                    </select>
                </div>
            </div>                        
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputNumber">ปริมาณ</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="chmVolume" placeholder="ปริมาณ" value="<?= $job['volume']; ?>">
                        </div>
                        
                    </div>

                </div>
                <div class="col-md-4">
                    <label>ตรวจสอบวันที่</label>
                    <input required type="text" name="chkDate" class="form-control" placeholder="วันที่ตรวจสอบ" style="margin-bottom: 10px" value="<?= $job['Date']; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputMany">จำนวน</label>
                    <input type="text" class="form-control" name="chmQty" placeholder="จำนวน" value="<?= $job['Qty']; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="inputVol">การนำไปใช้งาน</label>
                    <input type="text" class="form-control" name="spending" placeholder="การนำไปใช้งาน" value="<?= $job['spending']; ?>">
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
                    <input type="text" class="form-control" name="pckProducer" placeholder="ชื่อผู้ผลิต" value="<?= $job['pack_producer']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputProCode">รหัส/รุ่นสินค้า</label>
                    <input type="text" class="form-control" name="pckCode" placeholder="รุ่น/รหัสสินค้า" value="<?= $job['code_name']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNumber">หมายเลข</label>
                    <input type="text" class="form-control" name="pckNumber" placeholder="หมายเลข" value="<?= $job['model']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputVol">ความจุ/น้ำหนักสูงสุด</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="pckVol" placeholder="ความจุ/น้ำหนักสูงสุด" value="<?= $job['pack_volume']; ?>">
                        </div>
                    </div>

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
                    <input type="text" class="form-control" name="fromPlace" placeholder="สถานที่ตั้ง" value="<?= $job['formPlace']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputNewLoc">ไปสถานที่</label>
                    <input type="text" class="form-control" name="toPlace" placeholder="ไปสถานที่" value="<?= $job['atPlace']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>จากวันที่</label>
                    <input required type="text" name="from_date" id="datepicker3" class="form-control" placeholder="จากวันที่" style="margin-bottom: 10px" autocomplete="off" value="<?= $job['formDate']; ?>">
                </div>
                <div class="col-md-6">
                    <label>ถึงวันที่</label>
                    <input required type="text" name="to_date" id="datepicker4" class="form-control" placeholder="ถึงวันที่" style="margin-bottom: 10px" autocomplete="off" value="<?= $job['atDate']; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="inputControl">ชื่อผู้ควบคุม</label>
                    <input type="text" class="form-control" name="jobController" placeholder="ชื่อผู้ควบคุม" value="<?= $job['controller']; ?>">
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
                    <input type="text" class="form-control" name="carLicense" placeholder="สถานที่ตั้ง" value="<?= $job['car_license']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCarNum">เลขตัวถัง</label>
                    <input type="text" class="form-control" name="carChasis" placeholder="เลขตัวถัง" value="<?= $job['chasis_no']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputBrand">ยี่ห้อ</label>
                    <input type="text" class="form-control" name="carBrand" placeholder="ยี่ห้อ" value="<?= $job['brand']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputModel">รุ่น</label>
                    <input type="text" class="form-control" name="carModel" placeholder="รุ่น" value="<?= $job['tmodel']; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="inputModel">ประเภทรถ</label>
                    <input type="text" class="form-control" name="carType" placeholder="ประเภทรถ" value="<?= $job['type']; ?>">
                </div>
            </div>
        </div> <!-- /.card-body -->
        <button type="submit" class="btn btn-primary"  name="editJob" >บันทึก</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>

    </div> <!-- /.card -->                    

</form>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div><!-- /.container-fluid -->
      </section> <!-- /.content -->
      <!-- End Content Here -->
      <!--Modal -->




    </div>
  </main>
  <?php
require '../__layout/footer.php';
?>
