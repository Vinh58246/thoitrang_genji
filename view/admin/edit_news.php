<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                    <form action="<?=ROOT_URL?>edit_news" method="post" enctype="multipart/form-data">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Sửa bài viết</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                        <div class="row">
                            <div>
                                <?php
                                    if(isset($notification)){
                                        if($notification == true){
                                            echo '
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <i class="mdi mdi-check-all me-2"></i> Đã sửa bài viết thành công!
                                            </div>
                                            ';
                                        }
                                        else{
                                            echo '
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <i class="mdi mdi-block-helper me-2"></i> Sửa thất bại!
                                            </div>
                                            ';            
                                        }
                                    }
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Ảnh đại diện</h5>

                                        <div>
                                            <div class="drop-zone">
                                                <div class="drop-zone__prompt d-flex flex-column"><img class="w-100" src="<?=PUBLIC_URL.'assets/images_news/'.$detail['avatar']?>" alt="profile-image"></div>
                                                <input type="file" name="avatar" class="drop-zone__input">
                                            </div>
                                        </div>

                                        <!-- Preview -->
                                        <div class="dropzone-previews mt-3" id="file-previews"></div>
                                    </div>
                                </div> <!-- end col-->

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Thông tin dữ liệu</h5>

                                        <div class="mb-3">
                                            <label for="product-meta-title" class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
                                            <input type="text" name="title" value="<?=$detail['title']?>" class="form-control" id="product-meta-title" placeholder="Enter title">
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-description" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                            <div id="snow-editor" style="min-height: 150px; max-height: 900px; overflow-y: auto;"></div> <!-- end Snow-editor-->
                                            <input type="hidden" name="content" id="conten" value="<?=$detail['content']?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-2">Trạng thái bài viết</label>
                                            <br/>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="radio" name="display" value="0" id="inlineRadio1" <?=($detail['display'] == 0) ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="inlineRadio1">Bình thường</label>
                                                </div>
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="radio" name="display" value="1" id="inlineRadio2" <?=($detail['display'] == 1) ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="inlineRadio2">Nổi bật</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-2">Trạng thái</label>
                                            <br/>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="radio" name="status" value="0" id="inlineRadio1" <?=($detail['status'] == 0) ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="inlineRadio1">Hiện bài viết</label>
                                                </div>
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="radio" name="status" value="1" id="inlineRadio2" <?=($detail['status'] == 1) ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="inlineRadio2">Ẩn bài viết</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?=$detail['id']?>">

                                    </div>
                                </div> <!-- end card -->

                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                <a href="news" class="btn w-sm btn-light waves-effect">Cancel</a>
                                <button type="submit" id="getall" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->


                        <!-- file preview template -->
                        <div class="d-none" id="uploadPreviewTemplate">
                            <div class="card mt-1 mb-0 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                        </div>
                                        <div class="col ps-0">
                                            <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                            <p class="mb-0" data-dz-size></p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                <i class="dripicons-cross"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- container -->

                </div> <!-- content -->
                <input type="hidden" id="click"/>
            </div>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        let framewriting = document.getElementsByClassName("ql-editor");
                        let getall = document.getElementById("getall");
                        let click = document.getElementById("click");
                        let content = document.getElementById("conten");

                        click.addEventListener("click", () => {
                            if (framewriting[0]) {
                                framewriting[0].innerHTML = content.value;
                            }
                        });

                        setTimeout(() => {
                            click.click();
                        }, 1000);

                        getall.addEventListener("click", () => {
                            if (framewriting[0]) {
                                content.value = framewriting[0].innerHTML;
                            }
                        });
                    });

                </script>