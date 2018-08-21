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
if (isset($_POST['saveJob'])) {
    addjob();
    }
?>


<body>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div style="padding-top:20px;">
      <!-- Start Content Here -->
      <section class="content">
        <div class="container-fluid">
          <!-- search -->
          <div class="row">
            <div class="col-md-11">
              <form class="form-inline" method="post">
                <div class="form-group mb-2" style="padding-right: 10px;">
                  <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา">
                </div>
                <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
              </form>
            </div>
            <div class="col-md-1">
            <a type="submit" class="btn btn-warning float- btn-sm " data-toggle="modal" data-target="#exampleModal">เพิ่ม</a>
              <!-- <a target="_blank" type="button" class="btn btn-success btn-sm float-right" href="../pdf1.php">PDF</a>-->
            </div>

          </div>
        <form action"" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <center><strong><label>ค้นหาจากวันที่</label></strong></center>
                    <input type="text" name="from_date" id="datepicker1" class="form-control" placeholder="จากวันที่" style="margin-bottom: 10px" autocomplete="off">
                </div>
                <div class="col-md-6">
                    <center><strong><label>ค้นหาถึงวันที่</label></strong></center>
                    <input type="text" name="to_date" id="datepicker2" class="form-control" placeholder="ถึงวันที่" style="margin-bottom: 10px" autocomplete="off">
                </div>
            </div>
            <button type="submit" name="getfromdate" class="btn btn-success btn-sm btn-block" style="margin-bottom: 50px">ตกลง</button>
        </form>

          <!-- end search -->


          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> รายละเอียดงาน </h3>
            </div>
            <!-- /.card-header -->
            <?php
            if(isset($_POST['jobid'])){
                foreach($_POST['jobid'] as $id){
                    echo "$id</br>";
                }
            }
                ?>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="../pdf1.php" method="POST" target="_blank">
                    <button type="submit" class="btn btn-success float- btn-sm" name="pdf">PDF</button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="align-middle"> </th>
                                    <th class="align-middle"> ธาตุ-เลขมวล </th>
                                    <th class="align-middle"> รุ่น/รหัสสินค้า </th>
                                    <th class="align-middle"> ปริมาณ </th>
                                    <th class="align-middle"> จำนวน </th>
                                    <th class="align-middle"> จุดเริ่มต้น </th>
                                    <th class="align-middle"> จุดหมาย </th>
                                    <th class="align-middle"> วันที่เริ่ม-สิ้นสุด </th>
                                    <th class="align-middle"> ผู้ควบคุม </th>
                                    <th class="align-middle"> ทะเบียนรถ </th>
                                    <th style="text-align:center">  </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if (isset($_POST['txtSearch'])) {
                                    getJob($_POST['txtSearch']);
                                }elseif (isset($_POST['getfromdate'])) {
                                    $from_date =  date_create($_POST['from_date']);
                                    $to_date =  date_create($_POST['to_date']);
                                    jobFromDate($from_date, $to_date);
                                }
                                else {
                                    getJob($_POST['txtSearch']);
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
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
                                    <select required name="chmName" class="form-control" style="margin-bottom: 10px" width="500px">
                                    <option value="" >เลือกธาตุเลขมวล</option>
                                        <?php getChm(); ?>
                                    </select>

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
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="chmVolume" placeholder="ปริมาณ">
                                        </div>
                                        <div class="col-6">
                                            <select required name="mas" class="form-control" style="margin-bottom: 10px" width="500px">
                                            <option value="" >เลือกหน่วยวัด</option>
                                            <?php 
                                                getMas();
                                            ?>
                                            </select>
                                        </div>
                                    </div>

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
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="pckVol" placeholder="ความจุ/น้ำหนักสูงสุด">
                                        </div>
                                        <div class="col-6">
                                            <select required name="mas2" class="form-control" style="margin-bottom: 10px" width="500px">
                                            <option value="" >เลือกหน่วยวัด</option>
                                            <?php 
                                                getMas();
                                            ?>
                                            </select>
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
                                    <input required type="text" name="from_date" id="datepicker3" class="form-control" placeholder="จากวันที่" style="margin-bottom: 10px" autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label>ถึงวันที่</label>
                                    <input required type="text" name="to_date" id="datepicker4" class="form-control" placeholder="ถึงวันที่" style="margin-bottom: 10px" autocomplete="off">
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
                <button type="submit" class="btn btn-primary"  name="saveJob" >บันทึก</button>
            </div>
        </div>
    </div><!--Modal End-->
</form>


    </div>
  </main>
  <?php
require '../__layout/footer.php';
?>
