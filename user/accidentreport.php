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
                    <h3 class="card-title"> รายงานการขนย้ายวัสดุกัมมันตรังสี </h3>
                </div>
                    <!-- /.card-header -->
                    <section class="content">
                	    <div class="container-fluid">
                    	    <!-- search -->
                            <!-- end search -->
                            <div class="card-body">
                            <form action"" method="POST">
                                        <div class="form-group">
                                            <center><strong><label>ทะเบียนรถ</label></strong></center>
                                            <select name="truck" class="form-control" style="margin-bottom: 10px" width="500px">
                                                <option value="" >เลือกทะเบียนรถ</option>
                                                <?php getTruck();?>
                                            </select>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <center><strong><label>ค้นหาจากวันที่</label></strong></center>
                                                    <input autocomplete="off" required value="<?= $_POST['from_date']; ?>" type="text" name="from_date" id="datepicker1" class="form-control" placeholder="จากวันที่" style="margin-bottom: 10px">
                                                </div>
                                                <div class="col-md-6">
                                                    <center><strong><label>ค้นหาถึงวันที่</label></strong></center>
                                                    <input autocomplete="off" required value="<?= $_POST['to_date']; ?>" type="text" name="to_date" id="datepicker2" class="form-control" placeholder="ถึงวันที่" style="margin-bottom: 10px">
                                                </div>
                                            </div>
                                                <button type="submit" class="btn btn-success btn-sm btn-block" style="margin-bottom: 50px">ตกลง</button>
                                        </div>
                                    </form>
                                        <?php
                                            if (isset($_POST['truck'])) { 
                                                ?>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th><center> ลำดับ </center></th>
                                                        <th><center> ทะเบียนรถ </center></th>
                                                        <th><center> ช่วงเวลา </center></th>
                                                        <th><center> สาเหตุ </center></th>
                                                        <th><center> พื้นที่ </center></th>
                                                        <!-- <th><center> ละติจูด </center></th>
                                                        <th><center> ลองติจูด </center></th> -->
                                                    </tr>
                                                <tbody>
                                                
                                                <?php
                                                getAccidentReport($_POST['truck'], date_create($_POST['from_date']), date_create($_POST['to_date'])) ;
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
