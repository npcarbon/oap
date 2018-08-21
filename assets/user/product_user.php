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
        <!-- Start Content Here -->
        <div style="padding-top:20px;">
          <section class="content">
                <div class="container-fluid">
                    <!-- search -->
                    <div class="row">
                        <div class="col">
                            <form class="form-inline">
                              <div class="form-group mb-2" style="padding-right: 10px;">
                                <input type="text" class="form-control" id="txtSearch" placeholder="ค้นหา">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
                        </form>
                    </div>
                    
                </div>
                <!-- end search -->


                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title"> รายละเอียดสินค้า </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> รุ่น/รหัสสินค้า </th>
                            <th> ชื่อ </th>
                            <th> ผู้ผลิต </th>
                            <th> หมายเลข </th>
                            <th> ประเภท </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 000 </td>
                            <td> H2O </td>
                            <td> AOP </td>
                            <td> 0001 </td>
                            <td> H2O </td>
                            
                        </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td> 000 </td>
                        <td> H2O </td>
                        <td> AOP </td>
                        <td> 0002 </td>
                        <td> H2O </td>
                        
                    </tr>
                </tfoot>
            </table>
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

        <!-- End Content Here -->
