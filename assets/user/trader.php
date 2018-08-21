<?php
$index = "";
$addjob = "";
$user = "";
$upload = "";
$trader = "active";
$report = "";
$reportuse = "";
require '../__layout/header.php';
require '../__layout/navi.php';
if ($_SESSION['role_id'] != 2) {
  echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");window.history.go(-1);</script>';
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
                        <div class="col">
                            <form class="form-inline" action="" method="post">
                              <div class="form-group mb-2" style="padding-right: 10px;">
                                <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา">
                                </div>
                            <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
                            </form>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success mb-2 float-right" data-toggle="modal" data-target="#exampleModal">เพิ่ม</button>
                        </div>
                    </div>
<!-- end search -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"> ข้อมูลผู้ประกอบการ </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th> ชื่อผู้ประกอบการ</th>
                                    <th> รหัสหน่วยงาน</th>
                                    <th> ที่อยู่ </th>
                                    <th> เบอร์โทรศัพท์ </th>
                                    <th> โทรสาร </th>
                                    <th> E-mail </th>
                                    <th>  </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (isset($_POST['txtSearch'])) {
                                    getTrader($_POST['txtSearch']);
                                  }else {
                                    getTrader($_POST['txtSearch']);
                                  }
                                 ?>
                            </tbody>
                          </table>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->

                <form action="../function/database.php" method="post">
                    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลผู้ประกอบการ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                            <label for="inputEmail4">ชื่อผู้ประกอบการ</label>
                                            <input type="Product" class="form-control" name="trader_name" placeholder="ชื่อผู้ประกอบการ" require>
                                        </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputProducer">เลขที่จดทะเบียนสถานประกอบการ/เลขที่บัตรประชาชน</label>
                                            <input type="text" class="form-control" name="trader_code" placeholder="รหัสหน่วยงาน" require>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputProducer">ใบอนุญาตเลขที่</label>
                                            <input type="text" class="form-control" name="license" placeholder="ใบอนุญาตเลขที่" require>
                                        </div>
                                    </div>
                                        
                                    <div class="form-row" style="padding-bottom:20px;">
                                        <div class="form-group col-md-6">
                                            <label for="inputProductName">ที่อยู่</label>
                                            <textarea class="form-control" style="min-height:110px;" name="address" require></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputNumber">หมายเลขโทรศัพท์</label>
                                            <input type="text" class="form-control" name="telephone" placeholder="หมายเลขโทรศัพท์" require>
                                            <label for="inputType">หมายเลขโทรสาร</label>
                                            <input type="text" class="form-control" name="fax" placeholder="หมายเลขโทรสาร">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputType">E-mail</label>
                                        <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-primary" name="saveTrader">บันทึก</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                </div><!-- /.container-fluid -->
            </section> <!-- /.content -->
        <!-- End Content Here -->
    </main>
<?php
require '../__layout/footer.php';
?>
