<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Thông tin của tôi</h4>
                                </div>
                            </div>
                        </div>      
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-4 col-xl-4"></div> <!-- end col -->

                            <div class="col-lg-4 col-xl-4">
                                <form action="<?=ROOT_URL?>edit_profile" method="post" enctype="multipart/form-data">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            
                                

                                            <div class="position-relative d-inline-block">
                                                <div class="drop-avatar">
                                                    <div class="drop-avatar__prompt d-flex flex-column"><img src="public/assets/image_user/<?=$_SESSION['user']['avatar']?>" style="object-fit: cover;" class="rounded-circle avatar-lg img-thumbnail"
                                                    alt="profile-image"></div>
                                                    <input type="file" name="avatar" class="drop-avatar__input">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">

                                                <h4 class="mb-0"><input type="text" name="fullname" class="form-control" value="<?=$_SESSION['user']['fullname']?>" id="inputTen" placeholder="Tên đầy đủ" /></h4>
                                            </div>

                                            <div class="text-start mt-3">

                                                <div class="row mb-3">
                                                    <label for="inputPhone" class="col-3 col-form-label">Phone</label>
                                                    <div class="col-9">
                                                        <input type="number" name="phone" value="<?=$_SESSION['user']['phone']?>" class="form-control" id="inputPhone" placeholder="Số điện thoại" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail" class="col-3 col-form-label">Email</label>
                                                    <div class="col-9">
                                                        <input type="email" readonly value="<?=$_SESSION['user']['email']?>" class="form-control" id="inputEmail" placeholder="Email" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail" class="col-3 col-form-label">Mật khẩu</label>
                                                    <div class="col-9">
                                                        <a href="lock_screen" class="w-100 btn btn-primary waves-effect waves-light me-1">Đổi mật khẩu</a>
                                                    </div>
                                                </div>

                                            </div>                                    
                                            

                                            <button type="submit" class="btn btn-success waves-effect waves-light">Lưu</button>
                                                                            
                                        </div>                                 
                                    </div> <!-- end card -->
                                </form>

                            </div> <!-- end col-->

                            
                            <div class="col-lg-4 col-xl-4"></div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->

            </div>