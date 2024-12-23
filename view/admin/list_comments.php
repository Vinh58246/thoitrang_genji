
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Danh sách bình luận</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20px;">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Người dùng</th>
                                                        <th>Nội dung</th>
                                                        <th>Đánh giá</th>
                                                        <th>Thời gian</th>
                                                        <th style="width: 75px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                        for ($i=0; $i < 10; $i++) { 
                                                            
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                <label class="form-check-label" for="customCheck2">ABC</label>
                                                            </div>
                                                        </td>
                                                        <td>quần áo nam</td>
                                                        <td class="table-user">
                                                            <img src="public/assets/images/users/user-4.jpg" alt="table-user" class="me-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body fw-semibold">Paul J. Friend</a>
                                                        </td>
                                                        
                                                        <td>
                                                            Jones Men's T-shirt (Blue)
                                                            <!-- <spa class="mt-0 sp-line-1"> </spa> -->
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-star text-warning"></i> 4.9
                                                        </td>
                                                        <td>
                                                            August 05 2019 <small class="text-muted">10:29 PM</small>
                                                        </td>
                    
                                                        <td>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                        }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                         
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

