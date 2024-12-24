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
                                    <p class="text-muted mb-4 mt-3">Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một email có mã để đặt lại mật khẩu.</p>
                                </div>

                                <form action="<?=ROOT_URL?>__recover_pw" method="post">

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Địa chỉ email</label>
                                        <input class="form-control" name="mail" type="email" id="emailaddress" required placeholder="Nhập email của bạn">
                                    </div>

                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit" onclick="loadchangemail(this)"><span id="loadmail" style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Xác nhận email </button>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Quay lại <a href="<?='login'?>" class="text-white ms-1"><b>Đăng nhập</b></a></p>
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
            function loadchangemail(e){
                var loadmail = document.getElementById('loadmail');
                loadmail.style.display = 'inline-block';
                setTimeout(function() {
                    loadmail.style.display = 'none';
                }, 30000);
            }
         </script>