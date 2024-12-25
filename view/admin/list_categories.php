
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
                                    <h4 class="page-title">Danh sách danh mục</h4>
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
                        <form action="destroy_category" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex mb-2">
                                            <div class="me-2">
                                                <a href="create_category" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Thêm danh mục</a>
                                            </div>
                                            <div class="">
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
                                                        <th>Danh mục</th>
                                                        <th>Thứ tự</th>
                                                        <th>Trạng thái</th>
                                                        <th style="width: 75px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($allCategories as $i) {
                                                            
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?=$i['id']?>
                                                            </td>
                                                            <td class="table-user">
                                                                <img src="<?=PUBLIC_URL.'assets/image_category/'.$i['image']?>" alt="table-user" class="me-2 rounded-circle">
                                                                <a href="javascript:void(0);" class="text-body fw-semibold"><?=$i['name']?></a>
                                                            </td>
                                                            <td>
                                                                <?=$i['display_order']?>
                                                            </td>
                                                            <td>
                                                                <?=($i['status'] == 0) ? '<span class="badge badge-soft-success">Hiện</span>' : '<span class="badge badge-soft-warning">Ẩn</span>'?>
                                                            </td>
                        
                                                            <td>
                                                                <a href="detail_category?id=<?=$i['id']?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                                <a href="destroy_category?id=<?=$i['id']?>" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
                        </form>
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

