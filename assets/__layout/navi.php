<nav class="navbar fixed-top flex-md-nowrap p-0 shadowrt2f" style="background-color: #1aa3ff;">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php" style="color:#FFF;"> <h5>OAP GPS</h5> </a>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="../function/logout.php" style="color:#FFF;">ออกจากระบบ</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= $index; ?>" href="index.php">
                                <span data-feather="home"></span> หน้าหลัก
                            </a>
                        </li>
                        <?php 
                        $show = chkRoles($_SESSION['role_id']);
                        if ($show['user'] == 1) {?>
                            <li class="nav-item">
                                <a class="nav-link <?= $user; ?>" href="user.php">
                                    <span data-feather="file"></span> ข้อมูลผู้ใช้งาน
                                </a>
                            </li>
                        <?php }
                        if ($show['usermanage'] == 1) {?>
                                                    <li class="nav-item">
                            <a class="nav-link <?= $user; ?>" href="usergroup.php">
                                <span data-feather="users"></span> จัดการสิทธิ์การเข้าถึง
                            </a>
                        </li>
                        <?php }
                        if ($show['traders'] == 1) {?>
                        <li class="nav-item">
                            <a class="nav-link <?= $trader; ?>" href="trader.php">
                                <span data-feather="users"></span> ผู้ประกอบการ
                            </a>
                        </li>
                        <?php }
                        if ($show['approve'] == 1) {?>
                        <li class="nav-item">
                            <a class="nav-link <?= $approve; ?>" href="approve.php">
                                <span data-feather="users"></span> รายการการขอเข้าใช้งานระบบ 
                                <span class="badge badge-danger"><?= countNonApprove(); ?></span>
                                <span class="sr-only">unread messages</span>
                            </a>
                        </li>
                        <?php }
                        if ($show['job'] == 1) {?>
                        <li class="nav-item">
                            <a class="nav-link <?= $addjob; ?>" href="addjob.php">
                                <span data-feather="file"></span> รายละเอียดงาน
                            </a>
                        </li>
                        <?php }
                        if ($show['upload'] == 1) {?>
                        <li class="nav-item">
                            <a class="nav-link <?= $upload; ?>" href="upload.php">
                                <span data-feather="file"></span> นำเข้าไฟล์ข้อมูล
                            </a>
                        </li>
                        <?php }
                        if ($show['accidentreport'] == 1) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="accident.php">
                                <span data-feather="file"></span> รายงานปัญหาระหว่างขนย้ายกัมมันตรังสี
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span> รายงาน </span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                    <?php
                        if ($show['report'] == 1) {?>
                        <li class="nav-item">
                            <a class="nav-link <?= $report; ?>" href="report.php">
                                <span data-feather="file-text"></span> รายงานการขนส่งกัมมันตรังสี
                            </a>
                        </li>
                        <?php }
                        if ($show['accidentreport'] == 1) {?>
                            
                        <li class="nav-item">
                            <a class="nav-link <?= $report; ?>" href="accidentreport.php">
                                <span data-feather="file-text"></span> รายงานการเกิดอุบัติเหตุระหว่างการขนส่ง
                            </a>
                        </li>
                            
                        <?php }
                        if ($show['reportuse'] == 1) {?>
                            
                        <li class="nav-item">
                            <a class="nav-link <?= $reportuse; ?>" href="reportuse.php">
                                <span data-feather="file-text"></span> รายงานการใช้งานระบบ
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span> ระบบการติดตาม </span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                            
                        <?php 
                        if ($show['GPS'] == 1) {?>
                            
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="http://oapgps.thaigps.com/dlt_webservice/">
                                <span data-feather="file-text"></span> ข้อมูลการติดตั้ง GPS ในรถบรรทุก/รถโดยสารสาธารณะ
                            </a>
                        </li>
                            
                        <?php }
                        if ($show['GPS2'] == 1) {
                            if ($_SESSION['role_id'] != 3 ) {?>
                                <li class="nav-item">
                                    <form id="login1" action="http://as02.thaigps.com/gg3my/Login.aspx" method="post">
                                        <a class="nav-link" target="_blank" href="javascript:{}" onclick="document.getElementById('login1').submit(); return false;">
                                            <!-- Your Form -->    
                                            <input type="hidden" name="inUsername" value="oapadmin2" >
                                            <input type="hidden"  name="inPassword" value="1234" >
                                            <span data-feather="file-text"></span> ระบบติดตามรถขนส่งวัสดุกัมมันตรังสี
                                        </a>
                                    </form>
                                </li>

                            <?php } else { ?>
                                <li class="nav-item">
                                        <a class="nav-link" target="_blank" href="http://as02.thaigps.com/gg3my/">
                                            <span data-feather="file-text"></span> ระบบติดตามรถขนส่งวัสดุกัมมันตรังสี
                                        </a>
                                </li>
                           <?php }
                           }?>

                    </ul>
                </div>
            </nav>
