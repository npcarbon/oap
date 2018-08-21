<?php require 'function/database.php';?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Custom styles for this template -->
</head>

<body style="background:#f2f2f2;">
    <main role="main" class="col-md-12 col-lg-12 px-10">
        <!-- Start Content Here -->
        <div style="padding-top:20px;">
           <section class="content">
                <div class="container">
                    <div class="jumbotron" style="background:#b3e6ff;">
                        <div class="text-center" style="padding-bottom:50px;">
                            <img src="assets/images/oap-banner-white.png" alt="" class="rounded mx-auto d-block">
                            <h2>ยินดีต้อนรับสู่ระบบติดตามยานพาหนะขนส่งกัมมันตรังสี</h2>
                            <h4>กรุณาลงทะเบียนเพื่อเข้าสู่การใช้งาน</h4>
                        </div>
                            <form action="function/database.php" method="post">
                                    
                                    <div class="form-group">
                                        <label for="inputEmail4">ชื่อผู้ประกอบการ</label>
                                        <input type="Product" class="form-control" name="trader_name" placeholder="ชื่อผู้ประกอบการ" require>
                                    </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputProducer">เลขที่จดทะเบียนสถานประกอบการ/เลขที่บัตรประชาชน</label>
                                        <input type="text" class="form-control" name="trader_code" placeholder="รหัสหน่วยงาน" require>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputProducer">ใบอนุญาตเลขที่</label>
                                        <input type="text" class="form-control" name="license" placeholder="ใบอนุญาตเลขที่" require>
                                    </div>
                                </div>
                                 	
                                <div class="form-row" style="padding-bottom:20px;">
                                    <div class="form-group col-md-6">
                                        <label for="inputProductName">ที่อยู่</label>
                                        <textarea class="form-control" style="min-height:110px;" name="address" require></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputNumber">หมายเลขโทรศัพท์</label>
                                        <input type="text" class="form-control" name="telephone" placeholder="หมายเลขโทรศัพท์" require>
                                        <label for="inputType">หมายเลขโทรสาร</label>
                                        <input type="text" class="form-control" name="fax" placeholder="หมายเลขโทรสาร">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputType">E-mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">รหัสผู้ใช้งาน</label>
                                    <input id="password" type="password" class="form-control" name="txt_password" placeholder="รหัสผู้ใช้งาน" required>
                                </div>
                                <div class="form-group" style="padding-bottom:20px;">
                                    <label for="inputName">กรอกรหัสผู้ใช้งานอีกครั้ง</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="confirm_pass" placeholder="รหัสผู้ใช้งาน" required>
                                    <span id='message'></span>
                                </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block" name="saveTrader">ยืนยัน</button>
                                    <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.location='login.php'">ยกเลิก</button>
                            </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>

    $('#password, #password_confirmation').on('keyup', function () {
    if ($('#password').val() == $('#password_confirmation').val()) {
      $('#message').html('Password Matched').css('color', 'green');
    } else
      $('#message').html('Password Not Matched').css('color', 'red');
  });
  </script>
</body>

</html>
