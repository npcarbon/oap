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
            <div class="col">
              <button type="submit" class="btn btn-success mb-2 float-right" data-toggle="modal" data-target="#exampleModal">เพิ่ม</button>
            </div>
          </div>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> ข้อมูลผู้ใช้งาน</h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th> ชื่อ-นามสกุล </th>
                      <th> E-mail </th>
                      <th> หมายเลขโทรศัพท์ </th>
                      <th> ชื่อผู้ใช้งาน </th>
                      <th> ระดับผู้ใช้งาน </th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if (isset($_POST['txtSearchUser'])) {
                      getUser($_POST['txtSearchUser']);
                    }else {
                      getUser($_POST['txtSearchUser']);
                    }
                    ?>
                  </tbody>
                </table>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div><!-- /.container-fluid -->
      </section> <!-- /.content -->
    <!-- End Content Here -->
    </div>
  </main>

<!--Modal -->

<form action="../function/database.php" method="post">
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลผู้ใช้งานใหม่</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="inputName">ชื่อ</label>
                  <input type="text" class="form-control" name="f_name" placeholder="ชื่อ">
                </div>
                <div class="col">
                  <label for="inputLastname">นามสกุล</label>
                  <input type="text" class="form-control" name="l_name" placeholder="นามสกุล">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="inputName">ชื่อผู้ใช้งาน</label>
                  <input type="text" class="form-control" name="txt_username" placeholder="ชื่อผู้ใช้งาน">
                </div>
                <div class="col">
                  <label for="inputName">รหัสผู้ใช้งาน</label>
                  <input type="text" class="form-control" name="txt_password" placeholder="รหัสผู้ใช้งาน">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail">E-Mail</label>
              <input type="email" class="form-control" name="email" placeholder="E-Mail">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputTel">หมายเลขโทรศัพท์</label>
                <input type="text" class="form-control" name="telephone" placeholder="หมายเลขโทรศัพท์">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPermission">ระดับผู้ใช้งาน</label>
              <select name="roles" class="form-control">
                <option value="">เลือกระดับผู้ใช้งาน</option>
                <?php getRoles(); ?>
              </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary" name="save">บันทึก</button>
      </div>
    </div>
  </div><!--Modal End-->
</form>


<?php
require '../__layout/footer.php';
?>
