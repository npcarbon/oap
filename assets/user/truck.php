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
                      <h5 class="modal-title" id="exampleModalLabel">รายละเอียดผู้ปฏิบัติงาน</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>

                        <div class="form-group">
                          <label for="inputEmail4">ชื่อ</label>
                          <input type="Product" class="form-control" id="inputProduct" placeholder="ชื่อ">
                        </div>
                          <!-- <div class="form-group col-md-6">
                            <label for="inputProductName">ชื่อสินค้า</label>
                            <input type="ProName" class="form-control" id="inputProductName" placeholder="ชื่อสินค้า">
                          </div> -->



                          <div class="form-group">
                            <label for="inputProducer">นามสกุล</label>
                            <input type="text" class="form-control" id="inputProducer" placeholder="นามสกุล">
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="inputNumber">ทะเบียน</label>
                              <input type="text" class="form-control" id="inputNumber" placeholder="ทะเบียนรถ">
                            </div>

                            <div class="form-group col-md-4">
                              <label for="inputType">ยี่ห้อ</label>
                              <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                              </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputNumber">รุ่น</label>
                              <input type="text" class="form-control" id="inputNumber" placeholder="รุ่น">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="inputProducer">ประเภท</label>
                            <select id="inputState" class="form-control">
                              <option selected>Choose...</option>
                              <option>รถ6ล้อ</option>
                            </select>
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
                <h3 class="card-title"> รายละเอียดผู้ปฏิบัติงาน </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th> ชื่อ  - นามสกุล </th>
                      <th> ทะเบียนรถ </th>
                      <th> ยี่ห้อ </th>
                      <th> รุ่น </th>
                      <th> ประเภท </th>
                      <th>  </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> นาย 123 456 </td>
                      <td> กท 1234 </td>
                      <td> Subaru </td>
                      <td> BRZ </td>
                      <td> รถซิ่ง </td>
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
                      <td> นาย กขค ฟหกด </td>
                      <td> กท 1111 </td>
                      <td> Toyota </td>
                      <td> Supra </td>
                      <td> รถซิ่ง </td>
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
