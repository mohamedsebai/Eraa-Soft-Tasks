<?php 

class Auth extends DBConnect{

    
    public function insertData($username, $email, $password, $profile_img, $role){
        global $db;
        $q = "INSERT INTO users(username, email, password, profile_img, role) VALUES(?,?,?,?,?)";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $username, $email, $password, $profile_img ,$role]);
    }

    public function register($username, $email, $password_hashed, $new_img_name, $role){
        if($this->insertData($username, $email, $password_hashed, $new_img_name, $role)){
            return true;
        }else{
            return false;
        }
    }

    function getSingleUserData($email, $role){
        global $db;
        $q = "SELECT * FROM users WHERE email = ? AND role = ?";
        $stmt = $db->connect()->prepare($q);
        $stmt->execute([$email, $role]);
        $fetchedData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if($count > 0){
        $data = $fetchedData[0];
        }else{
        $data = $fetchedData;
        }
        $userData = [
        'data' => $data,
        'count' => $count
        ];
        return $userData;
    }

    public function login($role,$email,$password){
        $count = $this->getSingleUserData($email, $role)['count'];
        if($count > 0){
            $userData = $this->getSingleUserData($email, $role)['data'];
            if($userData['email'] == $email){
                if(password_verify($password, $userData['password'])){
                    $_SESSION['role_admin']   = 'role_admin';
                    $_SESSION['email']   = $userData['email'];
                    $_SESSION['user_id'] = $userData['id'];
                    $_SESSION['img'] = $userData['profile_img'];
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function logout(){

    }


}