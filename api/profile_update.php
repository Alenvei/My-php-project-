<?php

    class Profile_update {
        private $db;
        private $VALIDATION;
        private $profile;
        private $UPLODER;
        protected $user_id;

        public function __construct($user_id){
            require 'db.php';
            require_once  'model/validation.php';
            require 'model/uploder.php';            
            require_once 'profile.php';
           
            $this->db = $db;
            $this->VALIDATION = new Validation();
            $this->profile = new Profile();
            $this->user_id = $user_id; 
            $this->UPLODER = new Uploder();     
        }
        //chcek profile form is valid 
        public function chcekIfValid(){

            $validPassword = $this->VALIDATION->password();
            $user = $this->profile->userData($this->user_id, false);
            $isValid = false;               
            $pass='';
            $errOldPass = '';
            $activOldPass ='';
            $activPass = '';
            $errPass = '';
            $result = '';
            $textarea ='';            
            $errFile = '';

            if ($_SERVER["REQUEST_METHOD"] === "POST"){ 
               
                if(!empty($_POST['oldpassword'])){

                    if(password_verify($_POST['oldpassword'], $user['user']['password'])){ 

                        if($validPassword){

                            $isValid = $validPassword['ifValid'];
                            $errPass = $validPassword['password'];
                            $activPass = $validPassword['errPass'];
                            $password = $validPassword['userPass'];

                        }else{

                            echo 'Password validation issue!';

                        }
                        if(password_verify($_POST['password'], $user['user']['password'])){
                            $isValid = false;
                            $errPass = '<span>Password can not be the same</span>';
                        }
                        
                        if($isValid){

                            $result = $this->changePassword($password, $this->user_id);
                            
                                if($result){
                                    $errPass = '<span id="correct">Your password was changed</span>'; 
                                    $isValid = false;                                   
                                }else{
                                    $errPass = '<span>Error changing password</span>';
                                    $isValid = false;
                                }
                        }

                    }else{

                        $isValid = false;
                        $errOldPass = '<span>Incorect password</span>';
                        $activOldPass = "style='border-color:red'";            

                    }
                               
                }

                if(!empty($_POST['textarea'])){

                    $textarea = $_POST['textarea'];
                    $this->bioUpdate( $textarea, $this->user_id);
                    $isValid = false;

                }          
                

                    $result = $this->UPLODER->imgUploder($user['user']['img_profile']);
                    $errFile = $result['err'];
                    $imgPath = $result['img'];
                   
                    if($result[ 'ok']){ 
                        $this->profileImg($imgPath, $this->user_id);                       
                    }            
                
                
                return[
                    
                    'ifValid' => $isValid,
                    'errPass' => $activPass,
                    'password' => $errPass,
                    'oldPassword' => $errOldPass,
                    'errOldPass' => $activOldPass,
                    'upload' =>  $errFile,
                ];            
            }           
        }
        // change the user's password
        private function changePassword($newPassword, $user){
            $stmt = $this->db->prepare('UPDATE users SET password = ? WHERE id = ?');
            $stmt->bindValue(1, $newPassword);
            $stmt->bindValue(2, $user);
            $user =  $stmt->execute();              

            return $user;
        }
        // change the user's bio
        private function bioUpdate($text, $user){
            $stmt = $this->db->prepare('UPDATE users SET bio = ? WHERE id = ?');
            $stmt->bindValue(1, $text);
            $stmt->bindValue(2, $user);
            $user = $stmt->execute();
        }
        // change the bio's img
        private function profileImg($img, $user){
            $stmt = $this->db->prepare('UPDATE users SET img_profile = ? WHERE id = ?');
            $stmt->bindValue(1, $img);
            $stmt->bindValue(2, $user);
            $user = $stmt->execute();           
        }     
    }

?>