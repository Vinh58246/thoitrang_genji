
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
                                    <h4 class="page-title">Danh sách đơn hàng</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap dt-responsive nowrap w-100" id="products-datatable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 20px;">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>ID đơn hàng</th>
                                                        <th>Các sản phẩm</th>
                                                        <th>Thời gian</th>
                                                        <th>Trạng thái thanh toán</th>
                                                        <th>Tổng</th>
                                                        <th>Phương thức thanh toán</th>
                                                        <th>Trạng thái đơn hàng</th>
                                                        <th style="width: 125px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                        for ($i=0; $i < 20; $i++) { 
                                                            
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck<?=$i?>">
                                                                    <label class="form-check-label" for="customCheck<?=$i?>">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                            <td><a href="ecommerce-order-detail.html" class="text-body fw-bold">#UB9708<?=$i?></a> </td>
                                                            <td>
                                                                <a href="ecommerce-product-detail.html"><img src="public/assets/images/products/product-1.png" alt="product-img" height="32" /></a>
                                                                <a href="ecommerce-product-detail.html"><img src="public/assets/images/products/product-2.png" alt="product-img" height="32" /></a>
                                                            </td>
                                                            <td>
                                                                August 05 2018
                                                            </td>
                                                            <td>
                                                                <h5><span class="badge bg-soft-success text-success"><i class="mdi mdi-bitcoin"></i> Paid</span></h5>
                                                            </td>
                                                            <td>
                                                                $176.41
                                                            </td>
                                                            <td>
                                                                Mastercard
                                                            </td>
                                                            <td>
                                                                <h5><span class="badge bg-info">Shipped</span></h5>
                                                            </td>
                                                            <td>
                                                                <a href="?mod=admin&act=order&id=<?=$i?>" class="action-icon"> <i class="mdi mdi-eye"></i></a>
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

