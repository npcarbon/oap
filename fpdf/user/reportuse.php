<?php
$index = "";
$addjob = "";
$user = "";
$upload = "";
$trader = "";
$report = "";
$reportuse = "active";
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
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> รายงานการใช้งานระบบ </h3>
                </div>
                    <!-- /.card-header -->
                    <section class="content">
                        <div class="container-fluid">
                            <!-- search -->
                            <div class="card-body">
                                <form action"" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <center><strong><label>ค้นหาจากวันที่</label></strong></center>
                                            <input type="text" name="from_date" id="datepicker1" class="form-control" placeholder="จากวันที่" style="margin-bottom: 10px">
                                        </div>
                                        <div class="col-md-6">
                                            <center><strong><label>ค้นหาถึงวันที่</label></strong></center>
                                            <input type="text" name="to_date" id="datepicker2" class="form-control" placeholder="ถึงวันที่" style="margin-bottom: 10px">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm btn-block" style="margin-bottom: 50px">ตกลง</button>
                                </form>
                            <!-- end search -->
                                        <table class="table">
                                            <tr>
                                                <th> ลำดับ </th>
                                                <th> ชื่อผู้ใช้ </th>
                                                <th> เวลาเข้าใช้งาน </center></th>
                                            </tr>
                                            <tbody>
                                <?php 
                                if (isset($_POST['from_date'])) {
                                    $from_date =  date_create($_POST['from_date']);
                                    $to_date =  date_create($_POST['to_date']);
                                    // getUsage($form, $to);
                                    $getUsage = $conn->query('SELECT authen.user_name, file_login.DateLogin FROM `file_login`
                                    INNER JOIN authen ON authen.auth_id = file_login.user_id
                                    WHERE `DateLogin` BETWEEN "' .  date_format($from_date,"Y/m/d H:i:s") . '" AND "' .  date_format($to_date,"Y/m/d H:i:s") . '"');
                                    $i =0;
                                    while ($log = $getUsage->fetch_assoc()) {
                                        $date = date_create($log['DateLogin']);
                                        $i++;
                                        echo '
                                                <tr>
                                                    <td> ' . $i . ' </td>
                                                    <td> ' . $log['user_name'] . ' </td>
                                                    <td> ' . date_format($date,"d M Y ") . ' </td>
                                                </tr>
                                        ';
                                    }
                                    
                                }
                                ?>
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
