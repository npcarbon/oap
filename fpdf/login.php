<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/images/favicon.ico">


    <title>สำนักงานปรมาณูเพื่อสันติ</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
<style type="text/css">
html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 550px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>

  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="function/database.php">
    <img src="assets/images/oap-banner-white.png" alt="" class="rounded mx-auto d-block" width="500px;">
      <div style="padding-top: 7px">
        <h1 class="h3 mb-3 font-weight-normal">กรุณาเข้าสู่ระบบ</h1>
      </div> 
      <label for="inputEmail" class="sr-only">ชื่อผู้ใช้งานหรืออีเมล</label>
      <input type="text" name="txtUsername" id="inputEmail" class="form-control" placeholder="ชื่อผู้ใช้งานหรืออีเมล" required autofocus>
      <label for="inputPassword" class="sr-only">รหัสผ่าน</label>
      <input type="password" name="txtPassword" id="inputPassword" class="form-control" placeholder="รหัสผ่าน" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">ลงชื่อเข้าใช้งาน</button>
      <button class="btn btn-sm btn-secondary btn-block" type="button" onclick="window.location='register.php'">ลงทะเบียนเพื่อเข้าใช้งานระบบ(สำหรับผู้ประกอบการ)</button>
      
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  </body>
</html>
