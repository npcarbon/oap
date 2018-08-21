<?php
$index = "active";
$addjob = "";
$user = "";
$upload = "";
$trader = "";
$report = "";
$reportuse = "";
require '../__layout/header.php';
if ($_SESSION['role_id'] == 1) {
  require '../__layout/navi.php';
}else {
  echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");window.history.go(-1);</script>';
}

?>

<body>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div style="padding-top:20px;">
        <!-- Start Content Here -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> การจัดการสิทธิ์การใช้งานระบบ </h3>
                </div>
                    <!-- /.card-header -->
                    <section class="content">
                	    <div class="container-fluid">
                    	    <!-- search -->
                            <!-- end search -->
                            <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="text-center">การจัดการข้อมูลผู้ใช้งานทั่วไป</th>
                                                    <th class="text-center">การจัดการข้อมูลผู้ประกอบการ</th>
                                                    <th class="text-center">การยืนยันผู้ขอเข้าใช้งานระบบ</th>
                                                    <th class="text-center">การจัดการข้อมูลการขนส่งฯ</th>
                                                    <th class="text-center">การนำเข้าไฟล์ข้อมูล</th>
                                                    <th class="text-center">รายงานการขนส่งฯ</th>
                                                    <th class="text-center">รายงานการเกิดอุบัติเหตุ</th>
                                                    <th class="text-center">รายงานการเข้าใช้งานระบบฯ</th>
                                                    <th class="text-center">ข้อมูลการติดตั้ง GPS</th>
                                                    <th class="text-center">ระบบติดตามรถขนส่งฯ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="row" class="text-center">ผู้ดูแลระบบ</td>
                                                    <?php viewRoles(1) ?>
                                                </tr>
                                                <tr>
                                                    <td scope="row" class="text-center">ผู้ใช้งานทั่วไป</td>
                                                    <?php viewRoles(2) ?>
                                                </tr>
                                                <tr>
                                                    <td scope="row" class="text-center">ผู้ประกอบการ</td>
                                                    <?php viewRoles(3) ?>
                                                </tr>
                                            </tbody>
                                        </table>
                            </div> <!-- /.card-body -->
                        </div><!-- /.container-fluid -->
                    </section> <!-- /.content -->
                </div> <!-- /.card -->
        <!-- End Content Here -->
        </div>
    </main>

<?php
require '../__layout/footer.php';
?>
