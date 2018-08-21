<?php
$index = "active";
$addjob = "";
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

$trader = traderDetails();
?>


<body>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div style="padding-top:20px;">
      <!-- Start Content Here -->
      <section class="content">
        <div class="container-fluid" >
          </div>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> ข้อมูลผู้ใช้งาน</h3>
            </div><!-- /.card-header -->
            <div class="card-body">
            <form action="../function/database.php" method="post">
                                    
                                    <div class="form-group">
                                        <label for="inputEmail4">ชื่อผู้ประกอบการ</label>
                                        <input type="Product" class="form-control" name="trader_name" placeholder="ชื่อผู้ประกอบการ" require value="<?= $trader['trader_name'] ?>">
                                    </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputProducer">เลขที่จดทะเบียนสถานประกอบการ/เลขที่บัตรประชาชน</label>
                                        <input type="text" class="form-control" name="trader_code" placeholder="เลขที่จดทะเบียนสถานประกอบการ/เลขที่บัตรประชาชน" require value="<?= $trader['trader_code'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputProducer">ใบอนุญาตเลขที่</label>
                                        <input type="text" class="form-control" name="license" placeholder="ใบอนุญาตเลขที่" require value="<?= $trader['license'] ?>">
                                    </div>
                                </div>
                                 	
                                <div class="form-row" style="padding-bottom:20px;">
                                    <div class="form-group col-md-6">
                                        <label for="inputProductName">ที่อยู่</label>
                                        <textarea class="form-control" style="min-height:110px;" name="address" require><?= $trader['address'] ?></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputNumber">หมายเลขโทรศัพท์</label>
                                        <input type="text" class="form-control" name="telephone" placeholder="หมายเลขโทรศัพท์" require value="<?= $trader['telephone'] ?>">
                                        <label for="inputType">หมายเลขโทรสาร</label>
                                        <input type="text" class="form-control" name="fax" placeholder="หมายเลขโทรสาร">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputType">E-mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="E-mail" required value="<?= $trader['email'] ?>">
                                </div>
                               <!--  <div class="form-group">
                                    <label for="inputName">รหัสผู้ใช้งาน</label>
                                    <input id="password" type="password" class="form-control" name="txt_password" placeholder="รหัสผู้ใช้งาน" required>
                                </div>
                                <div class="form-group" style="padding-bottom:20px;">
                                    <label for="inputName">กรอกรหัสผู้ใช้งานอีกครั้ง</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="confirm_pass" placeholder="รหัสผู้ใช้งาน" required>
                                    <span id='message'></span>
                                </div> -->
                                    <button type="submit" class="btn btn-success btn-lg btn-block" name="editTrader">ยืนยัน</button>
                                    <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.location='index.php'">ยกเลิก</button>
                            </form>

            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div><!-- /.container-fluid -->
      </section> <!-- /.content -->
    <!-- End Content Here -->
    </div>
  </main>

<?php
require '../__layout/footer.php';
?>
