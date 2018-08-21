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
?>

<body>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div style="padding-top:20px;">
        <!-- Start Content Here -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> รายงานการขนย้ายกัมมันตรังสี </h3>
                </div>
                    <!-- /.card-header -->
                    <section class="content">
                	    <div class="container-fluid">
                    	    <!-- search -->
                            <!-- end search -->
                            <div class="card-body">
                                    <form action"" method="POST">
                                        <div class="form-group">
                                            <center><strong><label>เลขที่ใบอนุญาต</label></strong></center>
                                            <input type="text" class="form-control" placeholder="เลขที่ใบอนุญาต" name="license" value="<?= $_POST['license']; ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <center><strong><label>ค้นหาจากวันที่</label></strong></center>
                                                    <input autocomplete="off" required value="<?= $_POST['from_date']; ?>" type="text" name="from_date" id="datepicker1" class="form-control" placeholder="จากวันที่" style="margin-bottom: 10px">
                                                </div>
                                                <div class="col-md-6">
                                                    <center><strong><label>ค้นหาถึงวันที่</label></strong></center>
                                                    <input required value="<?= $_POST['to_date']; ?>" type="text" name="to_date" id="datepicker2" class="form-control" placeholder="ถึงวันที่" style="margin-bottom: 10px">
                                                </div>
                                            </div>
                                                <button type="submit" class="btn btn-success btn-sm btn-block" style="margin-bottom: 50px">ตกลง</button>
                                        </div>
                                    </form>
                                        <?php
                                            if (isset($_POST['license'])) { 
                                                ?>
                                                <table class="table table-bordered">
                                                                                <tr>
                                                                                    <th rowspan="3"><center> ลำดับ </center></th>
                                                                                    <th colspan="8"><center> รายละเอียดวัสดุพลอยได้ </center></th>
                                                                                    <th colspan="4" ><center> ภาชนะบรรจุ/เครื่องมือ/เครื่องจักร </center></th>
                                                                                    <th colspan="2"><center> สถานะภาพวัสดุ </center></th>
                                                                                    <th rowspan="3"><center> ตั้งแต่วันที่-วันที่ </center></th>
                                                                                    <th rowspan="3" style="max-width:75px;"><center> ผู้ควบคุม </center></th>
                                                                                    <th rowspan="3" style="max-width:100px;"><center> รถที่ใช้ขนย้าย </center></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th rowspan="2" style="max-width:65px;"><center> ธาตุเลขมวล </center></th>
                                                                                    <th rowspan="2" style="max-width:65px;"><center> ผู้ผลิต </center></th>
                                                                                    <th rowspan="2" style="max-width:65px;"><center> รุ่นรหัสสินค้า </center></th>
                                                                                    <th rowspan="2" style="max-width:85px;"><center> หมายเลข </center></th>
                                                                                    <th rowspan="2" style="max-width:100px;"><center> สมบัติทางกายภาพ (1.ของแข็ง 2.ของเหลว 3.ก๊าซ) </center></th>
                                                                                    <th colspan="3"><center> กัมมันตภาพ /น้ำหนัก</center></th>
                                                                                    <th rowspan="3"><center> ผู้ผลิต </center></th>
                                                                                    <th rowspan="2" style="max-width:65px;"><center> รุ่นรหัสสินค้า </center></th>
                                                                                    <th rowspan="2" style="max-width:65px;"><center> หมายเลข </center></th>
                                                                                    <th rowspan="2" style="max-width:75px;"><center> ความจุกัมมันตภาพ /น้ำหนักสูงสุด </center></th>
                                                                                    <th rowspan="2"><center> เดิม </center></th>
                                                                                    <th rowspan="2"><center> ไปที่ </center></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th rowspan="2"><center> ปริมาณ </center></th>
                                                                                    <th rowspan="2"><center> ณ วันที่ </center></th>
                                                                                    <th rowspan="2"><center> จำนวน </center></th>
                                                                                </tr>
                                                                            <tbody>
                                                
                                                <?php
                                                echo '
                                                <input type="text" name="license" hidden value="'.$_POST['license'].'">
                                                '. getReport($_POST['license'], $_POST['from_date'], $_POST['to_date']) .' 
                                                <a target="_blank" type="button" class="btn btn-success btn-sm" href="../pdf.php?license='. $_POST["license"].'&&from_date='.$_POST["from_date"].'&&to_date='.$_POST["to_date"].'">PDF</a>
                                                
                                                ';
                                            } else {

                                            }
                                        ?>
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
