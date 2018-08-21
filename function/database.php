<?php
date_default_timezone_set("Asia/Bangkok");
$today = date("Y-m-d");

session_start();
$conn = condb();
///////////////////////////////Basic Function////////////////////////////////
function condb()
{
    $conn = new mysqli("localhost", "root", "password", "oap_db");
    // $conn = new mysqli("localhost", "root", "", "oap_db");
    // $conn = new mysqli("localhost", "sub1", "OAPsub@1234", "oap_db");
    // mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
if (isset($_POST['editTrader'])) {
    if (editTrader()) {
        echo '<script>alert("ข้อมูลของถูกแก้ไขแล้ว");window.history.go(-1);</script>';

    }
}
if (isset($_POST['editUser'])) {
    editUser();
}
if (isset($_POST['save'])) {
    if (addUserLogin()) {
        echo "<script>alert('เพิ่มผู้ใช้งานใหม่เรียบร้อยแล้ว');window.history.go(-1);</script>";
    } else {
        echo "<script>alert('กรุณาตรวจเช็คข้อมูลอีกครั้ง');window.history.go(-1);</script>";
    }
}
if (isset($_POST['txtID'])) {
    if (updateUser()) {
        echo "<script>alert('แก้ไขรายละเอียดเรียบร้อยแล้ว');window.location='../admin/user.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด...กรุณาลองใหม่อีกครั้ง ');window.history.go(-1);</script>";
    }
}

if (isset($_POST['saveTrader'])) {
    addTradeLogin();
}
if (isset($_POST['trader_id'])) {
    if (updateTrader()) {
        echo "<script>alert('แก้ไขรายละเอียดเรียบร้อยแล้ว');window.location='../admin/trader.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด...กรุณาลองใหม่อีกครั้ง ');window.history.go(-1);</script>";
    }
}
if (isset($_POST['jobUL'])) {
    if (trim($_FILES["fileUpload"]["tmp_name"])) {
        filesUpload();
        echo 'post success';
    }
}
if (isset($_POST['UL'])) {
    if (trim($_FILES["fileUpload"]["tmp_name"])) {
        insert();
        echo 'post success';
    }
}
if (isset($_POST['updateRole'])) {
    if (updateRoles($_POST['perm_id'])) {
        echo "<script>alert('แก้ไขรายละเอียดเรียบร้อยแล้ว');window.location='../admin/usergroup.php';</script>";
    }
    // echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");</script>';
}
/////////////////////////////for Login//////////////////////////////
/**
 *
 *
 *
 * Login Before user system
 *
 *
 *
 */

if (!empty($_POST['txtUsername'])) {
    Login();
}

/**
 *
 *
 *
 * Login to the system
 * And
 * Create session
 *
 *
 */
function Login()
{
    $conn = condb();
    $user = $_POST['txtUsername'];
    $pass = $_POST['txtPassword'];
    $query = $conn->query('SELECT * FROM authen WHERE user_name = "' . $user . '"');
    $result = $query->fetch_assoc();
    if (!$result["user_name"]) {
        echo "<script type='text/javascript'>alert('Email is Incorrect!');window.history.go(-1);</script>";
    } else {
        if (password_verify($pass, $result["pswd"])) {
            $_SESSION[login] = "true";
            $_SESSION['uid'] = $result["auth_id"];
            $_SESSION['UName'] = $result["user_name"];
            $_SESSION['role_id'] = $result["role_id"];
            session_write_close();
            if ($result['role_id'] == 1) {
                header("location:../admin/index.php");
            } elseif ($result['role_id'] == 2) {
                header("location:../user/index.php");
            } else {
                $trader = $conn->query("SELECT * FROM traders WHERE auth_id =" . $result['auth_id']);
                $chk = $trader->fetch_assoc();
                if ($chk['status'] == 1) {
                    if ($chk['dateExpired'] > $today) {
                        header("location:../trader/index.php");

                    } else {
                        echo "<script type='text/javascript'>alert('บัญชีของคุณหมดอายุ กรุณาติดต่อเจ้าหน้าที่อีกครั้ง');window.history.go(-1);</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('คุณยังไม่ได้รับการอนุมัติ กรุณาติดต่อเจ้าหน้าที่อีกครั้ง');window.history.go(-1);</script>";

                }
            }
        } else {
            echo 'Invalid password.';
        }
    }
    $logsql = "INSERT INTO `file_login`(`user_id`) VALUES (" . $result['auth_id'] . ")";
    $log = $conn->query($logsql);
    $conn->close();

}
function viewLogin()
{
    $conn = condb();
    $sql = "SELECT file_login.*, authen.user_name FROM `file_login` INNER JION authen ON file_login.user_id = authen.auth_id";
    $query = $conn->query($sql);
    while ($result = $query->fetch_array(MYSQLI_ASSOC)) {
        echo $result["user_name"] . ' ' . $result["DateLogin"] . '<br>';
    }

    $conn->condb();
}
/** Add user
 *
 *
 */

function addUser($auth_id)
{
    $conn = condb();
    $query = 'INSERT INTO `users`( `f_name`, `l_name`, `telephone`, `email`, `auth_id`) VALUES';
    $queryValue .= ' ("' . $_POST["f_name"] . '","' . $_POST["l_name"] . '","' . $_POST["telephone"] . '","' . $_POST["email"] . '","' . $auth_id . '")';
    $sql = $query . $queryValue;
    $addUser = $conn->query($sql) or die("Error in query: $sql " . mysqli_error());
    if ($addUser) {
        echo "<script>alert('User added');</script>";
        header("location:../admin/user.php");
    } else {
        echo '<script>alert("Error!!");window.history.go(-1);</script>';
    }

}
function compareDate($date1, $date2)
{
    $arrDate1 = explode("-", $date1);
    $arrDate2 = explode("-", $date2);
    $timStmp1 = mktime(0, 0, 0, $arrDate1[1], $arrDate1[2], $arrDate1[0]);
    $timStmp2 = mktime(0, 0, 0, $arrDate2[1], $arrDate2[2], $arrDate2[0]);

    if ($timStmp1 == $timStmp2) {
        echo "\$date = \$date2";
    } else if ($timStmp1 > $timStmp2) {
        echo "\$date > \$date2";
    } else if ($timStmp1 < $timStmp2) {
        echo "\$date < \$date2";
    }
}
/**
 *
 * Add UserLogin
 *
 */
function addUserLogin()
{
    $conn = condb();

    if (isset($_POST["txt_password"])) {
        $pws = HashPassword($_POST["txt_password"]);
    } else {
        $pws = HashPassword(1234);
    }
    $select = $conn->query('SELECT * FROM authen WHERE user_name = "' . $_POST["txt_username"] . '"');
    $result = $select->fetch_assoc();
    $query = 'INSERT INTO `authen`( `user_name`, `pswd`, `role_id`) VALUES';
    $queryValue = "";
    if ($_POST["txt_username"] != "" && $_POST["txt_username"] != $result['user_name']) {
        $queryValue .= ' ("' . $_POST["txt_username"] . '","' . $pws . '","' . $_POST["roles"] . '")';
        $sql = $query . $queryValue;
        $addUser = $conn->query($sql) or die("Error in query: $sql " . mysqli_error());
        $auth_id = $conn->insert_id;
        addUser($auth_id);
    } else {
        echo '<script>alert("Email หรือ ชื่อผู้ใช้งานมีอยู่ในระบบแล้ว");window.history.go(-1);</script>';
    }
}
/*
To get Roles of Users
 */
function getRoles()
{
    $conn = condb();
    $query = $conn->query("SELECT * FROM roles WHERE perm_id <> 3");
    while ($result = $query->fetch_array(MYSQLI_ASSOC)) {
        echo '<option value="' . $result["perm_id"] . '">' . $result["perm_desc"] . '</option>';
    }
    $conn->close();
}

/**
 *
 *
 * get all user to show in that page
 *
 */
function getUser($txtSearch)
{
    $conn = condb();
    $query = $conn->query('SELECT users.`user_id`, users.`f_name`, users.`l_name`, users.`telephone`, users.`email`, users.`auth_id` , authen.`user_name`, authen.`pswd`, authen.`role_id`, roles.* FROM users ,authen,roles
    WHERE
    authen.auth_id = users.auth_id
    AND authen.role_id = roles.perm_id
    AND
    (users.`f_name` LIKE "%' . $txtSearch . '%"
    OR users.`telephone` LIKE  "%' . $txtSearch . '%"
    OR authen.`user_name` LIKE  "%' . $txtSearch . '%"
    OR roles.perm_desc LIKE  "%' . $txtSearch . '%"  )
    ORDER BY auth_id DESC');
    error_reporting(error_reporting() & ~E_NOTICE);
    if ($_SESSION['role_id'] != 1) {
        while ($user = $query->fetch_array(MYSQLI_ASSOC)) {
            echo '
            <tr>
            <input type="text" hidden name="txtID" value="' . $user['user_id'] . ' ?>">
            <td> ' . $user['f_name'] . ' ' . $user['l_name'] . ' </td>
            <td>  ' . $user['email'] . ' </td>
            <td> ' . $user['telephone'] . ' </td>
            <td> ' . $user['user_name'] . ' </td>
            <td> ' . $user['perm_desc'] . '  </td>
            <td>
            </td>
          </tr> ';
        }
    } else {
        while ($user = $query->fetch_array(MYSQLI_ASSOC)) {
            if ($user['user_id'] == $_GET["ID"]) {
                echo '
        <form action="../function/database.php" method="post">
        <tr>
        <input type="text" hidden name="txtID" value="' . $user['user_id'] . ' ">
        <input type="text" hidden name="txtauth_id" value="' . $user['auth_id'] . ' ">
        <td> ' . $user['f_name'] . ' ' . $user['l_name'] . ' </td>
        <td>
            ' . $user['email'] . '
        </td>
        <td>
            ' . $user['telephone'] . '
        </td>
        <td> ' . $user['user_name'] . ' </td>
        <td>';?>
            <select name="roles" class="form-control">
            <option value="<?=$user['role_id'];?>"><?=$user['perm_desc'];?></option>
            <?php getRoles();?>
            </select>
       <?='</td>
        <td>
        <input type="submit" class="btn btn-success btn-sm" value="บันทึก">';?>
            <button type="button"  class="btn btn-warning btn-sm" role="button" OnClick="window.location='<?=$_SERVER["PHP_SELF"];?>';"><?='ยกเลิก</button>
        </td>
      </tr>
      </form>
      ';

            } else {
                echo '
    <tr>
    <input type="text" hidden name="txtID" value="' . $user['user_id'] . ' ?>">
    <td> ' . $user['f_name'] . ' ' . $user['l_name'] . ' </td>
    <td>  ' . $user['email'] . ' </td>
    <td> ' . $user['telephone'] . ' </td>
    <td> ' . $user['user_name'] . ' </td>
    <td> ' . $user['perm_desc'] . '  </td>
    <td>
    <a class="btn btn-primary btn-sm" href="' . $_SERVER["PHP_SELF"] . '?ID=' . $user['user_id'] . '" role="button"> แก้ไข</a>
    </td>
  </tr> ';

            }
        }
    }
    $conn->close();
}

function updateUser()
{
    $conn = condb();
    $sql = "UPDATE `authen` SET  role_id = " . $_POST['roles'] . " WHERE auth_id = '" . $_POST['txtauth_id'] . "'";
    $query = $conn->query($sql) or die("Error in query: $sql " . mysqli_error());
    return $query;
}

function addChm()
{
    $conn = condb();
    $insChm = "INSERT INTO `chemicals` (`chem_name`, `chem_producer`, `chem_code`, `chem_no`, `chem_status`) VALUES
        ('" . $_POST['chmName'] . "','" . $_POST['chmProducer'] . "','" . $_POST['chmCode'] . "','" . $_POST['chmNumber'] . "','" . $_POST['chmStatus'] . "')";
    $query = $conn->query($insChm) or die("Error in query: $insChm " . mysqli_error());
    $Chm_id = $conn->insert_id;
    return $Chm_id;
}

function addPackage()
{
    $conn = condb();
    $chkPack = $conn->query('SELECT pack_id,model FROM `packages` WHERE model = "' . $_POST['pckNumber'] . '"');
    if (mysqli_num_rows($chkPack) < 1) {
        $insPack = "INSERT INTO `packages` (`pack_producer`, `code_name`, `model`, `pack_volume`) VALUES ";
        $insPack .= "('" . $_POST['pckProducer'] . "','" . $_POST['pckCode'] . "','" . $_POST['pckNumber'] . "','" . $_POST['pckVol'] . $_POST['mas2'] . "')";
        $query = $conn->query($insPack) or die("Error in query: $insPack " . mysqli_error());
        $Pack_id = $conn->insert_id;
        return $Pack_id;
    } else {
        $Pack_id = $chkPack->fetch_assoc();
        return $Pack_id['pack_id'];
    }
    exit;
}

function addTruck()
{
    $conn = condb();
    $chkTruck = $conn->query('SELECT truck_id,chasis_no FROM `trucks` WHERE chasis_no = "' . $_POST['carChasis'] . '"');
    if (mysqli_num_rows($chkTruck) < 1) {
        $insTruck = "INSERT INTO `trucks` (`car_license`, `chasis_no`, `brand`, `tmodel`, `type`) VALUES";
        $insTruck .= "('" . $_POST['carLicense'] . "','" . $_POST['carChasis'] . "','" . $_POST['carBrand'] . "','" . $_POST['carModel'] . "','" . $_POST['carType'] . "')";
        $query = $conn->query($insTruck) or die("Error in query: $insTruck " . mysqli_error());
        $Truck_id = $conn->insert_id;
        return $Truck_id;
    } else {
        $Truck_id = $chkTruck->fetch_assoc();
        return $Truck_id['truck_id'];
    }
    exit;
}

function addJob()
{
    $conn = condb();
    $Chm_id = addChm();
    $Pack_id = addPackage();
    $Truck_id = addTruck();
    $from_date = date_create($_POST['from_date']);
    $to_date = date_create($_POST['to_date']);

    if ($Chm_id) {
        if ($Pack_id) {
            if ($Truck_id) {
                $getUser = $conn->query('SELECT * FROM traders WHERE email = "' . $_SESSION['UName'] . '"');
                $trader_id = $getUser->fetch_assoc();
                $insJob = "INSERT INTO `job_details`(`trader_id`, `chem_id`, `volume`, `Date`,
                    `Qty`, `pack_id`, `formPlace`, `atPlace`, `formDate`, `atDate`, `controller`, `truck_id`,`spending`) VALUE ";
                $insJob .= '("' . $trader_id["trader_id"] . '","' . $Chm_id . '","' . $_POST['chmVolume'] . $_POST['mas'] . '","' . $_POST['chkDate'] . '",
                    "' . $_POST['chmQty'] . '","' . $Pack_id . '","' . $_POST['fromPlace'] . '","' . $_POST['toPlace'] . '","' . date_format($from_date, "Y/m/d") . '",
                    "' . date_format($to_date, "Y/m/d") . '","' . $_POST['jobController'] . '","' . $Truck_id . '","' . $_POST['spending'] . '")';
                $query = $conn->query($insJob) or die("Error in query:$insJob " . mysqli_error());

                if ($query) {
                    echo "<script>alert('เพิ่มรายละเอียดการขนย้ายเรียบร้อยแล้ว');window.location='addjob.php';</script>";
                } else {
                    echo "<script>alert('Details Error!!');window.history.go(-1);</script>";
                }

            } else {
                echo "<script>alert('Truck Error!!');window.history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('Packages Error!!');window.history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('Chemical Error!!');window.history.go(-1);</script>";
    }

}

function insertChm($name, $producer, $code, $num, $status)
{
    $conn = condb();
    $chkChm = $conn->query('SELECT chem_id,chem_no FROM `chemicals` WHERE chem_no = "' . $num . '"');
    if (mysqli_num_rows($chkChm) == 0) {
        $insChm = "INSERT INTO `chemicals` (`chem_name`, `chem_producer`, `chem_code`, `chem_no`, `chem_status`) VALUES ";
        $insChm .= "('" . $name . "','" . $producer . "','" . $code . "','" . $num . "','" . $status . "')";
        $query = $conn->query($insChm) or die("Error in query: $insChm " . mysqli_error());
        $Chm_id = $conn->insert_id;
        return $Chm_id;
    } else {
        $Chm_id = $chkChm->fetch_assoc();
        return $Chm_id['chem_id'];
    }
    exit;
}

function insertPackage($producer, $name, $model, $volume)
{
    $conn = condb();
    $chkPack = $conn->query('SELECT pack_id,model FROM `packages` WHERE model = "' . $model . '"');
    if (mysqli_num_rows($chkPack) < 1) {
        $insPack = "INSERT INTO `packages` (`pack_producer`, `code_name`, `model`, `pack_volume`) VALUES ";
        $insPack .= "('" . $producer . "','" . $name . "','" . $model . "','" . $volume . "')";
        $query = $conn->query($insPack) or die("Error in query: $insPack " . mysqli_error());
        $Pack_id = $conn->insert_id;
        return $Pack_id;
    } else {
        $Pack_id = $chkPack->fetch_assoc();
        return $Pack_id['pack_id'];
    }
    exit;
}

function insertTruck($license, $chasis, $brand, $model, $type)
{
    $conn = condb();
    $chkTruck = $conn->query('SELECT truck_id,chasis_no FROM `trucks` WHERE chasis_no = "' . $chasis . '"');
    if (mysqli_num_rows($chkTruck) < 1) {
        $insTruck = "INSERT INTO `trucks` (`car_license`, `chasis_no`, `brand`, `tmodel`, `type`) VALUES";
        $insTruck .= "('" . $license . "','" . $chasis . "','" . $brand . "','" . $model . "','" . $type . "')";
        $query = $conn->query($insTruck) or die("Error in query: $insTruck " . mysqli_error());
        $Truck_id = $conn->insert_id;
        return $Truck_id;
    } else {
        $Truck_id = $chkTruck->fetch_assoc();
        return $Truck_id['truck_id'];
    }
    exit;
}

function filesUpload()
{
    $conn = condb();
    move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $_FILES["fileUpload"]["name"]); // Copy/Upload CSV
    setlocale(LC_ALL, 'Thai');
    $objCSV = fopen($_FILES["fileUpload"]["name"], "r");
    while (($objArr = fgetcsv($objCSV, 1000, ",")) !== false) {
        $Chm_id = insertChm($objArr[0], $objArr[1], $objArr[2], $objArr[3], $objArr[4]);
        $Pack_id = insertPackage($objArr[8], $objArr[9], $objArr[10], $objArr[11]);
        $Truck_id = insertTruck($objArr[17], $objArr[18], $objArr[19], $objArr[20], $objArr[21]);
        if ($Chm_id) {
            if ($Pack_id) {
                if ($Truck_id) {
                    if ($_SESSION['role_id'] == 1) {
                        $getUser = $conn->query('SELECT * FROM traders WHERE trader_id = "' . $_POST['traders'] . '"');
                        $trader_id = $getUser->fetch_assoc();
                        $insJob = "INSERT INTO `job_details`(`trader_id`, `chem_id`, `volume`, `Date`,
                            `Qty`, `pack_id`, `formPlace`, `atPlace`, `formDate`, `atDate`, `controller`, `truck_id`,`spending`) VALUE ";
                        $insJob .= '("' . $trader_id["trader_id"] . '","' . $Chm_id . '","' . $objArr[5] . '","' . $objArr[6] . '",
                            "' . $objArr[7] . '","' . $Pack_id . '","' . $objArr[12] . '","' . $objArr[13] . '","' . $objArr[14] . '",
                            "' . $objArr[15] . '","' . $objArr[16] . '","' . $Truck_id . '","' . $objArr[22] . '")';
                        $query = $conn->query($insJob) or die("Error in query:$insJob " . mysqli_error());

                        if ($query) {
                            echo "<script>alert('เพิ่มรายละเอียดการขนย้ายเรียบร้อยแล้ว');window.location='../admin/addjob.php';</script>";
                        } else {
                            echo "<script>alert('Details Error!!');window.history.go(-1);</script>";
                        }

                    } elseif ($_SESSION['role_id'] == 2) {
                        $getUser = $conn->query('SELECT * FROM traders WHERE trader_id = "' . $_POST['traders'] . '"');
                        $trader_id = $getUser->fetch_assoc();
                        $insJob = "INSERT INTO `job_details`(`trader_id`, `chem_id`, `volume`, `Date`,
                            `Qty`, `pack_id`, `formPlace`, `atPlace`, `formDate`, `atDate`, `controller`, `truck_id`,`spending`) VALUE ";
                        $insJob .= '("' . $trader_id["trader_id"] . '","' . $Chm_id . '","' . $objArr[5] . '","' . $objArr[6] . '",
                            "' . $objArr[7] . '","' . $Pack_id . '","' . $objArr[12] . '","' . $objArr[13] . '","' . $objArr[14] . '",
                            "' . $objArr[15] . '","' . $objArr[16] . '","' . $Truck_id . '","' . $objArr[22] . '")';
                        $query = $conn->query($insJob) or die("Error in query:$insJob " . mysqli_error());

                        if ($query) {
                            echo "<script>alert('เพิ่มรายละเอียดการขนย้ายเรียบร้อยแล้ว');window.location='../user/addjob.php';</script>";
                        } else {
                            echo "<script>alert('Details Error!!');window.history.go(-1);</script>";
                        }

                    } else {
                        $getUser = $conn->query('SELECT * FROM traders WHERE email = "' . $_SESSION['UName'] . '"');
                        $trader_id = $getUser->fetch_assoc();
                        $insJob = "INSERT INTO `job_details`(`trader_id`, `chem_id`, `volume`, `Date`,
                        `Qty`, `pack_id`, `formPlace`, `atPlace`, `formDate`, `atDate`, `controller`, `truck_id`,`spending`) VALUE ";
                        $insJob .= '("' . $trader_id["trader_id"] . '","' . $Chm_id . '","' . $objArr[5] . '","' . $objArr[6] . '",
                        "' . $objArr[7] . '","' . $Pack_id . '","' . $objArr[12] . '","' . $objArr[13] . '","' . $objArr[14] . '",
                        "' . $objArr[15] . '","' . $objArr[16] . '","' . $Truck_id . '","' . $objArr[22] . '")';
                        $query = $conn->query($insJob) or die("Error in query:$insJob " . mysqli_error());

                        if ($query) {
                            echo "<script>alert('เพิ่มรายละเอียดการขนย้ายเรียบร้อยแล้ว');window.location='../viewjob.php';</script>";
                        } else {
                            echo "<script>alert('Details Error!!');window.history.go(-1);</script>";
                        }

                    }

                } else {
                    echo "<script>alert('Truck Error!!');window.history.go(-1);</script>";
                }
            } else {
                echo "<script>alert('Packages Error!!');window.history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('Chemical Error!!');window.history.go(-1);</script>";
        }

    }
    if ($query) {
        fclose($objCSV);
        unlink($_FILES["fileUpload"]["name"]);
    }

}

function getJob($txtSearch)
{
    $conn = condb();
    $getJob = $conn->query('SELECT job_id,job_details.volume, job_details.Date , job_details.Qty, job_details.pack_id,
    job_details.formDate, job_details.atDate, job_details.formPlace,job_details.atPlace,job_details.controller,
    chemicals.chem_name,chemicals.chem_producer,chemicals.chem_code,chemicals.chem_no,chemicals.chem_status,
    trucks.*,
    packages.*,
    traders.*
        FROM job_details
        INNER JOIN traders ON traders.trader_id = job_details.trader_id
        INNER JOIN chemicals ON chemicals.chem_id = job_details.chem_id
        INNER JOIN trucks ON trucks.truck_id = job_details.truck_id
        INNER JOIN packages ON packages.pack_id = job_details.pack_id
        WHERE traders.email ="' . $_SESSION["UName"] . '"
        AND (chemicals.chem_name  LIKE  "%' . $txtSearch . '%"
        OR chemicals.chem_code  LIKE  "%' . $txtSearch . '%"
        OR chemicals.chem_producer  LIKE  "%' . $txtSearch . '%"
        OR chemicals.chem_status  LIKE  "%' . $txtSearch . '%"
        OR trucks.car_license  LIKE  "%' . $txtSearch . '%"
        )
ORDER BY job_id DESC
        ');
    while ($job = $getJob->fetch_assoc()) {
        // <td> ' . $job['chem_producer'] . ' </td>
        // <td> ' . $job['chem_no'] . ' </td>
        // <td> ' . $job['Date'] . ' </td>
        // <td> ' . $job['pack_producer'] . ' </td>
        // <td> ' . $job['chem_status'] . ' </td>
        // <td> ' . $job['code_name'] . ' </td>
        // <td> ' . $job['model'] . ' </td>
        // <td> ' . $job['pack_volume'] . ' </td>
        echo '
        <tr>
        <td> <input type="checkbox" name="jobid[]" value="' . $job['job_id'] . '"> </td>
        <td> ' . $job['chem_name'] . ' </td>
        <td> ' . $job['chem_code'] . ' </td>
        <td> ' . $job['volume'] . ' </td>
        <td> ' . $job['Qty'] . ' </td>
        <td> ' . $job['formPlace'] . ' </td>
        <td> ' . $job['atPlace'] . ' </td>
        <td> ' . $job['formDate'] . ' ถึง ' . $job['atDate'] . '  </td>
        <td> ' . $job['controller'] . ' </td>
        <td> ' . $job['car_license'] . ' </td>
        <td style="text-align:center"><a  href="editjob.php?jobid=' . $job['job_id'] . '" class="btn btn-warning btn-sm">แก้ไข</a></td>

  </tr>
        ';
    }

}
function jobFromDate($from_date, $to_date)
{
    $conn = condb();
    $getJob = $conn->query('SELECT job_id,job_details.volume, job_details.Date , job_details.Qty, job_details.pack_id,
    job_details.formDate, job_details.atDate, job_details.formPlace,job_details.atPlace,job_details.controller,
    chemicals.chem_name,chemicals.chem_producer,chemicals.chem_code,chemicals.chem_no,chemicals.chem_status,
    trucks.*,
    packages.*,
    traders.*
        FROM job_details
        INNER JOIN traders ON traders.trader_id = job_details.trader_id
        INNER JOIN chemicals ON chemicals.chem_id = job_details.chem_id
        INNER JOIN trucks ON trucks.truck_id = job_details.truck_id
        INNER JOIN packages ON packages.pack_id = job_details.pack_id
        WHERE traders.email ="' . $_SESSION["UName"] . '"
         AND ((job_details.formDate BETWEEN "' . date_format($from_date, 'Y/m/d') . '" AND "' . date_format($to_date, 'Y/m/d') . '")
         OR (job_details.atDate BETWEEN "' . date_format($from_date, 'Y/m/d') . '" AND "' . date_format($to_date, 'Y/m/d') . '"))

ORDER BY job_id DESC
        ');
    while ($job = $getJob->fetch_assoc()) {
        // <td> ' . $job['chem_producer'] . ' </td>
        // <td> ' . $job['chem_no'] . ' </td>
        // <td> ' . $job['Date'] . ' </td>
        // <td> ' . $job['pack_producer'] . ' </td>
        // <td> ' . $job['chem_status'] . ' </td>
        // <td> ' . $job['code_name'] . ' </td>
        // <td> ' . $job['model'] . ' </td>
        // <td> ' . $job['pack_volume'] . ' </td>
        echo '
        <tr>
        <td> <input type="checkbox" name="jobid[]" value="' . $job['job_id'] . '"> </td>
        <td> ' . $job['chem_name'] . ' </td>
        <td> ' . $job['chem_code'] . ' </td>
        <td> ' . $job['volume'] . ' </td>
        <td> ' . $job['Qty'] . ' </td>
        <td> ' . $job['formPlace'] . ' </td>
        <td> ' . $job['atPlace'] . ' </td>
        <td> ' . $job['formDate'] . ' ถึง ' . $job['atDate'] . '  </td>
        <td> ' . $job['controller'] . ' </td>
        <td> ' . $job['car_license'] . ' </td>
        <td style="text-align:center"><a  href="editjob.php?jobid=' . $job['job_id'] . '" class="btn btn-warning btn-sm">แก้ไข</a></td>

  </tr>
        ';
    }

}

function getAllJob($txtSearch)
{
    $conn = condb();
    $getJob = $conn->query('SELECT job_details.volume, job_details.Date , job_details.Qty, job_details.pack_id,
    job_details.formDate, job_details.atDate, job_details.formPlace,job_details.atPlace,job_details.controller,
    chemicals.chem_name,chemicals.chem_producer,chemicals.chem_code,chemicals.chem_no,chemicals.chem_status,
    trucks.*,
    packages.*,
    traders.*
        FROM job_details
        INNER JOIN traders ON traders.trader_id = job_details.trader_id
        INNER JOIN chemicals ON chemicals.chem_id = job_details.chem_id
        INNER JOIN trucks ON trucks.truck_id = job_details.truck_id
        INNER JOIN packages ON packages.pack_id = job_details.pack_id
        WHERE traders.trader_name  LIKE  "%' . $txtSearch . '%"
        OR chemicals.chem_name  LIKE  "%' . $txtSearch . '%"
        OR chemicals.chem_producer  LIKE  "%' . $txtSearch . '%"
        OR chemicals.chem_status  LIKE  "%' . $txtSearch . '%"
        OR trucks.car_license  LIKE  "%' . $txtSearch . '%"
        ORDER BY job_details.job_id DESC');
    while ($job = $getJob->fetch_assoc()) {
        // <td> ' . $job['chem_producer'] . ' </td>
        // <td> ' . $job['chem_no'] . ' </td>
        // <td> ' . $job['chem_status'] . ' </td>
        // <td> ' . $job['Date'] . ' </td>
        // <td> ' . $job['pack_producer'] . ' </td>
        // <td> ' . $job['code_name'] . ' </td>
        // <td> ' . $job['model'] . ' </td>
        // <td> ' . $job['pack_volume'] . ' </td>
        echo '
        <tr>
    <td> ' . $job['trader_name'] . ' </td>
    <td> ' . $job['chem_name'] . ' </td>
    <td> ' . $job['volume'] . ' </td>
    <td> ' . $job['Qty'] . ' </td>
    <td> ' . $job['formPlace'] . ' </td>
    <td> ' . $job['atPlace'] . ' </td>
     <td> ' . $job['formDate'] . ' ถึง ' . $job['atDate'] . '  </td>
    <td> ' . $job['controller'] . ' </td>
   <td> ' . $job['car_license'] . ' </td>
    <td style="text-align:center"><a target="_blank" href="https://www.google.com/maps/d/u/0/edit?mid=1cpFbXCupb8Fl_IvEqG-ih6R4USYi0NkW&ll=14.027387651104151%2C100.60849847656254&z=11" class="btn btn-danger btn-sm">Map</a></td>

  </tr>
        ';
    }

}

/**
 *
 *
 *  Add traders
 *
 *
 */

function addTrade($auth_id)
{
    $conn = condb();
    $query = 'INSERT INTO  traders (`trader_name`,`trader_code`,`license`, `address`, `telephone`, `fax`, `email`,`auth_id`) VALUES';
    $queryValue = "";
    $queryValue .= ' ("' . $_POST["trader_name"] . '","' . $_POST["trader_code"] . '","' . $_POST["license"] . '","' . $_POST["address"] . '","' . $_POST["telephone"] . '","' . $_POST["fax"] . '","' . $_POST["email"] . '","' . $auth_id . '")';
    $sql = $query . $queryValue;
    $addTrade = $conn->query($sql) or die("Error in query: $sql " . mysqli_error());
    if ($addTrade) {
        # code...
        echo "<script>alert('Trader added');</script>";
        header("location:../admin/trader.php");
    } else {
        echo '<script>alert("Error!!");window.history.go(-1);</script>';
    }
}
/**
 *
 *
 *  Add traderslogin
 *
 *
 */

function addTradeLogin()
{
    $conn = condb();
    if (empty($_POST["txt_password"])) {
        $pws = HashPassword('1234');
    } else {
        $pws = HashPassword($_POST["txt_password"]);
    }
    $select = $conn->query('SELECT * FROM authen WHERE user_name = "' . $_POST["email"] . '"');
    $result = $select->fetch_assoc();
    if ($_POST["email"] != $result['user_name'] && $_POST["email"] != "") {
        $query = 'INSERT INTO `authen`( `user_name`, `pswd`,`role_id`) VALUES ("' . $_POST["email"] . '","' . $pws . '",3)';
        $addUser = $conn->query($query) or die("Error in query: $query " . mysqli_error());
        $auth_id = $conn->insert_id;
        addTrade($auth_id);
        exit;
    } else {
        echo '<script>alert("Email หรือ ชื่อผู้ใช้งานมีอยู่ในระบบแล้ว");window.history.go(-1);</script>';
    }
}
/**
 * get all user to show in that page
 *
 */
function getTrader($txtSearch)
{
    $conn = condb();
    $query = $conn->query('SELECT traders.* ,
    authen.`user_name`, authen.`role_id`,
    roles.*
    FROM traders ,authen,roles
    WHERE authen.auth_id = traders.auth_id AND authen.role_id = roles.perm_id AND
    (traders.`trader_name` LIKE "%' . $txtSearch . '%"
    OR traders.`telephone` LIKE  "%' . $txtSearch . '%"
    OR traders.`address` LIKE  "%' . $txtSearch . '%"
    OR traders.`email` LIKE  "%' . $txtSearch . '%"   )
    ORDER BY trader_id DESC');
    while ($traders = $query->fetch_array(MYSQLI_ASSOC)) {
        echo '
                <tr>
                <input type="text" hidden name="txtID" value="' . $traders['trader_id'] . ' ?>">
                <td> ' . $traders['trader_name'] . ' </td>
                <td> ' . $traders['trader_code'] . ' </td>
                <td> ' . $traders['address'] . ' </td>
                <td> ' . $traders['telephone'] . '  </td>
                <td> ' . $traders['fax'] . ' </td>
                <td> ' . $traders['email'] . ' </td>
              </tr> ';

    }

    $conn->close();
}
function selectTrader()
{
    $conn = condb();
    $query = $conn->query("SELECT * FROM traders ORDER BY traders.trader_id DESC");
    while ($result = $query->fetch_array(MYSQLI_ASSOC)) {
        echo '<option value="' . $result["trader_id"] . '">' . $result["trader_code"] . ' || ' . $result["trader_name"], '</option>';
    }
    $conn->close();

}

function updateTrader()
{
    $conn = condb();
    $select = $conn->query('SELECT * FROM authen WHERE user_name = "' . $_POST["email"] . '"');
    $result = $select->fetch_assoc();
    if ($_POST["email"] != $result['user_name'] && $_POST["email"] != "") {
        $sql = "UPDATE `traders` SET
        `address`= '" . $_POST[address] . "',
        `telephone`= '" . $_POST[telephone] . "',
        `fax`= '" . $_POST[fax] . "',
        `email`='" . $_POST[email] . "'
        WHERE trader_id =" . $_POST['trader_id'] . "";
        $query = $conn->query($sql);
        return $query;
    } else {
        echo '<script>alert("Email หรือ ชื่อผู้ใช้งานมีอยู่ในระบบแล้ว");window.history.go(-1);</script>';
    }
}

/**
 *
 *
 *
 *
 * To do Pagination of product_service
 *
 *
 *
 *
 */

function getPage()
{
    $conn = condb();
    $sql = "SELECT * FROM product_service";
    $query = $conn->query($sql);
    $total_record = mysqli_num_rows($query);
    $total_page = ceil($total_record / $perpage);
    ?>
<p>Total <?=$total_record;?> Orders</p>
<?php
if ($Prev_Page) {
        echo " <a href='$_SERVER[SCRIPT_NAME]?page=$Prev_Page'><< Back</a> ";
    }

    for ($i = 1; $i <= $total_page; $i++) {
        if ($i != $page) {
            echo "[ <a href='$_SERVER[SCRIPT_NAME]?page=$i'>$i</a> ]";
        } else {
            echo "<b> $i </b>";
        }
    }
    if ($page != $total_page) {
        echo " <a href ='$_SERVER[SCRIPT_NAME]?page=$Next_Page'>Next>></a> ";
    }

    $conn->close();
}

/////////////////////////////for Users//////////////////////////////
/*
To Encrypt the password
 */

function HashPassword($password)
{
    $cost = [
        'cost' => 10,
    ];
    $hash = password_hash($password, PASSWORD_BCRYPT, $cost);
    return $hash;
}
/*
To add new user to system and use HashPassword before save information to database
 */

/*
Check Confirmation of password that must match
 */

function verifyPass()
{
    if ($_POST['password_confirmation'] != $_POST['password']) {
        echo "<script>alert('Passwords are not match!!');</script>";

    } else {
        addUser();
    }
}

function getReport($license, $from_date, $to_date)
{
    $conn = condb();

    $getJob = $conn->query("SELECT job_id,job_details.volume, job_details.Date , job_details.Qty, job_details.pack_id,
    job_details.formDate, job_details.atDate, job_details.formPlace,job_details.atPlace,job_details.controller,
    chemicals.chem_name,chemicals.chem_producer,chemicals.chem_code,chemicals.chem_no,chemicals.chem_status,
    trucks.*,
    packages.*,
    traders.*
        FROM job_details
        INNER JOIN traders ON traders.trader_id = job_details.trader_id
        INNER JOIN chemicals ON chemicals.chem_id = job_details.chem_id
        INNER JOIN trucks ON trucks.truck_id = job_details.truck_id
        INNER JOIN packages ON packages.pack_id = job_details.pack_id
     WHERE traders.trader_id = " . $license . " AND ((job_details.formDate BETWEEN '" . $from_date . "' AND '" . $to_date . "')
     OR (job_details.atDate BETWEEN '" . $from_date . "' AND '" . $to_date . "'))");
    $i = 0;

    while ($job = $getJob->fetch_assoc()) {
        $i++;
        echo '

        <tr>
        <td> <input type="checkbox" name="jobid[]" value="' . $job['job_id'] . '"> </td>
        <td> ' . $job['chem_name'] . ' </td>
        <td> ' . $job['chem_producer'] . ' </td>
        <td> ' . $job['chem_code'] . ' </td>
        <td> ' . $job['chem_no'] . ' </td>
        <td> ' . $job['chem_status'] . ' </td>
        <td> ' . $job['volume'] . ' </td>
        <td> ' . $job['Date'] . ' </td>
        <td> ' . $job['Qty'] . ' </td>
        <td> ' . $job['pack_producer'] . ' </td>
        <td> ' . $job['code_name'] . ' </td>
        <td> ' . $job['model'] . ' </td>
        <td> ' . $job['pack_volume'] . ' </td>
        <td> ' . $job['formPlace'] . ' </td>
        <td> ' . $job['atPlace'] . ' </td>
        <td> ' . $job['formDate'] . ' ถึง ' . $job['atDate'] . '  </td>
        <td> ' . $job['controller'] . ' </td>
        <td> ' . $job['car_license'] . ' </td>
        </tr>

        ';
    }
    echo '
     </tbody>
    </table>';
}

function getUsage($from_date, $to_date)
{
    $getUsage = $conn->query('SELECT authen.user_name, file_login.DateLogin FROM `file_login`
    INNER JOIN authen ON authen.auth_id = file_login.user_id
    WHERE `DateLogin` BETWEEN "' . date_format($from_date, "Y/m/d H:i:s") . '" AND "' . date_format($to_date, "Y/m/d H:i:s") . '"
    ORDER BY authen.auth_id DESC');
    $i = 0;
    while ($log = $getUsage->fetch_assoc()) {
        $i++;
        echo '
                <tr>
                    <td> ' . $i . ' </td>
                    <td> ' . $log['user_name'] . ' </td>
                    <td> ' . $log['DateLogin'] . ' </td>
                </tr>
        ';
    }
}

function countNonApprove()
{
    $conn = condb();
    $count = $conn->query("SELECT COUNT(*) as total FROM traders WHERE status = 0");

    $result = $count->fetch_assoc();
    return $result['total'];

}

function nonActiveTraders()
{
    $conn = condb();
    $trader = $conn->query("SELECT * FROM traders WHERE status = 0");
    while ($result = $trader->fetch_assoc()) {
        # code...
        echo '
        <tr>
            <th> ' . $result['trader_name'] . ' </th>
            <th> ' . $result['trader_code'] . ' </th>
            <th> ' . $result['license'] . ' </th>
            <th> ' . $result['address'] . ' </th>
            <th> ' . $result['telephone'] . ' </th>
            <th> ' . $result['fax'] . ' </th>
            <th> ' . $result['email'] . ' </th>
            <th> <a name="" id="" class="btn btn-primary btn-sm" href="' . $_SERVER["PHP_SELF"] . '?id=' . $result['trader_id'] . '" role="button">อนุมัติ</a> </th>
        </tr>
        ';
    }

}

function allowTrader($traderID)
{
    $conn = condb();
    $d = strtotime("+3 Months");
    $topup = date("Y-m-d", $d);

    $allow = $conn->query("UPDATE `traders` SET `status` = '1', `dateExpired` = '" . $topup . "' WHERE `traders`.`trader_id` = $traderID");
    if ($allow) {
        echo "<script>alert('ผู้ประกอบการรายนี้สามารถใช้งานระบบได้แล้ว');window.location='approve.php';</script>";
    }
}

function addAccident($trader)
{
    // $trader = $conn->query("SELECT `trader_id` FROM traders WHERE auth_id =" . $trader . " OR trader_id = " . $trader);
    // $trader_id = $trader->fetch_assoc();
    $sql = 'INSERT INTO `accident`(`carLicence`,`trader_id`, `dateTime`, `details`, `location`, `lat`, `lng`)
    VALUES ("' . $_POST["carLicence"] . '","' . $trader . '","' . $_POST["date"] . '","' . $_POST["accident"] . '",
    "' . $_POST["place_value"] . '","' . $_POST["lat_value"] . '","' . $_POST["lon_value"] . '")';
    $query = condb()->query($sql) or die("Error in query: $sql " . mysqli_error());
    if ($query) {
        echo "<script>alert('บันทึกการแจ้งอุบัติเหตุเรียบร้อยแล้ว');window.location='accident.php';</script>";
    }
}

function viewAccident($from_date, $to_date)
{
    $sql = '';
    $query = condb()->query($sql) or die("Error in query: $sql " . mysqli_error());
    while ($result = $query->fetch_assoc()) {

    }
}

function viewRoles($id)
{
    $conn = condb();
    $sql = "SELECT * FROM `roles` WHERE perm_id = " . $id;
    $query = $conn->query($sql);
    while ($result = $query->fetch_assoc()) {
        if ($result['perm_id'] == $_GET['ID']): ?>
        <form action="../function/database.php" method="post">
            <input type="text" hidden name="perm_id" value="<?=$_GET['ID']?>">
            <td class="text-center"><input type="checkbox" name="user"  value="1" <?=$retVal = ($result['user'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="traders" value="1" <?=$retVal = ($result['traders'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="approve"  value="1" <?=$retVal = ($result['approve'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="job" value="1" <?=$retVal = ($result['job'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="upload" value="1" <?=$retVal = ($result['upload'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="report" value="1" <?=$retVal = ($result['report'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="accidentreport" value="1" <?=$retVal = ($result['accidentreport'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="reportuse" value="1" <?=$retVal = ($result['reportuse'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="GPS" value="1" <?=$retVal = ($result['GPS'] != 0) ? "checked" : "";?>></td>
            <td class="text-center"><input type="checkbox" name="GPS2"  value="1" <?=$retVal = ($result['GPS2'] != 0) ? "checked" : "";?>></td>
            <td>
            <input type="submit" class="btn btn-success btn-sm" name="updateRole" value="บันทึก">
            <button type="button"  class="btn btn-warning btn-sm" role="button" OnClick="window.location='<?=$_SERVER["PHP_SELF"];?>';">ยกเลิก</button>
            </td>
        </form>

        <?php
else:
        ?>
        <td class="text-center"><input type="checkbox" name="user" <?=$result['user'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="traders"  <?=$result['traders'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="approve"  <?=$result['approve'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="job"  <?=$result['job'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="upload"  <?=$result['upload'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="report"  <?=$result['report'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="accidentreport"  <?=$result['accidentreport'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="reportuse"  <?=$result['reportuse'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="GPS"  <?=$result['GPS'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><input type="checkbox" name="GPS2"  <?=$result['GPS2'] != 0 ? 'checked="checked"' : '';?> disabled></td>
        <td class="text-center"><a class="btn btn-primary btn-sm" href="<?=$_SERVER["PHP_SELF"] . '?ID=' . $id?>" role="button"> แก้ไข</a></td>
        <?php
endif;
    }

}
function updateRoles($id)
{

    $user = ($_POST['user'] != "") ? $_POST['user'] : 0;
    $traders = ($_POST['traders'] != "") ? $_POST['traders'] : 0;
    $approve = ($_POST['approve'] != "") ? $_POST['approve'] : 0;
    $job = ($_POST['job'] != "") ? $_POST['job'] : 0;
    $upload = ($_POST['upload'] != "") ? $_POST['upload'] : 0;
    $report = ($_POST['report'] != "") ? $_POST['report'] : 0;
    $accidentreport = ($_POST['accidentreport'] != "") ? $_POST['accidentreport'] : 0;
    $reportuse = ($_POST['reportuse'] != "") ? $_POST['reportuse'] : 0;
    $GPS = ($_POST['GPS'] != "") ? $_POST['GPS'] : 0;
    $GPS2 = ($_POST['GPS2'] != "") ? $_POST['GPS2'] : 0;
    $sql = 'UPDATE `roles` SET
    `user`="' . $user . '",
    `traders`="' . $traders . '",
    `approve`="' . $approve . '",
    `upload`="' . $upload . '",
    `job`="' . $job . '"
    ,`report`="' . $report . '",
    `accidentreport`="' . $accidentreport . '",
    `reportuse`="' . $reportuse . '",
    `GPS`="' . $GPS . '",
    `GPS2`="' . $GPS2 . '"
     WHERE perm_id = ' . $id;
    $query = condb()->query($sql) or die("Error in query: $sql " . mysqli_error());
    return $query;
}

function chkRoles($role_id)
{
    $sql = "SELECT * FROM `roles` WHERE perm_id =" . $role_id;
    $query = condb()->query($sql);
    $result = $query->fetch_assoc();
    return $result;
}
function getTruck()
{
    $sql = "SELECT * FROM `accident`";
    $query = condb()->query($sql);
    while ($result = $query->fetch_assoc()) {
        echo '<option value="' . $result["carLicence"] . '">' . $result["carLicence"] . '</option>';
    }

}
function getAccidentReport($license, $from_date, $to_date)
{

    if ($license == "") {
        $sql = "SELECT * FROM `accident` WHERE  `dateTime` BETWEEN '" . date_format($from_date, "Y/m/d") . "' AND '" . date_format($to_date, "Y/m/d") . "'";
    } else {
        $sql = "SELECT * FROM `accident` WHERE `carLicence` = '" . $license . "' AND `dateTime` BETWEEN '" . date_format($from_date, "Y/m/d") . "' AND '" . date_format($to_date, "Y/m/d") . "'";
    }
    $query = condb()->query($sql);
    $i = 1;
    while ($result = $query->fetch_assoc()) {
        // <td><center> " . $result["lat"] . " </center></td>
        // <td><center> " . $result["lng"] . " </center></td>
        echo "
        <tr>
            <td><center> " . $i . " </center></td>
            <td><center> " . $result["carLicence"] . " </center></td>
            <td><center> " . $result["dateTime"] . " </center></td>
            <td><center> " . $result["details"] . " </center></td>
            <td><center> " . $result["location"] . " </center></td>
        </tr>
        ";
        $i++;
    }
}

function getChm()
{
    $sql = "SELECT * FROM `chem`";
    $query = condb()->query($sql);
    while ($result = $query->fetch_array(MYSQLI_ASSOC)) {
        echo '<option value="' . $result["chm_name"] . '">' . $result["chm_name"] . '</option>';
    }
}
function getMas()
{
    $sql = "SELECT * FROM `masure`";
    $query = condb()->query($sql);
    while ($result = $query->fetch_array(MYSQLI_ASSOC)) {
        echo '<option value="' . $result["mas_name"] . '">' . $result["mas_name"] . '</option>';
    }
}

function traderDetails()
{
    $conn = condb();
    $sql = 'SELECT * FROM traders WHERE auth_id = ' . $_SESSION['uid'];
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    return $result;

}

function editTrader()
{
    $conn = condb();
    $select = $conn->query('SELECT * FROM traders WHERE email = "' . $_POST["email"] . '"');
    $result = $select->fetch_assoc();
    if ($_POST["email"] != $result['email']) {
        $sql = "UPDATE `traders` SET
        `trader_name`= '" . $_POST['trader_name'] . "',
        `trader_code`= '" . $_POST['trader_code'] . "',
        `license`= '" . $_POST['license'] . "',
        `address`='" . $_POST['address'] . "',
        `telephone`= '" . $_POST['telephone'] . "',
        `fax`= '" . $_POST['fax'] . "',
        `email`='" . $_POST['email'] . "'
        WHERE auth_id =" . $_SESSION['uid'];

        if ($query = $conn->query($sql) or die("Error in query: $sql " . mysqli_error())) {
            $sql2 = "UPDATE `authen` SET `user_name`= '" . $_POST['email'] . "' WHERE user_name = '" . $_SESSION['UName'] . "'";

            if ($query2 = $conn->query($sql2) or die("Error in query: $sql " . mysqli_error())) {
                session_unset($_SESSION['UName']);
                $_SESSION['UName'] = $_POST['email'];
                session_write_close();
                return $query2;
            }

        } else {
            echo '<script>alert("Error");window.history.go(-1);</script>';
        }
    } else {
        echo '<script>alert("Email หรือ ชื่อผู้ใช้งานมีอยู่ในระบบแล้ว");window.history.go(-1);</script>';
    }

}

function userDetails()
{
    $conn = condb();
    $query = $conn->query('SELECT * FROM authen WHERE user_name = "' . $_SESSION['UName'] . '"');
    $result = $query->fetch_assoc();
    return $result;
}

function editUser()
{
    $conn = condb();
    $pass = $_POST['password'];
    $query2 = $conn->query('SELECT * FROM authen WHERE user_name = "' . $_SESSION['UName'] . '"');
    $result2 = $query2->fetch_assoc();

    if (password_verify($pass, $result2["pswd"])) {

        $sql = 'UPDATE `authen` SET `pswd`= "' . HashPassword($_POST["txt_password"]) . '" WHERE  user_name = "' . $_SESSION['UName'] . '"';
        $query = $conn->query($sql) or die("Error in query: $sql " . mysqli_error());

        if ($query) {
            echo '<script>alert("แก้ไขรหัสผ่านเรียบร้อยแล้ว กรุณาเก็บข้อมูลของท่านไว้อย่างดี");window.history.go(-1);</script>';

        }

    } else {
        echo '<script>alert("รหัสผ่านเดิมของคุณไม่ถูกต้อง");window.history.go(-1);</script>';
    }
}

function traderName($id)
{
    $conn = condb();
    $sql = 'SELECT * FROM traders WHERE trader_id = ' . $id;
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    return $result;

}

function getEditJob($jobid)
{
    $conn = condb();
    $getJob = $conn->query('SELECT job_id,job_details.volume, job_details.Date , job_details.Qty, job_details.pack_id,
    job_details.formDate, job_details.atDate, job_details.formPlace,job_details.atPlace,job_details.controller,job_details.spending,
    chemicals.chem_name,chemicals.chem_producer,chemicals.chem_code,chemicals.chem_no,chemicals.chem_status,
    trucks.*,
    packages.*,
    traders.*
        FROM job_details
        INNER JOIN traders ON traders.trader_id = job_details.trader_id
        INNER JOIN chemicals ON chemicals.chem_id = job_details.chem_id
        INNER JOIN trucks ON trucks.truck_id = job_details.truck_id
        INNER JOIN packages ON packages.pack_id = job_details.pack_id
        WHERE job_details.job_id =' . $jobid);

    $job = $getJob->fetch_assoc();
    return $job;
}

function editChm($job_id)
{
    $conn = condb();
    $sql = $conn->query('SELECT chem_id FROM job_details WHERE job_id =' . $job_id);
    $findChm = $sql->fetch_assoc();
    $editChm = "UPDATE `chemicals` SET
    `chem_code`='" . $_POST['chmCode'] . "',
    `chem_name`='" . $_POST['chmName'] . "',
    `chem_no`='" . $_POST['chmNumber'] . "',
    `chem_producer`='" . $_POST['chmProducer'] . "',
    `chem_status`='" . $_POST['chmStatus'] . "'
    WHERE chem_id = " . $findChm['chem_id'];
    $query = $conn->query($editChm) or die("Error in query: $editChm " . mysqli_error());
    // $Chm_id = $conn->insert_id;
    // return $Chm_id;
    return $query;
}

function editPackage($job_id)
{
    $conn = condb();
    $sql = $conn->query('SELECT pack_id FROM job_details WHERE job_id =' . $job_id);
    $findPack = $sql->fetch_assoc();
    $editPack = 'UPDATE `packages` SET
    `pack_producer`="' . $_POST['pckProducer'] . '",
    `code_name`="' . $_POST['pckCode'] . '",
    `model`="' . $_POST['pckNumber'] . '",
    `pack_volume`="' . $_POST['pckVol'] . '"
    WHERE pack_id = ' . $findPack['pack_id'];
    $query = $conn->query($editPack) or die("Error in query: $editPack " . mysqli_error());
    return $query;
}

function editTruck($job_id)
{
    $conn = condb();
    $sql = $conn->query('SELECT truck_id FROM job_details WHERE job_id =' . $job_id);
    $findTruck = $sql->fetch_assoc();
    $editTruck = 'UPDATE `trucks` SET
    `car_license`="' . $_POST['carLicense'] . '",
    `brand`="' . $_POST['carBrand'] . '",
    `tmodel`="' . $_POST['carModel'] . '",
    `chasis_no`="' . $_POST['carChasis'] . '",
    `type`="' . $_POST['carType'] . '"
    WHERE truck_id = ' . $findTruck['truck_id'];
    $query = $conn->query($editTruck) or die("Error in query: $editTruck " . mysqli_error());
    return $query;

}

function editJob($job_id)
{
    $conn = condb();
    $from_date = date_create($_POST['from_date']);
    $to_date = date_create($_POST['to_date']);

    if (editChm($job_id)) {
        if (editPackage($job_id)) {
            if (editTruck($job_id)) {
                $sql = 'UPDATE `job_details` SET
                `volume`="' . $_POST['chmVolume'] . '",
                `Date`="' . $_POST['chkDate'] . '",
                `Qty`="' . $_POST['chmQty'] . '",
                `formDate`="' . date_format($from_date, "Y/m/d") . '",
                `atDate`="' . date_format($to_date, "Y/m/d") . '",
                `formPlace`="' . $_POST['fromPlace'] . '",
                `atPlace`="' . $_POST['toPlace'] . '",
                `controller`="' . $_POST['jobController'] . '",
                `spending`="' . $_POST['spending'] . '"
                WHERE job_id = ' . $job_id;
                $query = $conn->query($sql) or die("Error in query:$sql " . mysqli_error());

                if ($query) {
                    echo "<script>alert('แก้ไขรายละเอียดการขนย้ายเรียบร้อยแล้ว');window.location='addjob.php';</script>";
                }
            }
        }
    }

}

function userExpired()
{
    $trader = condb()->query("SELECT * FROM traders WHERE (dateExpired <= NOW()) OR (dateExpired IS NULL)");
    while ($result = $trader->fetch_assoc()) {
        # code...
        echo '
        <tr>
            <td> ' . $result['trader_name'] . ' </td>
            <td> ' . $result['trader_code'] . ' </td>
            <td> ' . $result['license'] . ' </td>
            <td> ' . $result['address'] . ' </td>
            <td> ' . $result['telephone'] . ' </td>
            <td> ' . $result['fax'] . ' </td>
            <td> ' . $result['email'] . ' </td>
            <td> <a name="" id="" class="btn btn-primary btn-sm" href="userexpaired.php?id=' . $result['trader_id'] . '" role="button">ต่ออายุ</a> </td>
        </tr>
        ';
    }
}

function dateTopup($traderID)
{
    $conn = condb();
    $d = strtotime("+3 Months");
    $topup = date("Y-m-d", $d);
    $allow = $conn->query("UPDATE `traders` SET `dateExpired` = '" . $topup . "' WHERE `trader_id` = $traderID");
    if ($allow) {
        echo "<script>alert('ผู้ประกอบการรายนี้สามารถใช้งานระบบได้แล้ว');window.location='userexpaired.php';</script>";
    }
}

function showDateExpired()
{
    $trader = condb()->query("SELECT * FROM traders WHERE auth_id =" . $_SESSION['uid']);
    $chk = $trader->fetch_assoc();
    return $chk['dateExpired'];

}
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}