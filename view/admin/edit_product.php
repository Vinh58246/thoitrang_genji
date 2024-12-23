<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <form action="<?=ROOT_URL?>edit_product" method="post" enctype="multipart/form-data">
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
                                <?php
                                    if(isset($notification)){
                                        if($notification == true){
                                            echo '
                                            <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <i class="mdi mdi-check-all me-2"></i> Sửa sản phẩm thành công!
                                            </div>
                                            ';
                                        }
                                        else{
                                            echo '
                                            <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <i class="mdi mdi-block-helper me-2"></i> Sửa thất bại!
                                            </div>
                                            ';            
                                        }
                                    }
                                ?>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Tổng quan</h5>

                                            <div class="mb-3">
                                                <label for="product-name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="<?=$detail['name']?>" id="product-name" class="form-control" placeholder="">
                                            </div>

                                            <div class="mb-3">
                                                <label for="product-description" class="form-label">Mô tả chi tiết</label>
                                                <div id="snow-editor" style="height: 150px;"></div> <!-- end Snow-editor-->
                                                <input type="hidden" value='<?=$detail['detailed_description']?>' name="detailed_description" id="conten">
                                            </div>

                                            <div class="mb-3">
                                                <label for="product-summary" class="form-label">Tóm tắt sản phẩm <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="product_summary" id="product-summary" rows="3" placeholder=""><?=$detail['product_summary']?></textarea>
                                            </div>

                                            <div class="mb-3">

                                                <label for="product-category" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="idcategory" id="product-category">
                                                    <option value="0">Lựa chọn</option>

                                                    <optgroup label="Danh mục">
                                                        <?php
                                                            foreach ($allCategories as $i) {
                                                                if($i['id'] == $detail['idcategory']){
                                                        ?>
                                                                <option selected value="<?=$i['id']?>"><?=$i['name']?></option>;
                                                        <?php
                                                                }else{
                                                        ?>
                                                                <option value="<?=$i['id']?>"><?=$i['name']?></option>;
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </optgroup>

                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="product-price">Giá <span class="text-danger">*</span></label>
                                                <input type="number" value="<?=$detail['price']?>" name="price" class="form-control" id="product-price" placeholder="vd: 1000000 => 1 triệu">
                                            </div>

                                            <div class="mb-3">
                                                <label for="product-price">Số lượng</label>
                                                <input type="number" value="<?=$detail['quantity']?>" name="quantity" class="form-control" id="product-price" placeholder="Nhập số lượng sản phẩm">
                                            </div>

                                            <div class="mb-3">
                                                <label class="mb-2">Trạng thái sản phẩm</label>
                                                <br/>
                                                <div class="d-flex flex-wrap">
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="radio" name="hot" value="0" id="inlineRadio1" checked>
                                                        <label class="form-check-label" for="inlineRadio1">Bình thường</label>
                                                    </div>
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="radio" name="hot" value="1" id="inlineRadio2">
                                                        <label class="form-check-label" for="inlineRadio2">Nổi bật</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="mb-2">Trạng thái</label>
                                                <br/>
                                                <div class="d-flex flex-wrap">
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="radio" name="status" value="0" id="inlineRadio1" checked>
                                                        <label class="form-check-label" for="inlineRadio1">Còn hàng</label>
                                                    </div>
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="radio" name="status" value="1" id="inlineRadio2">
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
                                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Ảnh đại diện <?=$detail['image']?></h5>
                                            
                                            <div class="drop-zone">
                                                <div class="drop-zone__prompt d-flex flex-column"><img class="w-100" src="<?=PUBLIC_URL.'assets/images_product/'.$detail['image']?>" alt="profile-image"></div>
                                                <input type="file" name="image" class="drop-zone__input" accept="image/*">
                                            </div>
                                        </div>
                                    </div> <!-- end col-->

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Ảnh con</h5>


                                            <label class="custom-file-upload">
                                                <input style="display: none;" type="file" name="list_image[]" onchange="docfile()" id="upload" multiple
                                                            accept="image/*">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                    <h4 class="text-muted">Nhấp để chọn các ảnh con</h4>
                                                </div>
                                            </label>
                                            <?php
                                                $string_list = '';
                                                foreach ($list_image as $i) {
                                                    $string_list .= $i['id'].'#-#'.$i['image'].'#-#'.$i['size_image'].'#-#'.$i['display_order'].'@-@';
                                                }
                                                echo '<input type="hidden" value="'.$string_list.'" id="stringlistimage" />'
                                            ?>
                                            

                                            <div id="preview-files"></div>
                                        </div>

                                        
                                    </div> <!-- end col-->

                                </div> <!-- end col-->
                            </div>

                            <div id="showframeattributesvariant">
                                
                            </div>

                            <!-- đang làm tới hiển thị mảng variant ra input từ input này đem vào script -->
                            <?php
                                            if(isset($arrlinking) && !empty($arrlinking)){
                                                $string_variant = '';
                                                for ($i=0; $i < count($arrlinking); $i++) { 
                                                    // echo "<pre>";
                                                    // var_export($arrlinking);
                                                    // echo "</pre>";
                                                    // for ($j=0; $j < count($arrlinking[$i][2]); $j++) {
                                                    //         echo "<pre>";
                                                    //     var_export($arrlinking[$i][2][$j]);
                                                    //     echo "</pre>";
                                                    // }
                                                    
                                                    $arrlinking[$i][2] = implode('!-!', $arrlinking[$i][2]);
                                                    //     $arrlinking[$i][2][$j] = implode(' ', $name_info);
                                                    //     echo "<pre>";
                                                    //     var_export($arrlinking[$i][2][$j]);
                                                    //     echo "</pre>";
                                                    // }
                                    // implode(' ', $name_info);
                                                        // for ($k=0; $k < count($arrvalue); $k++) { 

                                                    $string_variant .= $arrlinking[$i][0].'#-#'.$arrlinking[$i][1].'#-#'.$arrlinking[$i][2].'#-#'.$arrlinking[$i][3].'#-#'.$arrlinking[$i][4].'#-#'.$arrlinking[$i][5].'$-$';
                                                }
                                                // echo "<pre>";
                                                // var_export($arrlinking);
                                                // echo "</pre>";
                                                echo '<input type="hidden" value="'.$string_variant.'" id="stringlistvariant" />';
                                            }
                                           
                                            // foreach ($list_image as $i) {
                                            //     $string_list .= $i['id'].'#-#'.$i['image'].'#-#'.$i['size_image'].'#-#'.$i['display_order'].'@-@';
                                            // }
                                            // echo '<input type="hidden" value="'.$string_list.'" id="stringlistimage" />'
                                        ?>
                            <!-- end row -->
                            <input type="hidden" name="id" value="<?=$detail['id']?>">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mb-3">
                                    <a href="products" class="btn w-sm btn-light waves-effect">Cancel</a>
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

                        </form>
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


                    let stringlistimage = document.getElementById('stringlistimage');
                    let stringlistvariant = document.getElementById('stringlistvariant');
                    // console.log(stringlistvariant);
                    var listimage = handlestringlistimage(stringlistimage.value);



                    
                    function handlestringlistimage(strlist){
                        let arrlist = strlist.split('@-@');
                        var arr2list = [];
                        arrlist.pop();
                        for (let i = 0; i < arrlist.length; i++) {
                            arr2list[i] = arrlist[i].split('#-#');
                        }
                        return arr2list;
                    }
                    
                    // console.log(listimage);
                    docarrfile(listimage);

                    function docarrfile(liimage){
                        for (let i = 0; i < liimage.length; i++) {

                            let fileSizeInMB = '';
                            let type = '';
                            // nếu file có kích thước lớn tính bằng MB ngược lại Là KB
                            if(liimage[i][2] >= 1000000){
                                fileSizeInMB = (liimage[i][2] / (1024 * 1024)).toFixed(2);
                                type = 'MB';
                                
                            }else{
                                fileSizeInMB = (liimage[i][2] / 1024).toFixed(2);
                                type = 'KB';
                            }
                            
                            document.getElementById('preview-files').innerHTML += 
                                `<div class='dem' id='khungxoa${liimage[i][3]}'>
                                <div class='frame-previews my-2'>
                                <img src='public/assets/images_product/${liimage[i][1]}' class='img-preview'/>
                                        <div class='parameter-preview'>
                                            <p class='m-0'>${liimage[i][1]}</p>
                                            <p class='m-0'><strong>${fileSizeInMB}</strong> ${type}</p>
                                        </div>
                                    </div>
                                    </div>`;
                                }
                        
                            }
                            
                            function handlestringlistvariant(strvariant){
                                let arrlistv1 = strvariant.split('$-$');
                                let arrlistv2 = [];
                                // console.log(arrlistv1);
                                for (let i = 0; i < arrlistv1.length; i++) {
                                    arrlistv2[i] = arrlistv1[i].split('#-#');
                                }
        
                                return arrlistv2;
                            }

                            var datavariant = handlestringlistvariant(stringlistvariant.value);

                            showvariantcosan(datavariant);

                            function showvariantcosan(datavariant){
                                var showframeattributesvariant = document.getElementById('showframeattributesvariant');
                                console.log(datavariant);

                                showframeattributesvariant.innerHTML = 
                                    `<div class="card">
                                        <div class="card-body p-3">
                                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Các thuộc tính của biến thể</h5>

                                            <div id="showframeinputattributesvariant">
                                                
                                                
                                            </div>
                                        </div>
                                    </div>`;
                                
                                for (let i = 0; i < datavariant.length; i++) {
                                    rendercacvariantcosan(datavariant[i])
                                    
                                }
                                

                                
                                
                                
                            }

                            function rendercacvariantcosan(datacosan){
                                // console.log(datacosan);
                                var demkhung = datacosan[2].split('!-!');
                                var sthtmlvariant = '';
                                var valuevaricosan = [];
                                var anh = (datacosan[5] != '') ? datacosan[5] : 'bkwhite.jpg';
                                for (let i = 0; i < demkhung.length; i++) {
                                    valuevaricosan = demkhung[i].split('%-%');
                                    sthtmlvariant += 
                                    `<div class="mx-2">
                                        <label for="">giá trị ${i}</label>
                                        <input type="text" value="${valuevaricosan[1]}" name="value_attribute[]" class="form-control mt-2" readonly>
                                    </div>`;
                                    
                                }
                                

                                document.getElementById('showframeinputattributesvariant').innerHTML +=
                                    `<div class="mb-3 d-flex justify-content-between">
                                        <div class="mx-2">
                                            <label for="">hình ảnh</label>
                                            <div>
                                                <img style="width: 50px; height: 50px; border: 2px dashed #d4d4d4; border-radius: 5px;" src="public/assets/images_variant/${anh}"/>
                                            </div>
                                        </div>
                                        ${sthtmlvariant}
                                        <div class="mx-2">
                                            <label for="">giá tiền ( VNĐ )</label>
                                            <input type="text" value="${datacosan[3]}" name="price_attribute[]" class="form-control mt-2">
                                        </div>
                                        <div class="mx-2">
                                            <label for="">số lượng <span class="text-danger">*</span></label>
                                            <input type="text" value="${datacosan[4]}" name="quantity_attribute[]" class="form-control mt-2">
                                            <input type="hidden" value="${datacosan[0]}" name="id_linking_variant[]"/>
                                        </div>
                                    </div>`;

                                // Thêm script dropify.min.js vào cuối body
                                let script = document.createElement("script");
                                script.src = "public/assets/libs/dropify/js/dropify.min.js";
                                script.onload = function() {
                                    console.log("Dropify script loaded!");
                                    // Nếu dropify cần khởi tạo
                                    $('[data-plugins="dropify"]').dropify();
                                };
                                document.body.appendChild(script);
                            }
                            // alert(stringlistimage.value);
                        });
                        // let framewriting = document.getElementsByClassName("ql-editor");
                // let getall = document.getElementById("getall");
                // let content = document.getElementById("conten");
                // getall.addEventListener("click", () => {
                //     content.value = framewriting[0].innerHTML;
                // });


                function docfile() {
                    document.getElementById('preview-files').innerHTML = "";
                    var fileSelected = document.getElementById('upload').files;
                    if (fileSelected.length > 0) {

                        for (let i = 0; i < fileSelected.length; i++) {

                            var fileToLoad = fileSelected[i];
                            var fileReader = new FileReader();

                            // tên file
                            const fileName = fileToLoad.name;

                            // thông tin kích thước file
                            var fileSizeInBytes = fileToLoad.size;
                            let fileSizeInMB = '';
                            let type = '';
                            
                            // nếu file có kích thước lớn tính bằng MB ngược lại Là KB
                            if(fileSizeInBytes >= 1000000){
                                fileSizeInMB = (fileSizeInBytes / (1024 * 1024)).toFixed(2);
                                type = 'MB';
                                
                            }else{
                                fileSizeInMB = (fileSizeInBytes / 1024).toFixed(2);
                                type = 'KB';
                            }

                            var srcData = '';
                            var newImage = '';
                            

                            fileReader.readAsDataURL(fileToLoad);
                            fileReader.onload = function(fileLoaderEvent) {
                                srcData = fileLoaderEvent.target.result;
                                newImage = document.createElement('img');
                                newImage.classList.add('img-preview');
                                newImage.src = srcData;
                                // document.getElementById('displayImg').innerHTML += "<div id='khungxoa'>"+newImage.outerHTML+"<span onclick='this.parentElement.remove()'>xoa</span></div>";
                                // document.getElementById('displayImg').innerHTML += "<div id='khungxoa"+randomid+i+"'><div class='frame-previews my-2'>"+newImage.outerHTML+"<div class='parameter-preview'><p class='m-0'>"+fileName+"</p><p class='m-0'><strong>"+fileSizeInMB+"</strong> "+type+"</p></div><i class='mdi mdi-close icon-remove' onclick='removeFile("+randomid+i+")'></i></div></div>";
                                document.getElementById('preview-files').innerHTML += 
                                "<div class='dem' id='khungxoa"
                                    +i+"'><div class='frame-previews my-2'>"
                                    +newImage.outerHTML+"<div class='parameter-preview'><p class='m-0'>"
                                    +fileName+"</p><p class='m-0'><strong>"
                                    +fileSizeInMB+"</strong> "
                                    +type+"</p></div><i class='mdi mdi-close icon-remove' onclick='removeFile("
                                    +i+")'></i></div></div>";
                            }
                        }

                    }
                }
                function removeFile(index) {
                    
                    const input = document.getElementById('upload');
                    const dataTransfer = new DataTransfer(); // Tạo DataTransfer mới

                    // // Chuyển tất cả tệp không phải tệp cần xóa vào DataTransfer
                    for (let i = 0; i < input.files.length; i++) {
                        console.log(i);
                        if (i !== index) {
                            dataTransfer.items.add(input.files[i]);
                        }
                    }
                    input.files = dataTransfer.files; 
                    // document.getElementById('preview-files').innerHTML = "";
                    // document.getElementById('khungxoa' + index).remove();

                    docfile();
                }

                var btncreatename = document.getElementById('btncreatename');
                var shownamenewvariant = document.getElementById('shownamenewvariant');
                var showinputvaluevariant = document.getElementById('showinputvaluevariant');
                var showbtnvaluevariant = document.getElementById('showbtnvaluevariant');
                var showframeattributesvariant = document.getElementById('showframeattributesvariant');

                // var btnremovename = document.getElementById('btnremovename');

                btncreatename.addEventListener('click',() => {
                    shownamenewvariant.innerHTML += 
                    `<div class="soluongname">
                        <label for="listdanhsach" class="mt-2 form-label">Chọn tên biến thể</label>
                        <div class="d-flex align-items-center">
                            <div style="padding: 1px 6px;" class="me-2 btn btn-danger rounded-circle" onclick="btnremovename(this)">
                                <i style="font-size: 16px;" class="mdi mdi-minus"></i>
                            </div>
                            <div class="w-100">
                                <input list="danhsach" name="" class="form-control valuenamevariant" placeholder="Chọn biến thể có sẵn hoặc nhập biến thể khác"/>
                                <datalist id="danhsach" class="form-label">
                                    <option value="màu sắc"></option>
                                    <option value="kích thước"></option>
                                </datalist>
                            </div>
                        </div>
                    </div>`;
                    document.getElementById('showbtncreatevariant').innerHTML = 
                    `<button onclick="btncreatevariant()" id="idcreatevariant" type="button" class="my-3 btn w-sm btn-primary waves-effect waves-light">Tạo biến thể</button>`;
                });

                // nút xóa tên variant
                function btnremovename(e){
                    var soluongname = document.getElementsByClassName('soluongname');
                    e.parentElement.parentElement.remove();
                    if(soluongname.length == 0){
                        var btncreatevariant = document.getElementById('idcreatevariant');
                        btncreatevariant.remove();
                        showinputvaluevariant.innerHTML = '';
                        showbtnvaluevariant.innerHTML = '';
                    }
                }

                var namevariant = [];
                // nút tạo mới nhập giá trị
                function btncreatevariant(){
                    namevariant = [];
                    showinputvaluevariant.innerHTML = '';
                    showbtnvaluevariant.innerHTML =  '';
                    var valuenamevariant = document.getElementsByClassName('valuenamevariant');
                    
                    var arraynamecurrent = [];
                    // đổi giá trị trong class name bằng mảng
                    for (let i = 0; i < valuenamevariant.length; i++) {
                        if(valuenamevariant[i].value !== ''){
                            arraynamecurrent.push(valuenamevariant[i].value);
                        }
                    }
                    // lọc ra các tên giống nhau, thông qua mảng
                    var removenamealike = arraynamecurrent.filter((name, index) => arraynamecurrent.indexOf(name) === index);
   
                    for (let i = 0; i < removenamealike.length; i++) {
                        if(removenamealike[i] !== ''){
                            // hiển thị ra input nhập giá trị thông qua tên
                            renderFrameInputVariant(i, removenamealike[i]);
                            namevariant.push(removenamealike[i]);
                        }
                        
                    }
                }

                // hiển thị chỗ nhập giá trị biến thể
                function renderFrameInputVariant(sothutu, valueinput){
                    showinputvaluevariant.innerHTML += 
                    `
                        <div class="mb-2">
                            <label for="inputvariant${ sothutu }">${ valueinput }</label>
                            <input type="text" id="inputvariant${ sothutu }" class="form-control attributesvariant" placeholder="Nhập giá trị ( VD: S-M-L )">
                            <input type="hidden" value="${valueinput}" name="name_variant[]">
                        </div>
                    `;

                    showbtnvaluevariant.innerHTML = 
                    `
                        <div class="mt-2 d-flex justify-content-center">
                            <button onclick="btnCreateAttributeVariant()" type="button" class="btn w-sm btn-primary waves-effect waves-light"><i class="mdi mdi-plus"></i> Tạo giá trị biến thể</button>
                        </div>
                    `;

                }
                var attributevariant = [];

                // nút tạo ra các thuộc tính theo giá trị đã nhập
                function btnCreateAttributeVariant(){
                    var attributesvariant = document.getElementsByClassName('attributesvariant');
                    var flag = false;

                    for (let i = 0; i < attributesvariant.length; i++) {
                        if(attributesvariant[i].value == ''){
                            flag = true;
                        }
                    }
                    if(flag == true){
                        showframeattributesvariant.innerHTML = '';
                        return;
                    };


                    showframeattributesvariant.innerHTML = 
                        `<div class="card">
                            <div class="card-body p-3">
                                <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Các thuộc tính của biến thể</h5>
                                <div class="col-12 alert alert-warning alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <p class="m-0"><strong>Lưu ý: </strong>nếu không nhập số lượng của biến thể đó, thì biến thể đó sẽ không được lưu!</p>
                                </div>
                                <div id="showframeinputattributesvariant">
                                    
                                    
                                </div>
                            </div>
                        </div>`;
                    
                    
                    attributevariant = [];
                    var showframeinputattributesvariant = document.getElementById('showframeinputattributesvariant');
                    showframeinputattributesvariant.innerHTML = '';

                    for (let i = 0; i < attributesvariant.length; i++) {
                        if(attributesvariant[i].value !== ''){
                            handleArrayAndObject(attributesvariant[i].value);
                        }
                    }
                    renderAttributesOfVariant(attributevariant);
                    // console.log(attributevariant);

                }

                // xử lý giá trị variant từ chuỗi thành mảng, sau đó đưa mảng đó vào object
                function handleArrayAndObject(value){
                    // cắt giá trị variant thành mảng
                    var arrayattribute = value.split('-');
                    // thêm mảng giá trị vào mảng lớn
                    attributevariant.push(arrayattribute);

                    
                }

                // hiển thị các thuộc tính như vàng, S....
                function renderAttributesOfVariant(arrayAttributes){

                    let result = combineArrays(arrayAttributes);
                    
                    for (let i = 0; i < result.length; i++) {
                        showframeinputattributesvariant.innerHTML +=
                        `<div class="mb-3 d-flex justify-content-between">
                                <div class="mx-2">
                                    <label for="">hình ảnh</label>
                                    <div>
                                        <input type="file" name="images_attribute[]" data-plugins="dropify" />
                                    </div>
                                </div>
                                ${columinputvariant(result[i])}
                                <div class="mx-2">
                                    <label for="">giá tiền ( VNĐ )</label>
                                    <input type="text" name="price_attribute[]" class="form-control mt-2" placeholder="Nhập giá tiền">
                                </div>
                                <div class="mx-2">
                                    <label for="">số lượng <span class="text-danger">*</span></label>
                                    <input type="text" name="quantity_attribute[]" class="form-control mt-2" placeholder="Nhập số lượng">
                                </div>
                                <div class="d-flex align-items-center demattribute">
                                    <div style="padding: 1px 6px;" class="me-2 btn btn-danger rounded-circle" onclick="btnremoveattribute(this)">
                                        <i style="font-size: 16px;" class="mdi mdi-minus"></i>
                                    </div>
                                </div>
                            </div>`;
                    }

                    // Thêm script dropify.min.js vào cuối body
                    let script = document.createElement("script");
                    script.src = "public/assets/libs/dropify/js/dropify.min.js";
                    script.onload = function() {
                        console.log("Dropify script loaded!");
                        // Nếu dropify cần khởi tạo
                        $('[data-plugins="dropify"]').dropify();
                    };
                    document.body.appendChild(script);
                }

                function btnremoveattribute(e){
                    var demattribute = document.getElementsByClassName('demattribute');
                    e.parentElement.parentElement.remove();
                    if(demattribute.length <= 0){
                        showframeattributesvariant.innerHTML = '';
                    }
                }

                function columinputvariant(value){
                    var inputname = '';
                    console.log(namevariant);
                    console.log(value);

                    for (let i = 0; i < namevariant.length; i++) {
                        inputname += 
                        `<div class="mx-2">
                            <label for="">${namevariant[i]}</label>
                            <input type="text" value="${value[i]}" name="value_attribute[]" class="form-control mt-2" readonly>
                            <input type="hidden" value="${namevariant[i]}" name="name_attribute[]"/>
                        </div>`;
                    }

                    return inputname;
                }



                function totalObjectAttribute(ojatt){
                    var totalobj = 0;
                    for (let key in ojatt) {
                        if (ojatt.hasOwnProperty(key)) {
                            totalobj++;
                        }
                    }
                    return totalobj;
                }

                // tạo ra các thành phần khác nhau bằng đệ quy
                function combineArrays(arrays, index = 0, current = [], result = []) {
                    // Khi đã duyệt hết tất cả các mảng
                    if (index === arrays.length) {
                        // result.push(current.join(", ")); // Gộp các phần tử thành chuỗi và thêm vào kết quả
                        result.push([...current]); // Gộp các phần tử thành mảng
                        return result;
                    }

                    // Duyệt qua từng phần tử của mảng hiện tại
                    for (let item of arrays[index]) {
                        combineArrays(arrays, index + 1, [...current, item], result);
                    }

                    return result;
                }
            </script>