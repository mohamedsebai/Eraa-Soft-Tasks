<?php


include 'includes/header.php';
include 'includes/navigation.php';
if(!$session->check('role_admin')){
    $validation->redirect('login.php');
}

if(isset($_GET['product_id']) && is_numeric($_GET['product_id'])){
    $product_id = $_GET['product_id'];
}else{
    $validation->redirect('categories.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['updateProduct'])){

            $id = $_POST['product_id'];
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
                    $new_img_name = $product->getProductById($product_id)['row']['prd_image']; // insert old image if there is no update for image 
                }else{ // that mean error is 0
                    if( $img_error == 0
                                    && in_array($file_extension, $allowed_extension)
                                    &&  in_array(mime_content_type($img_tmp_name), $allowed_mime_type) 
                                    &&  $img_size > 1298034728934073 ){
                        $form_errors[]  = 'profile image it\'s large';
                    }
                    if($img_error == 0 && !in_array($file_extension, $allowed_extension)){
                        $form_errors[] = 'not valid file please chosse image';
                    }

                    if($img_error == 0 && in_array($file_extension, $allowed_extension) 
                    && !in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){
                        $form_errors[] = 'content of file is not image';
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
                if($product->updateProductData($prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $new_img_name, $category_id ,$id)){
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

    if(isset($error)){ ?>
        <div class="container">
                <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $error; ?>
                </div>
            </div>
    <?php }; ?>

    <?php if(isset($success)){ ?>
        <div class="container">
                <div class='alert alert-success' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $success; ?>
                </div>
            </div>
    <?php }; ?>

    <?php
        $count = $product->getProductById($product_id)['count'];
        if($count > 0 ){
            $row   = $product->getProductById($product_id)['row'];
        }else{
            $validation->redirect('products.php');
        }
    ?>
    <div class="create_products">
    <div class="container">
        <div class="row"> 

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>update Prdoucts</h2>
            <form method="POST" class="m-auto" enctype="multipart/form-data">

            <input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">

            <!-- Start prd_name -->
            <div class="form-group">
                <label>prd_name:</label>
                <input type="text" placeholder="prd_name" class="form-control" name="prd_name" value="<?php echo $row['prd_name']; ?>">
            </div>

            <!-- Start prd_quantity -->
            <div class="form-group">
                <label>prd_quantity:</label>
                <input type="text" placeholder="prd_quantity" class="form-control" name="prd_quantity" value="<?php echo $row['prd_quantity']; ?>">
            </div>

            <!-- Start prd_brand_name -->
            <div class="form-group">
                <label>prd_brand_name:</label>
                <input type="text" placeholder="prd_brand_name" class="form-control" name="prd_brand_name" value="<?php echo $row['prd_brand_name']; ?>">
            </div>


            <!-- Start prd_price -->
            <div class="form-group">
                <label>prd_price:</label>
                <p style="color: red;">Make discount number with $ like (10$) not only number and must only dollar sign</p>
                <input type="text" placeholder="prd_price" class="form-control" name="prd_price" value="<?php echo $row['prd_price']; ?>">
            </div>


            <!-- Start prd_discount -->
            <div class="form-group">
                <label>prd_discount:</label>
                <p style="color: red;">Make discount number with % like (10%) not only number</p>
                <input type="text" placeholder="prd_discount" class="form-control" name="prd_discount" value="<?php echo $row['prd_price']; ?>">
            </div>


            <!-- Start prd_size -->
            <div class="form-group">

                <label>prd_size:</label>
                <p style="color: red;">size ('s', 'm', 'l', 'xl', 'xxl', 'xs') or leave it empty if products doesnot have size</p>
                <input type="text" placeholder="prd_size" class="form-control" name="prd_size" value="<?php echo $row['prd_size']; ?>">
            </div>


            <!-- Start Username -->
            <div class="form-group">
                <label>Category Name:</label>
                <select name="category_id">

                <?php 
                    $query = "SELECT * FROM categories ORDER BY id DESC";
                    $stmt  = $db->connect()->prepare($query);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    
                    if($count > 0){
                        $rowData   = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($rowData as $data_cat){ ?>

                    <option value="<?php echo $data_cat['id']; ?>"
                    <?php echo $row['category_id'] == $data_cat['id']  ? 'selected' : ''?> ><?php echo $data_cat['cat_name']?></option>
                <?php }   }else{
                    echo 'there is no category please create at least one category';
                } ?>
                    
                </select>
            </div>

            <!-- Start Profile Image -->
            <label>Choose Profile Image: with jpg or png or jpeg only</label>
            <input type="file" name="prd_image">

            <input type="submit" class="form-control btn btn-primary d-block" value="continue" name="updateProduct">
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

<?php include 'includes/footer.php'; ?>