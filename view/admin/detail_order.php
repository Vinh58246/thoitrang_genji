<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Chi tiết đơn hàng</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <?php
                            if(isset($_SESSION['notification']['destroy_list'])){
                                if($_SESSION['notification']['destroy_list'] == 1){
                                    echo '
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <i class="mdi mdi-check-all me-2"></i> Cập nhật trạng thái đơn hàng thành công!
                                        </div>
                                        ';
                                    unset($_SESSION['notification']['destroy_list']);
                                }
                            };
                        ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Theo dõi đơn hàng</h4>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <h5 class="mt-0">ID đơn hàng:</h5>
                                                    <p><?=$deltail_information_order['order_code']?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="updateorder" method="post">
                                            <div class="track-order-list">
                                                <?php
                                                    $selected = $deltail_information_order['order_status'];
                                                ?>
                                                <ul class="list-unstyled">

                                                    <li class="completed mb-2">
                                                        <h5 class="mt-0 mb-1 <?=$selected == 0 ? '' : 'text-muted'?>"> chờ xác nhận</h5>
                                                    </li>
                                                    <li class="completed mb-2">
                                                        <h5 class="mt-0 mb-1 <?=$selected == 1 ? '' : 'text-muted'?>"> đang chuẩn bị đơn hàng</h5>
                                                    </li>
                                                    <li class="completed mb-2">
                                                        <h5 class="mt-0 mb-1 <?=$selected == 2 ? '' : 'text-muted'?>"> đang vận chuyển</h5>
                                                    </li>
                                                    <li class="completed mb-2">
                                                        <h5 class="mt-0 mb-1 <?=$selected == 3 ? '' : 'text-muted'?>"> giao hàng thành công</h5>
                                                    </li>
                                                    <li class="completed">
                                                        <h5 class="mt-0 mb-1 <?=$selected == 4 ? '' : 'text-muted'?>"> đơn hàng đã hủy</h5>
                                                    </li>
                                                </ul>

                                                
                                                <select name="statusorder" id="" class="form-select mt-3">
                                                    <option <?=$selected == 0 ? 'selected' : ''?> value="0">chờ xác nhận</option>
                                                    <option <?=$selected == 1 ? 'selected' : ''?> value="1">đang chuẩn bị đơn hàng</option>
                                                    <option <?=$selected == 2 ? 'selected' : ''?> value="2">đang vận chuyển</option>
                                                    <option <?=$selected == 3 ? 'selected' : ''?> value="3">giao hàng thành công</option>
                                                    <option <?=$selected == 4 ? 'selected' : ''?> value="4">hủy đơn hàng</option>
                                                </select>

                                                <div class="text-center mt-3">
                                                    <input type="hidden" name="idorder" value="<?=$deltail_information_order['order_id']?>">
                                                    <button type="submit" class="btn btn-primary">Lưu Trạng Thái</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Các mặt hàng từ đơn đặt hàng <?=$deltail_information_order['order_code']?></h4>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-centered mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Sản phẩm</th>
                                                        <th>Thông tin</th>
                                                        <th>Số lượng</th>
                                                        <th>Giá</th>
                                                        <th>Tổng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $subtotal = 0; 
                                                        foreach ($allproductorder as $i) {
                                                            
                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?=$i['nameproduct']?></th>
                                                        <td><img src="public/assets/images_product/<?=$i['image']?>" alt="product-img" height="32"></td>
                                                        <td><?=$i['inforproduct']?></td>
                                                        <td><?=$i['quantity']?></td>
                                                        <td><?=number_format($i['price'])?></td>
                                                        <td><?=number_format($i['totalpriceproduct'])?></td>
                                                    </tr>
                                                    <?php 
                                                            $subtotal += $i['totalpriceproduct']; 
                                                        } 
                                                    ?>
                                                    <tr>
                                                        <th scope="row" colspan="5" class="text-end">Sub Total :</th>
                                                        <td><div class="fw-bold"><?=number_format($subtotal)?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="5" class="text-end">Shipping Charge :</th>
                                                        <td><div class="fw-bold"><?=number_format($deltail_information_order['shipping_price'])?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="5" class="text-end">Total :</th>
                                                        <td><div class="fw-bold"><?=number_format($subtotal + $deltail_information_order['shipping_price'])?> <span class="fw-normal">VNĐ</span></div></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Thông tin vận chuyển</h4>

                                        <h5 class="font-family-primary fw-semibold"><?=$deltail_information_order['fullname']?></h5>
                                        
                                        <p class="mb-2"><span class="fw-semibold me-2">Address:</span> <?=$deltail_information_order['order_address']?></p>
                                        <p class="mb-2"><span class="fw-semibold me-2">Email:</span> <?=$deltail_information_order['email']?></p>
                                        <p class="mb-2"><span class="fw-semibold me-2">Phone:</span> <?=$deltail_information_order['order_phone']?></p>
            
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Thông tin giao hàng</h4>
            
                                        <div class="text-center">
                                            <i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b>Giao hàng XPRESS</b></h5>
                                            <p class="mb-1"><span class="fw-semibold">ID đơn hàng :</span> <?=$deltail_information_order['order_code']?></p>
                                            <p class="mb-1"><span class="fw-semibold">Trạng thái thanh toán :</span> <?=($deltail_information_order['payment_status'] == 0) ? 'chưa thanh toán':'đã thanh toán'?></p>
                                            <p class="mb-0"><span class="fw-semibold">Kiểu thanh toán :</span> <?=$deltail_information_order['payment_method']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>