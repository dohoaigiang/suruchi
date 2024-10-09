<?php
    // cataloglist
    $catalog_html='';
    $c_id = $_GET['id'];
    $select_name = '';
    $select_img = '';
    foreach ($cataloglist as $item) {
        $id = $item['id'];
        $img = $item['img'];
        $name = $item['name'];
        if($id == $c_id) {
            $select_name = $name;
            $select_img = $img;
        }
        $linkedit='<a class="dropdown-item" href="index.php?pg=page-update-dm&id='.$id.'">Sửa Danh Mục</a>';
        $linkdel='<a class="dropdown-item text-danger" href="index.php?pg=deletedm&id='.$id.'">Xóa</a>';
        $catalog_html.='<tr>
                            <td>'.$id.'</td>    
                            <td><img  src="../uploads/'.$img.'" style="width: 50px; alt="" ></td>
                            <td><b>'.$name.'</b></td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        '.$linkedit.'
                                        '.$linkdel.'
                                    </div>
                                </div>
                                
                            </td>
                        </tr>';
    }

    if(is_array($dm)&&(count($dm)>0)){
        $idupdate=$c_id;
        $imgpath=IMG_PATH_ADMIN.$select_img;
        if(is_file($imgpath)){
          $img=$imgpath;
          $old_img=basename($imgpath);
        }else{
          $img="";
        }
      }
?>

<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Danh mục </h2>
        </div>
        <div>
            <input type="text" placeholder="Tìm kiếm danh mục" class="form-control bg-white">
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <form action="index.php?pg=updatedm" method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="product_slug" class="form-label">Tên Danh mục</label>
                            <input name="name" type="text" placeholder="Nhập tên danh mục" class="form-control" id="product_slug" value="<?=($select_name!="")?$select_name:"";?>"/>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Hình ảnh</h4>
                            </div>
                            <div class="card-body">
                                <div class="input-upload">
                                    <img src="<?=$imgpath?>" alt="">
                                    <input name="img" class="form-control" type="file">
                                </div>  
                            </div>
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="id" value="<?=$idupdate?>">
                            <input type="hidden" name="old_img" value="<?=$old_img?>">
                            <button type="submit" name="updatedm" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Ảnh danh mục</th>
                                    <th>Tên Danh Mục</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?=$catalog_html?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- .col// -->
            </div>
            <!-- .row // -->
        </div>
        <!-- card body .// -->
    </div>
    <!-- card .// -->
</section>