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
}?>

<body>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <!-- Start Content Here -->
            <div class="text-center" style="padding-top:50px;">
                <img src="../assets/images/oap-banner-white.png" alt="" class="rounded mx-auto d-block">
                    <div style="padding-top: 20px">
                        <h2>ยินดีต้อนรับสู่ระบบติดตามยานพาหนะขนส่งวัสดุกัมมันตรังสี</h2>
                    </div>
            </div>
        <!-- End Content Here -->

    </main>
<?php
require '../__layout/footer.php';
?>
