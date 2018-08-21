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
		<div style="padding-top:50px;">
		<!-- Start Content Here -->

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">สร.3</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">GPS Tracking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li> -->
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form action="../function/database.php" method="post" name="mainfrm" enctype="multipart/form-data">
                    <div class="jumbotron">
                        <h1 class="display-8">อัพโหลดไฟล์ (สร.3)</h1>
                        <div style="padding-top:10px;">
                            <div class="col-xs-3">
                                <!-- <select name="traders" class="form-control" style="margin-bottom:20px; width:300px;">
                                    <option value="">เลือกผู้ประกอบการ</option>
                                    
                                </select> -->
                                <input type="file" name="fileUpload">
                                <div style="padding-top: 10px">
                                    <p style="color:red;">*หมายเหตุ : อัพโหลดเฉพาะไฟล์ CSV เท่านั้น</p>
                                    <a target="_blank" href="https://drive.google.com/open?id=1DkZH_9WqApw7CYJVwmenS6O32V0VMLWr">รูปแบบการบรรทึก สร.3</a> ||
                                    <a target="_blank" href="assets/Excel2CSV.pdf">วิธีการแปลงไฟล์จาก xlmn(Excel) เป็น CSV</a>

                                </div>
                                <div style="padding-top:15px;">
                                <button type="submit" class="btn btn-primary" name="jobUL">อัพโหลดไฟล์</button>
                                </div>
                            </div>
                        </div>
                    </div>                      
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="jumbotron">
                <h1 class="display-8">อัพโหลดไฟล์ (GPS Tracking)</h1>
                    <div style="padding-top:10px;">
                        <div class="col-xs-3">
                        <form action="function/database.php" method="post">
                            <input type="file" name="fileUpload" class="form-control">
                            <div style="padding-top: 10px">
                                <p style="color:red;">*หมายเหตุ : อัพโหลดเฉพาะไฟล์ KML เท่านั้น</p>
                            </div>
                            <div style="padding-top:15px;">
                                <button type="submit" class="btn btn-primary" name="kmlUL">อัพโหลดไฟล์</button>
                            </div>
                        
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
		<!-- End Content Here -->
		</div>
		</main>
		<?php
require '../__layout/footer.php';
?>