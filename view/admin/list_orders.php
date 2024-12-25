
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
                                                        // for ($i=0; $i < 20; $i++) { 
                                                        foreach ($arrodr as $i) {
                                                            
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?=$i['id']?>
                                                            </td>
                                                            <td><a href="ecommerce-order-detail.html" class="text-body fw-bold"><?=$i['order_code']?></a> </td>
                                                            <td>
                                                                <?php
                                                                    for ($j=0; $j < count($i['image']); $j++) { 
                                                                        echo '<a href="ecommerce-product-detail.html"><img src="public/assets/images_product/'.$i['image'][$j].'" alt="product-img" height="32" /></a>';
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?=$i['timetooder']?>
                                                            </td>
                                                            <td>
                                                                <h5>
                                                                <?php
                                                                    if($i['payment_status'] == 0){
                                                                        echo '<span class="badge bg-soft-warning text-warning"><i class="mdi mdi-bitcoin"></i> chưa thanh toán</span>';
                                                                    }else{
                                                                        echo '<span class="badge bg-soft-success text-success"><i class="mdi mdi-bitcoin"></i> đã thanh toán</span>';
                                                                    }
                                                                ?>
                                                                </h5>
                                                            </td>
                                                            <td>
                                                                <?=number_format($i['subprice'] + $i['shipping_price'])?> VNĐ
                                                            </td>
                                                            <td>
                                                                <?=$i['payment_method']?>
                                                            </td>
                                                            <td>
                                                                <h5>
                                                                <?php
                                                                    if($i['order_status'] == 0){
                                                                        echo '<span class="badge bg-warning">chờ xác nhận</span>';
                                                                    }elseif($i['order_status'] == 1){
                                                                        echo '<span class="badge bg-info">đang chuẩn bị đơn hàng</span>';
                                                                    }elseif($i['order_status'] == 2){
                                                                        echo '<span class="badge bg-primary">đang vận chuyển</span>';
                                                                    }elseif($i['order_status'] == 3){
                                                                        echo '<span class="badge bg-success">giao hàng thành công</span>';
                                                                    }else{
                                                                        echo '<span class="badge bg-danger">đơn hàng đã hủy</span>';
                                                                    }
                                                                ?>
                                                                </h5>
                                                            </td>
                                                            <td>
                                                                <a href="detail_order?id=<?=$i['idodr']?>" class="action-icon"> <i class="mdi mdi-eye"></i></a>
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

