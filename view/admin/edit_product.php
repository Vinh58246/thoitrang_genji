<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Sửa sản phẩm</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Tổng quan</h5>

                                        <div class="mb-3">
                                            <label for="product-name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                            <input type="text" id="product-name" class="form-control" placeholder="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-description" class="form-label">Mô tả chi tiết <span class="text-danger">*</span></label>
                                            <div id="snow-editor" style="height: 150px;"></div> <!-- end Snow-editor-->
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-summary" class="form-label">Tóm tắt sản phẩm</label>
                                            <textarea class="form-control" id="product-summary" rows="3" placeholder=""></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-category" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="product-category">
                                                <option>Select</option>
                                                <optgroup label="Shopping">
                                                    <option value="SH1">Shopping 1</option>
                                                    <option value="SH2">Shopping 2</option>
                                                    <option value="SH3">Shopping 3</option>
                                                    <option value="SH4">Shopping 4</option>
                                                </optgroup>
                                                <!-- <optgroup label="CRM">
                                                    <option value="CRM1">Crm 1</option>
                                                    <option value="CRM2">Crm 2</option>
                                                    <option value="CRM3">Crm 3</option>
                                                    <option value="CRM4">Crm 4</option>
                                                </optgroup>
                                                <optgroup label="eCommerce">
                                                    <option value="E1">eCommerce 1</option>
                                                    <option value="E2">eCommerce 2</option>
                                                    <option value="E3">eCommerce 3</option>
                                                    <option value="E4">eCommerce 4</option>
                                                </optgroup> -->

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-price">Price <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="product-price" placeholder="vd: 1000000 => 1 triệu">
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-2">Trạng thái sản phẩm <span class="text-danger">*</span></label>
                                            <br/>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="radio" name="noibat" value="option1" id="inlineRadio1" checked>
                                                    <label class="form-check-label" for="inlineRadio1">Bình thường</label>
                                                </div>
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="radio" name="noibat" value="option2" id="inlineRadio2">
                                                    <label class="form-check-label" for="inlineRadio2">Nổi bật</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-2">Trạng thái <span class="text-danger">*</span></label>
                                            <br/>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="radio" name="radioInline" value="option1" id="inlineRadio1" checked>
                                                    <label class="form-check-label" for="inlineRadio1">Còn hàng</label>
                                                </div>
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="radio" name="radioInline" value="option2" id="inlineRadio2">
                                                    <label class="form-check-label" for="inlineRadio2">Hết hàng</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Ảnh đại diện</h5>
                                        <div class="drop-zone">
                                            <div class="drop-zone__prompt d-flex flex-column"><i class="h1 text-muted dripicons-cloud-upload"></i><span>Drop file here or click to upload</span></div>
                                            <input type="file" name="myFile" class="drop-zone__input">
                                        </div>
                                    </div>
                                </div> <!-- end col-->

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Ảnh con</h5>

                                        <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                                            data-upload-preview-template="#uploadPreviewTemplate">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>

                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                            </div>
                                        </form>

                                        <!-- Preview -->
                                        <div class="dropzone-previews mt-3" id="file-previews"></div>
                                    </div>
                                </div> <!-- end col-->

                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                                    <button type="button" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                                    <button type="button" class="btn w-sm btn-danger waves-effect waves-light">Delete</button>
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


            </div>