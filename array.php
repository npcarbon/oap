            <table class="table">
            <thead>
                <tr>
                    <th class="align-middle"> </th>
                    <th class="align-middle"> ธาตุ-เลขมวล </th>
                    <th class="align-middle"> รุ่น/รหัสสินค้า </th>
                    <th class="align-middle"> ปริมาณ </th>
                    <th class="align-middle"> จำนวน </th>
                    <th class="align-middle"> จุดเริ่มต้น </th>
                    <th class="align-middle"> จุดหมาย </th>
                    <th class="align-middle"> วันที่เริ่ม-สิ้นสุด </th>
                    <th class="align-middle"> ผู้ควบคุม </th>
                    <th class="align-middle"> ทะเบียนรถ </th>
                    <th style="text-align:center">  </th>
                </tr>
            </thead>
<?php
require 'function/database.php';

$conn = condb();
// mysqli_query($conn,"set NAMES'UTF8'");
if(isset($_POST['jobid'])){
    foreach($_POST['jobid'] as $id){
            $sql = 'SELECT job_details.job_id,job_details.volume, job_details.Date , job_details.Qty, job_details.pack_id,
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
                WHERE job_details.job_id =' .  $id;

            $result = $conn->query($sql);
            // $i = 0;

            // while ($job = $result->fetch_assoc()) {

            // }
            ?>
            <tbody>
                <?php 
            while ($job = $result->fetch_assoc()) {
                echo '
                <tr>
                <td> <input type="checkbox" name="jobid[]" value="'. $job['job_id'] .'"> </td>
                <td> ' . $job['chem_name'] . ' </td>
                <td> ' . $job['chem_code'] . ' </td>
                <td> ' . $job['volume'] . ' </td>
                <td> ' . $job['Qty'] . ' </td>
                <td> ' . $job['formPlace'] . ' </td>
                <td> ' . $job['atPlace'] . ' </td>
                <td> ' . $job['formDate'] . ' ถึง ' . $job['atDate'] . '  </td>
                <td> ' . $job['controller'] . ' </td>
                <td> ' . $job['car_license'] . ' </td>
                <td style="text-align:center"><a  href="editjob.php?jobid='. $job['job_id'].'" class="btn btn-warning btn-sm">แก้ไข</a></td>
        
          </tr>
                ';
            }
            ?>

        <?php
        }
    }?>

            </tbody>
        </table>
