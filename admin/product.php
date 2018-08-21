<?php
require '../__layout/header.php';
switch ($_SESSION['role_id']) {
    case $_SESSION['role_id'] = 1:
        require '../__layout/navi.php';
        if ($_SESSION['role_id'] != 1) {
          echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");</script>';
        }
        break;
    case $_SESSION['role_id'] = 2:
        require '../__layout/user_navi.php';
        if ($_SESSION['role_id'] != 2) {
          echo '<script>alert("คุณไม่มีสิทธิ์ในการเข้าถึงข้อมูล..กรุณาติดต่อผู้ดูแลระบบ");</script>';
        }
        break;
    default:
    require '../__layout/user_navi.php';
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
                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลสินค้า</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                            <form>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">รุ่น/รหัสสินค้า</label>
                                    <input type="Product" class="form-control" id="inputProduct" placeholder="สินค้า">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="inputProductName">ชื่อสินค้า</label>
                                  <input type="ProName" class="form-control" id="inputProductName" placeholder="ชื่อสินค้า">
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="inputProducer">ชื่อผู้ผลิต</label>
                            <input type="text" class="form-control" id="inputProducer" placeholder="ชื่อบริษัทผู้ผลิตสินค้า">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-5">
                              <label for="inputNumber">หมายเลขสินค้า</label>
                              <input type="text" class="form-control" id="inputNumber" placeholder="หมายเลขสินค้า">
                          </div>
                          
                        <div class="form-group col-md-7">
                          <label for="inputType">ประเภทสินค้า</label>
                          <input type="text" class="form-control" id="inputType" placeholder="ประเภทสินค้า">
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
                            <h3 class="card-title"> ข้อมูลสินค้า </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table">
                            <thead>
                              <tr>
                                <th> รุ่น/รหัสสินค้า </th>
                                <th> ชื่อ </th>
                                <th> ผู้ผลิต </th>
                                <th> หมายเลข </th>
                                <th> ประเภท </th>
                                <th>  </th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 000 </td>
                                    <td> H2O </td>
                                    <td> AOP </td>
                                    <td> 0001 </td>
                                    <td> H2O </td>
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
                                    <td> 000 </td>
                                    <td> H2O </td>
                                    <td> AOP </td>
                                    <td> 0002 </td>
                                    <td> H2O </td>
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
