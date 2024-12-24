<body class="authentication-bg authentication-bg-pattern">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="public/assets/images/logo_genji_black.png" alt="" height="22">
                                            </span>
                                        </a>
                    
                                        <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo_genji_white.png" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Mã đã được gửi đến email của bạn.</p>
                                </div>

                                <form action="<?=ROOT_URL?>__confim_mail" method="post">
                                    <?php
                                        if(isset($notification)){
                                            if($notification == false){
                                                echo '
                                                <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    <i class="mdi mdi-block-helper me-2"></i> Nhập mã thất bại!
                                                </div>
                                                ';
                                            }
                                        }

                                        if(isset($_SESSION['notification']['auth'])){
                                            if($_SESSION['notification']['auth'] == 1){
                                                echo '
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        <i class="mdi mdi-check-all me-2"></i> Chúng tôi đã gửi mail lại cho bạn!
                                                    </div>
                                                    ';
                                                unset($_SESSION['notification']['auth']);
                                            }
                                        };
                                    ?>
                                    <div class="mb-3">
                                        <label for="mailcode" class="form-label">Mã</label>
                                        <input class="form-control" name="confimcode" type="text" id="mailcode" required placeholder="Nhập mã của bạn">
                                    </div>

                                    <div class="text-center d-grid mb-2">
                                        <button class="btn btn-primary" type="submit"> Xác nhận code </button>
                                    </div>
                                    <div class="text-center d-grid mb-3">
                                        <a href="resend_code" class="btn btn-outline-secondary" onclick="loadresendemail(this)"><span id="loadmail" style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Gửi lại mã </a>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Trở lại <a href="<?='login'?>" class="text-white ms-1"><b>Đăng Nhập</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <script>
            function loadresendemail(e){
                var loadmail = document.getElementById('loadmail');
                loadmail.style.display = 'inline-block';
                setTimeout(function() {
                    loadmail.style.display = 'none';
                }, 30000);
            }
         </script>