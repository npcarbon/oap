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
if ($_SESSION['role_id'] != 1) {
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
              <form class="form-inline" method="post">
                <div class="form-group mb-2" style="padding-right: 10px;">
                  <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา">
                </div>
                <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
              </form>
            </div>
          </div>
          <!-- end search -->


          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> รายละเอียดงาน </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
              <table class="table">
                <thead>
                <tr>
                  <th class="align-middle"> ชื่อผู้ประกอบการ </th>
                                <th class="align-middle"> ธาตุ-เลขมวล </th>
                                <!-- <th class="align-middle"> เลขที่จดทะเบียนสถานประกอบการ/เลขที่บัตรประชาชน </th> -->
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
                      getAllJob($_POST['txtSearch']);
                    }else {
                      getAllJob($_POST['txtSearch']);
                    }
                    ?>
                </tbody>
              </table>
            </div>
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
