<?php
$index = "";
$addjob = "";
$user = "";
$upload = "";
$trader = "";
$report = "";
$reportuse = "";
$approve = "active";

require '../__layout/header.php';
if ($_SESSION['role_id'] == 1) {
  require '../__layout/navi.php';
}else {
  echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");window.history.go(-1);</script>';
}
if (!empty($_GET['id'])) {
  allowTrader($_GET['id']);
}
?>


<body>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div style="padding-top:20px;">
      <!-- Start Content Here -->
      <section class="content">
        <div class="container-fluid" >
          <!-- search -->
          <div class="row">
            <div class="col">
              <form class="form-inline" action="" method="post">
                <div class="form-group mb-2" style="padding-right: 10px;">
                  <input type="text" class="form-control" id="txtSearchUser" name="txtSearchUser" placeholder="ค้นหา">
                </div>
                <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
              </form>
            </div>
            <!-- end search -->
           
          </div>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> รายการการขอเข้าใช้งานระบบ</h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th> ชื่อผู้ประกอบการ </th>
                      <th> รหัสหน่วยงาน </th>
                      <th> ใบอนุญาติ </th>
                      <th> ที่อยู่ </th>
                      <th> หมายเลขโทรศัพท์ </th>
                      <th> หมายเลขโทรสาร </th>
                      <th> E-mail </th>
                      <th></th>
                    </tr>
                  </thead>
                  <?php nonActiveTraders(); ?>
                </table>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div><!-- /.container-fluid -->
      </section> <!-- /.content -->
    <!-- End Content Here -->
    </div>
  </main>