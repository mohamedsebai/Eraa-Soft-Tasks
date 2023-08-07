<?php

include 'includes/header.php';
include 'includes/navigation.php';
if(!$session->check('role_admin')){
    $validation->redirect('login.php');
}

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['addProduct'])){

            $user_id = $_POST['user_id'];
            $category_id = $_POST['category_id'];

            $prd_name = $validation->handelInput($_POST['prd_name']);
            $prd_brand_name = $validation->handelInput($_POST['prd_brand_name']);
            $prd_price = $validation->handelInput($_POST['prd_price']);
            $prd_discount = $validation->handelInput($_POST['prd_discount']);
            $prd_size = $validation->handelInput($_POST['prd_size']);
            $prd_quantity = $validation->handelInput($_POST['prd_quantity']);
            


            $prd_image       = $_FILES['prd_image'];
            $img_name        = $prd_image['name'];
            $img_tmp_name    = $prd_image['tmp_name'];
            $img_type        = $prd_image['type'];
            $img_error       = $prd_image['error'];
            $img_size        = $prd_image['size'];


            $form_errors = array();

            // file extension
            $allowed_extension = ['png', 'jpg', 'jpeg'];

            $file_extension = $validation->file_extension($img_name);

            // file mime type
            $allowed_mime_type = ['image/png', 'image/jpg', 'image/jpeg'];


            if( $img_error == 4){
                    $form_errors['image_error'] = 'choose an image for your profile';
                }else{ // that mean error is 0
                    if( $img_error == 0
                                    && in_array($file_extension, $allowed_extension) 
                                    &&  in_array(mime_content_type($img_tmp_name), $allowed_mime_type) 
                                    &&  $img_size > 1298034728934073 ){
                        $form_errors['image_error']  = 'profile image it\'s large';
                    }
                    if($img_error == 0 && !in_array($file_extension, $allowed_extension)){
                        $form_errors['image_error'] = 'not valid file please chosse image';
                    }

                    if($img_error == 0 && in_array($file_extension, $allowed_extension) 
                    && !in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){
                        $form_errors['image_error'] = 'content of file is not image';
                    }

                    if($img_error == 0 
                                    && in_array($file_extension, $allowed_extension)  
                                    && in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){

                        $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
                        $validation->uploade_file("uploaded_imgs\\",$img_tmp_name, $new_img_name);
                    }
                }

            if(empty($prd_name)){
                $form_errors['name_error'] = 'Product name name Cann\'t be empty';
            }
            
            if(empty($prd_brand_name)){
                $form_errors['brand_name_error'] = 'Brand name Cann\'t be empty';
            }
            if(empty($prd_price) ){
                $form_errors['price_error'] = 'Price can not be empty';
            }
            if(empty($prd_discount)){
                $form_errors['discount_error'] = 'Discount can no be empty if there is no discount make it equal zero';
            }
            if(empty($prd_quantity)){
                $form_errors['quantity_error'] = 'Quantity can no be empty if there is no Quantity make it equal zero';
            }

            $array_with_size = ['s', 'm', 'l', 'xl', 'xxl', 'xs', ''];
            if(!in_array($prd_size, $array_with_size)){
                $form_errors['size_error'] = 'Insert perfict size';
            }

            if(empty($form_errors)){
                if($product->insertProductData($prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $new_img_name, $category_id, $user_id)){
                    $success = 'data update successfully!';
                }else{
                    $error = 'try agian later!';
                }
                ?>
            <?php } // empty form_errors ?>
    <?php
    }// end 
}
?>
<?php 

    if(isset($success)){ ?>
        <div class="container">
            <div class='alert alert-success' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
            <?php echo $success; ?>
            </div>
        </div>
    <?php }; ?>

    <?php if(isset($error)){ ?>
        <div class="container">
                <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $error; ?>
                </div>
            </div>
    <?php }; ?>

    
    <div class="create_products">
    <div class="container">
        <div class="row"> 

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>Add Prdoucts</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="m-auto" enctype="multipart/form-data">

            <input type="hidden" name="user_id" value="<?php echo $session->get('user_id'); ?>">

            <!-- Start prd_name -->
            <div class="form-group">
                <label>prd_name:</label>
                <input type="text" placeholder="prd_name" class="form-control" name="prd_name" ">
                <?php if(isset($form_errors['name_error']) && !empty($form_errors['name_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['name_error']; ?></div>
                <?php } ?>
            </div>

            <!-- Start prd_quantity -->
            <div class="form-group">
                <label>prd_quantity:</label>
                <input type="text" placeholder="prd_quantity" class="form-control" name="prd_quantity" ">
                <?php if(isset($form_errors['quantity_error']) && !empty($form_errors['quantity_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['quantity_error']; ?></div>
                <?php } ?>
            </div>

            <!-- Start prd_brand_name -->
            <div class="form-group">
                <label>prd_brand_name:</label>
                <input type="text" placeholder="prd_brand_name" class="form-control" name="prd_brand_name" ">
                <?php if(isset($form_errors['brand_name_error']) && !empty($form_errors['brand_name_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['brand_name_error']; ?></div>
                <?php } ?>
            </div>


            <!-- Start prd_price -->
            <div class="form-group">
                <label>prd_price:</label>
                <p style="color: red;">Make discount number with $ like (10$) not only number and must only dollar sign</p>
                <input type="text" placeholder="prd_price" class="form-control" name="prd_price" ">
                <?php if(isset($form_errors['price_error']) && !empty($form_errors['price_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['price_error']; ?></div>
                <?php } ?>
            </div>


            <!-- Start prd_discount -->
            <div class="form-group">
                <label>prd_discount:</label>
                <p style="color: red;">Make discount number with % like (10%) not only number</p>
                <input type="text" placeholder="prd_discount" class="form-control" name="prd_discount" ">
                <?php if(isset($form_errors['discount_error']) && !empty($form_errors['discount_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['discount_error']; ?></div>
                <?php } ?>
            </div>

            <!-- Start prd_size -->
            <div class="form-group">
                <label>prd_size:</label>
                <p style="color: red;">size ('s', 'm', 'l', 'xl', 'xxl', 'xs') or leave it empty if products doesnot have size</p>
                <input type="text" placeholder="prd_size" class="form-control" name="prd_size" ">
                 <?php if(isset($form_errors['size_error']) && !empty($form_errors['size_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['size_error']; ?></div>
                <?php } ?>
            </div>


            <!-- Start Username -->
            <div class="form-group">
                <label>Category Name:</label>
                <select name="category_id">

                <?php 

                    $count = $category->getDataCategoryWithNoCondtion()['count'];
                    if($count > 0){
                        $row   = $category->getDataCategoryWithNoCondtion()['row'];
                    foreach($row as $data_cat){ ?>

                    <option value="<?php echo $data_cat['id']; ?>"><?php echo $data_cat['cat_name']?></option>
                <?php }   }else{
                    echo 'there is no category please create at least one category';
                } ?>
                    
                </select>
            </div>

            <!-- Start Profile Image -->
            <label>Choose Profile Image: with jpg or png or jpeg only</label>
            <input type="file" name="prd_image">
            <?php if(isset($form_errors['image_error']) && !empty($form_errors['image_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['image_error']; ?></div>
                <?php } ?>



            <input type="submit" class="form-control btn btn-primary d-block" value="continue" name="addProduct">
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

<?php include 'includes/footer.php'; ?>