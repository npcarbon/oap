<?php
require 'fpdf/fpdf.php';
require 'function/database.php';
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

class MyPDF extends FPDF
{
    public function head()
    {
	
		$conn = condb();
		$query = $conn->query('SELECT * FROM traders WHERE traders.email ="' . $_SESSION["UName"] . '"');
		$trader = $query->fetch_assoc();

        $this->AddFont('THSarabunNew', '', 'THSarabunNew.php');
        $this->AddFont('THSarabunNew', '', 'THSarabunNew.php');
        $this->AddFont('THSarabunNew', '', 'THSarabunNew.php');
        $this->AddPage();
        $this->SetFont('THSarabunNew', '', 17);
        $this->Cell(270, 8, iconv('UTF-8', 'tis-620', 'แบบการย้ายวัสดุพลอยได้'), 0, 1, 'C');
        $this->Cell(270, 8, iconv('UTF-8', 'tis-620', 'ตามกฏกระทรวงกำหนดเงื่อนไขวิธีการขอรับใบอนุญาต และการดำเนินการเกี่ยวกับวัสดุนิวเคลียร์พิเศษ วัสดุต้นกำลัง วัสดุพลอยได้หรือพลังงานปรมาณู พ.ศ. ๒๕๕๐'), 0, 1, 'C');
        $this->Cell(270, 10, iconv('UTF-8', 'tis-620', 'ข้อ ๓๗ วรรคสอง ออกตามความในพระราชบัญญัติพลังงานปรมาณูเพื่อสันติ พ.ศ. ๒๕๐๔'), 0, 1, 'C');
        $this->Cell(240, 8, iconv('UTF-8', 'tis-620', 'วันที่ ' . DateThai(date("l jS F Y ")) . ''), 0, 1, 'R');
        $this->Cell(10, 8, iconv('UTF-8', 'tis-620', '๑. '), 0, 0, 'L');
        $this->Cell(40, 8, iconv('UTF-8', 'tis-620', 'ชื่อสถานประกอบกิจการ'), 0, 0, 'L');
        $this->Cell(20, 8, iconv('UTF-8', 'tis-620', '...............'. $trader['trader_name']. ' ...................................'), 0, 1, 'L');
        $this->Cell(10, 8, iconv('UTF-8', 'tis-620', ''), 0, 0, 'L');
        $this->Cell(10, 8, iconv('UTF-8', 'tis-620', 'ที่ตั้ง'), 0, 0, 'L');
        $this->Cell(40, 8, iconv('UTF-8', 'tis-620', '..'. $trader['address']. '...โทรศัพท์..'. $trader['telephone']. '..โทรสาร..'. $trader['fax']. '....Email..'. $trader['email']. '...'), 0, 1, 'L');
        $this->Cell(10, 8, iconv('UTF-8', 'tis-620', '๒. '), 0, 0, 'L');
        $this->Cell(90, 8, iconv('UTF-8', 'tis-620', 'เลขที่จดทะเบียนสถานประกอบการ/เลขที่บัตรประชาชน'), 0, 0, 'L');
        $this->Cell(40, 8, iconv('UTF-8', 'tis-620', '.....'. $trader['trader_code']. '................'), 0, 0, 'L');
        $this->Cell(65, 8, iconv('UTF-8', 'tis-620', 'แบบรายงาน สร.๓ ตามใบอนุญาต เลขที่'), 0, 0, 'L');
        $this->Cell(35, 8, iconv('UTF-8', 'tis-620', '..'. $trader['license']. '..'), 0, 1, 'L');
        $this->Cell(10, 8, iconv('UTF-8', 'tis-620', '๓. '), 0, 0, 'L');
        $this->Cell(30, 8, iconv('UTF-8', 'tis-620', 'ขอแจ้งการย้ายวัสดุพลอยได้ดังนี้'), 0, 1, 'L');
        $this->SetFont('THSarabunNew', '', 14);
        // $this->Cell(30, 8, iconv('UTF-8', 'tis-620', 'ข้อมูลของวัสดุพลอยได้ชนิดปิดผนึก(Sealed Source)'), 0, 1, 'L');
        $this->Ln();    }
    public function tb_Header()
    {
        $this->AddFont('THSarabunNew', '', 'THSarabunNew.php');
        $this->SetFont('THSarabunNew', '', 14);
        $this->Cell(10, 5, iconv('UTF-8', 'tis-620', ''), 'TLR', 0, 'C');
        $this->Cell(120, 5, iconv('UTF-8', 'tis-620', 'รายละเอียดวัสดุพลอยได้'), 'LTRB', 0, 'C');
        $this->Cell(63, 5, iconv('UTF-8', 'tis-620', 'ภาชนะบรรจุ/เครื่องมือ/เครื่องจักร'), 'LTRB', 0, 'C');
        $this->Cell(22, 5, iconv('UTF-8', 'tis-620', 'สถานะภาพวัสดุ'), 'LTRB', 0, 'C');
        $this->Cell(30, 5, iconv('UTF-8', 'tis-620', 'ตั้งแต่'), 'LTR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LTR', 0, 'C');
        $this->Cell(20, 5, iconv('UTF-8', 'tis-620', ''), 'LTR', 0, 'C');

        $this->Ln();
        $this->Cell(10, 5, iconv('UTF-8', 'tis-620', 'ลำดับ'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'ธาตุ-'), 'LTR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LTR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'รุ่น/'), 'LTR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LTR', 0, 'C');
        $this->Cell(27, 5, iconv('UTF-8', 'tis-620', 'สมบัติทางกายภาพ'), 'LTR', 0, 'C');
        $this->Cell(33, 5, iconv('UTF-8', 'tis-620', 'ความจุกัมมันตภาพ'), 'LTR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LTR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'รุ่น/'), 'LTR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LTR', 0, 'C');
        $this->Cell(18, 5, iconv('UTF-8', 'tis-620', 'ความจุกัม'), 'LTR', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', ''), 'LTR', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', ''), 'LR', 0, 'C');
        $this->Cell(30, 5, iconv('UTF-8', 'tis-620', 'วันที่'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LR', 0, 'C');
        $this->Cell(20, 5, iconv('UTF-8', 'tis-620', ''), 'LR', 0, 'C');
        $this->Ln();
        $this->Cell(10, 5, iconv('UTF-8', 'tis-620', ''), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'เลข'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'ผู้ผลิต'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'รหัสสินค้า'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'หมายเลข'), 'LR', 0, 'C');
        $this->Cell(27, 5, iconv('UTF-8', 'tis-620', '(1.ของแข็ง '), 'LR', 0, 'C');
        $this->Cell(33, 5, iconv('UTF-8', 'tis-620', ' /น้ำหนักสูงสุด'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'ผู้ผลิต'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'รหัสสินค้า'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'หมายเลข'), 'LR', 0, 'C');
        $this->Cell(18, 5, iconv('UTF-8', 'tis-620', 'มันตภาพ/'), 'LR', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', 'เดิม'), 'LR', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', 'ไปที่'), 'LR', 0, 'C');
        $this->Cell(30, 5, iconv('UTF-8', 'tis-620', '-'), 'LR', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'ผู้ควบคุม'), 'LR', 0, 'C');
        $this->Cell(20, 5, iconv('UTF-8', 'tis-620', 'รถที่ใช้ขนย้าย'), 'LR', 0, 'C');
        $this->Ln();
        $this->Cell(10, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', 'มวล'), 'LRB', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(27, 5, iconv('UTF-8', 'tis-620', '2.ของเหลว 3.ก๊าซ)'), 'LRB', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', 'ปริมาณ'), 'TLRB', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', 'ณ วันที่'), 'TLRB', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', 'จำนวน'), 'TLRB', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(18, 5, iconv('UTF-8', 'tis-620', 'น้ำหนักสูงสุด'), 'LRB', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(11, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(30, 5, iconv('UTF-8', 'tis-620', 'วันที่'), 'LRB', 0, 'C');
        $this->Cell(15, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Cell(20, 5, iconv('UTF-8', 'tis-620', ''), 'LRB', 0, 'C');
        $this->Ln();
    }
    public function data()
    {
        $conn = condb();
		// mysqli_query($conn,"set NAMES'UTF8'");
        $sql = 'SELECT job_details.volume, job_details.Date , job_details.Qty, job_details.pack_id,
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
            WHERE traders.email ="' . $_SESSION["UName"] . '"';

        $result = $conn->query($sql);
        $i = 0;

        while ($job = $result->fetch_assoc()) {
            $i++;
			$this->AddFont('THSarabunNew', '', 'THSarabunNew.php');
			$this->SetFont('THSarabunNew', '', 11);
	
            $this->Cell(10, 5, $i, 'LRB', 0, 'C');
            $this->Cell(15, 5, iconv('UTF-8', 'tis-620',$job["chem_name"]), 'LRB', 0, 'C');
            $this->Cell(15, 5, iconv('UTF-8', 'tis-620',$job['chem_producer']), 'LRB', 0, 'C');
            $this->Cell(15, 5, iconv('UTF-8', 'tis-620', $job['chem_code']), 'LRB', 0, 'C');
            $this->Cell(15, 5, iconv('UTF-8', 'tis-620', $job['chem_no']), 'LRB', 0, 'C');
            $this->Cell(27, 5, iconv('UTF-8', 'tis-620', $job['chem_status']), 'LRB', 0, 'C');
            $this->Cell(11, 5, iconv('UTF-8', 'tis-620',$job['volume']), 'LRB', 0, 'C');
            $this->Cell(11, 5, iconv('UTF-8', 'tis-620',$job['Date']), 'LRB', 0, 'C');
            $this->Cell(11, 5, iconv('UTF-8', 'tis-620',$job['Qty']), 'LRB', 0, 'C');
            $this->Cell(15, 5, iconv('UTF-8', 'tis-620',$job['pack_producer']), 'LRB', 0, 'C');
            $this->Cell(15, 5, iconv('UTF-8', 'tis-620',$job['code_name']), 'LRB', 0, 'C');
            $this->Cell(15, 5, iconv('UTF-8', 'tis-620',$job['model']), 'LRB', 0, 'C');
            $this->Cell(18, 5, iconv('UTF-8', 'tis-620',$job['pack_volume']), 'LRB', 0, 'C');
            $this->Cell(11, 5, iconv('UTF-8', 'tis-620',$job['formPlace']), 'LRB', 0, 'C');
            $this->Cell(11, 5, iconv('UTF-8', 'tis-620',$job['atPlace']), 'LRB', 0, 'C');
            $this->Cell(30, 5, iconv('UTF-8', 'tis-620',DateThai(date($job['formDate'])).' - '.DateThai(date($job['atDate']))), 'LRB', 0, 'C');
            $this->Cell(15, 5, iconv('UTF-8', 'tis-620', $job['controller']), 'LRB', 0, 'C');
            $this->Cell(20, 5, iconv('UTF-8', 'tis-620', $job['car_license']), 'LRB', 0, 'C');
            $this->Ln();
        }
    }
}

$pdf = new MyPDF('L', 'mm', 'A4');
$pdf->head();
$pdf->tb_Header();
$pdf->data();

$pdf->Output();
