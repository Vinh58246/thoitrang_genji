
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
                        <?php
                            if(isset($_SESSION['notification']['destroy_list'])){
                                if($_SESSION['notification']['destroy_list'] == 1){
                                    echo '
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <i class="mdi mdi-check-all me-2"></i> Đã xóa thành công!
                                        </div>
                                        ';
                                    unset($_SESSION['notification']['destroy_list']);
                                }else{
                                    echo '
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <i class="mdi mdi-block-helper me-2"></i> Xóa thất bại!
                                        </div>
                                        ';    
                                    unset($_SESSION['notification']['destroy_list']);
                                }
                            };
                        ?>
                        <form action="destroy_comment" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex mb-2">
                                            <div>
                                                <div class="dropdown mt-sm-0">
                                                    <button type="submit" class="btn btn-danger mb-2">
                                                        Xóa</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

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
                                                        <th>Danh sách ảnh</th>
                                                        <th>Đánh giá</th>
                                                        <th>Thời gian</th>
                                                        <th style="width: 75px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                        foreach ($all_comments as $i) {
                                                            
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?=$i['id']?>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="text-body fw-semibold"><?=$i['nameproduct']?></a>
                                                        </td>
                                                        <td class="table-user">
                                                            <img src="public/assets/image_user/<?=$i['avatar']?>" alt="table-user" class="me-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body fw-semibold"><?=$i['nameuser']?></a>
                                                        </td>
                                                        
                                                        <td>
                                                            <?=$i['content']?>
                                                            <!-- <spa class="mt-0 sp-line-1"> </spa> -->
                                                        </td>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <?php
                                                                if(!empty($i['listimage'])){
                                                                    $listimage = explode('@-@', $i['listimage']);
                                                                    for ($j=0; $j < count($listimage); $j++) { 
                                                                        echo '<div style="width: 50px; height: 50px;"><img src="public/assets/image_comment/'.$listimage[$j].'" alt="table-user" class="w-100 me-2 rounded img-thumbnail"></div>';
                                                                    }
                                                                }
                                                                else{
                                                                    echo '<div>Không có ảnh nào</div>';
                                                                }
                                                            ?>
                                                            </div>
                                                            
                                                            <!-- <spa class="mt-0 sp-line-1"> </spa> -->
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-star text-warning"></i> <?=$i['evaluate']?>
                                                        </td>
                                                        <td>
                                                            <?=($i['status'] == 0) ? '<span class="badge badge-soft-success">Hiện</span>' : '<span class="badge badge-soft-warning">Đã thu hồi</span>'?>
                                                        </td>
                                                        <td>
                                                            <?=$i['created_at']?>
                                                        </td>
                    
                                                        <td>
                                                            <a href="destroy_comment?id=<?=$i['id']?>" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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

