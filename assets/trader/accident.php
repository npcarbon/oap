<?php
$index = "";
$addjob = "";
$user = "";
$upload = "";
$trader = "";
$report = "";
$reportuse = "active";

require '../function/database.php';
    if (!@isset($_SESSION['login'])) {
        header("Location: ../login.php");
        exit;
    }

    if (!empty($_POST['button'])) {
        $id = $_POST['traders'];
        addAccident($id);
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>สำนักงานปรมาณูเพื่อสันติ</title>
    <link rel="stylesheet" type="text/css" href="../assets/jquery.datetimepicker.css"/>

    <!-- Bootstrap core CSS -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script>
            /*jslint browser:true*/
            /*global jQuery, document*/

            jQuery(document).ready(function () {
                'use strict';

                jQuery('#search-from-date').datetimepicker({format:'Y-m-d H:i:s'});
            });
        </script>
        <style>
/* css กำหนดความกว้าง ความสูงของแผนที่ */
#map_canvas { 
    width:70%;
    height:400px;
    margin:auto;
}
/* css กำหนดส่วนของการแสดง list menu */
div#list_menu_place{
    width:550px;
    margin:auto;    
}

</style>
</head>
<?php  require '../__layout/navi.php'; 
if ($_SESSION['role_id'] != 3) {
  echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");window.history.go(-1);</script>';
}
?>



<body>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div style="padding:20px;">
        <!-- Start Content Here -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> รายงานปัญหาระหว่างขนย้ายกัมมันตรังสี </h3>
                </div>
                <!-- /.card-header -->
                <div style="padding-top: 20px">
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="card-body">
                            <form action"" method="post">
                                <div class="container">
                                    <h4 style="padding-left: 20px"> 1.Enter Information </h4>
                                    <?php 
                                        if ($_SESSION['role_id'] != 3) {
                                    ?>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <strong><label>ผู้ประกอบการ</label></strong>
                                                    <select required name="traders" class="form-control" style="margin-bottom: 10px" width="500px">
                                                        <option value="" >เลือกผู้ประกอบการ</option>
                                                        <?php selectTrader();?>
                                                    </select>
                                                </div>
                                            </div>
                                    <?php                                             
                                        } else {
                                        
                                        }
                                    ?>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong><label>วันเวลาที่เกิดเหตุ</label></strong>
                                            <input required type="text" name="date" id="search-from-date" class="form-control" placeholder="วันเวลาที่เกิดเหตุ" style="margin-bottom: 10px" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong><label for="inputProducer">ทะเบียนรถ</label></strong>
                                            <input type="text" class="form-control" name="carLicence" placeholder="ทะเบียนรถ" require>
                                        </div>
                                    </div>
                                    <div class="form-row" style="padding-bottom:20px;">
                                        <div class="form-group col-md-12">
                                            <strong><label for="inputProductName">รายละเอียดการเกิดปัญหา</label></strong>
                                            <textarea class="form-control" style="min-height:110px;" name="accident" require></textarea>
                                        </div>
                                    </div>
                                    <h3 class="card-title"> 2.Select Location </h3>
                                    <?php require '../test.php'; ?>
                                    <input type="submit" class="btn btn-primary btn-block" name="button" id="button" value="บันทึก" />  
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div><!-- /.container-fluid -->
                </section> <!-- /.content -->
            </div> <!-- /.card -->
        <!-- End Content Here -->
        </div>
    </main>
    <script src="../assets/jquery.js"></script>
    <script src="../assets/build/jquery.datetimepicker.full.js"></script>

<?php
require '../__layout/footer.php';
?>
