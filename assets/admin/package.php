<?php
require '../__layout/header.php';
if ($_SESSION['role_id'] == 1) {
  require '../__layout/navi.php';
}else {
  echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");window.history.go(-1);</script>';
}?>

<body>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div style="padding-top:20px;">
      <!-- Start Content Here -->
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
            <div class="col">
              <button type="submit" class="btn btn-success mb-2 float-right" data-toggle="modal" data-target="#exampleModal">เพิ่ม</button>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">เพิ่มบรรจุภัณฑ์</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">ชื่อผู้ผลิต</label>
                            <input type="Product" class="form-control" id="inputProduct" placeholder="ชื่อผู้ผลิต">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputProductName">ชื่อรุ่น</label>
                            <input type="ProName" class="form-control" id="inputProductName" placeholder="ชื่อรุ่น">
                          </div>
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputNumber">หมายเลขสินค้า</label>
                            <input type="text" class="form-control" id="inputNumber" placeholder="หมายเลขสินค้า">
                          </div>

                          <div class="form-group col-md-3">
                            <label for="inputNumber">ความจุสูงสุด</label>
                            <input type="text" class="form-control" id="inputNumber" placeholder="ความจุ">
                          </div>
                          
                          <div class="form-group col-md-3">
                            <label for="inputType">ประเภทสินค้า</label>
                            <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>KG</option>
                                <option>Cl</option>
                            </select>
                          </div>
                        </div>


                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                      <button type="button" class="btn btn-primary">บันทึก</button>
                    </div>
                  </div>
                </div>
              </div>                            
            </div>
          </div>
          <!-- end search -->


          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> รายละเอียดบรรจุภัณฑ์ </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th> ผู้ผลิต</th>
                    <th> รุ่น/รหัส </th>
                    <th> หมายลข </th>
                    <th> ความจุสูงสุด </th>
                    
                    <th>  </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> Sentinel </td>
                    <td> 880 Delta </td>
                    <td> NTS002 </td>
                    <td> 21.4KG </td>
                    <td> 
                      <div>   
                        <button class="btn btn-primary" type="submit">แก้ไข</button>
                        <button type="button" class="btn btn-danger">ลบ</button>
                      </div>
                    </td>

                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td> Sentinel </td>
                    <td> 860 Delta </td>
                    <td> NTS002 </td>
                    <td> 26.4KG </td>
                    <td> 
                      <div>   
                        <button class="btn btn-primary" type="submit">แก้ไข</button>
                        <button type="button" class="btn btn-danger">ลบ</button>
                      </div>
                    </td>
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
