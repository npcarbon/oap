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

$result = userDetails();
?>


<body>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div style="padding-top:20px;">
      <!-- Start Content Here -->
      <section class="content">
        <div class="container-fluid" >
          </div>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> เปลี่ยนรหัสผ่าน</h3>
            </div><!-- /.card-header -->
            <div class="card-body">
            <form action="../function/database.php" method="post">
                                    
                                <div class="form-group">
                                    <label for="inputType">E-mail</label>
                                    <input type="email" disabled class="form-control" name="email" placeholder="E-mail" required value="<?= $result['user_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">รหัสผู้ใช้งานเดิม</label>
                                    <input type="password" class="form-control" name="password" placeholder="รหัสผู้ใช้งานเดิม" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">รหัสผู้ใช้งานใหม่</label>
                                    <input id="password" type="password" class="form-control" name="txt_password" placeholder="รหัสผู้ใช้งานใหม่" required>
                                </div>
                                <div class="form-group" style="padding-bottom:20px;">
                                    <label for="inputName">กรอกรหัสผู้ใช้ใหม่งานอีกครั้ง</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="confirm_pass" placeholder="กรอกรหัสผู้ใช้ใหม่งานอีกครั้ง" required>
                                    <span id='message'></span>
                                </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block" name="editUser">ยืนยัน</button>
                                    <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.location='index.php'">ยกเลิก</button>
                            </form>

            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div><!-- /.container-fluid -->
      </section> <!-- /.content -->
    <!-- End Content Here -->
    </div>
  </main>
  <script>

$('#password, #password_confirmation').on('keyup', function () {
if ($('#password').val() == $('#password_confirmation').val()) {
  $('#message').html('Password Matched').css('color', 'green');
} else
  $('#message').html('Password Not Matched').css('color', 'red');
});
</script>
<?php
require '../__layout/footer.php';
?>
