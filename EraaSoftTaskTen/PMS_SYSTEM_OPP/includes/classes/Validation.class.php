<?php 


class Validation{
    public function handelInput($input){
        return trim(htmlspecialchars($input));
    }

    public function redirect($path){
        header("Location: $path");
        exit();
    }


    public function file_extension($img_name){
        $file_extension = explode('.', $img_name);
        $file_extension = strtolower(end($file_extension));
        return $file_extension;
    }

    public function uploade_file($file_path_to_uploade, $img_tmp_name, $new_img_name){
        if(!file_exists($file_path_to_uploade)){ // if there is no file like this to uploade img within so we will create it 
            mkdir($file_path_to_uploade);
        }
        return move_uploaded_file( $img_tmp_name,  $file_path_to_uploade . $new_img_name );
    }

}