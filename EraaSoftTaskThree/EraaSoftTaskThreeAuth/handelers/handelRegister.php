<?php

session_start();

require('../includes/functions.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['register'])){

        $username = handelInput($_POST['username']);
        $email = handelInput($_POST['email']);
        $password = handelInput($_POST['password']);

        $form_errors = array();

        if(strlen($username) < 3){
            $form_errors[] = 'Username Must be larger than 2 characters';
        }
        if($email == ''){
            $form_errors[] = 'Email Cann\'t be empty';
        }
        if(strlen($password) < 6){
            $form_errors[] = 'Password Must be larger than 5 characters';
        }


        $file = file_get_contents('../data/users.json');
        $json_data = json_decode($file, true);


        
        if(empty($json_data)){
            $json_data = [];
        }

        foreach($json_data as $data){
            if($data['email'] == $_POST['email']){
                $form_errors[] = 'email is alerady exisit';
                break;
            }
        }

        if(! empty($form_errors) ){
            $_SESSION['errors'] = $form_errors;
            header('Location: ../register.php');
            exit();
        }
        // not empty error

        if(empty($form_errors)){

            $extra = array(
                'id'       => end($json_data)['id'] + 1,
                'username' => $_POST['username'],
                'email'    => $_POST["email"],
                'password' => $_POST["password"],
            );
            array_push($json_data, $extra);
            $final_data = json_encode($json_data);
        
            file_put_contents('../data/users.json', $final_data);

            $_SESSION['auth'] = [$email, $username];
            header('Location: ../profile.php');
        

            ?>

        <?php } // empty form_errors ?>
<?php
}// end 
}else{
        header('Location: index.php');
        exit();
} // end check request method ?>
