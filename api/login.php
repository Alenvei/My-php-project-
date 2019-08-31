<?php
session_start();

class Login{    

    private $db;
    private $VALIDATION;

    public function __construct(){
        require 'model/validation.php';
        require 'db.php';
        $this->db = $db;
        $this->VALIDATION = new Validation();
    }
    //chcek if login form is valid
    public function chcekIfValid(){      

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $validEmail = $this->VALIDATION->email();
            $validPassword = $this->VALIDATION->password();
            
            if($validEmail){

                $isValid = $validEmail['ifValid'];                                     
                $errEmail =  $validEmail['email'];
                $activEmail =  $validEmail['errEmail'];
                $email = $validEmail['userEmail'];
                
            }else{

                echo 'Email validation issue!';

            }

            if($validPassword){

                $isValid = $validPassword['ifValid'];
                $errPass = $validPassword['password'];
                $activPass = $validPassword['errPass'];
                

            }else{

                echo 'Password validation issue!';

            }
            //if valid then log on the user 
            if($isValid){

               $result = $this->chceckLoginUser($email); 
             
                if($result){

                    if(password_verify($_POST['password'], $result['password'])){

                        $_SESSION['login'] = $result['id'];

                    }else{

                        $errPass = '<span>Password is not correct!</span>';
                        $isValid = false;
                        $activPass = "style='border-color:red'";
                    }
                  
                }else{

                   $errEmail = '<span>Email is not correct!</span>';
                   $isValid = false;
                   $activEmail = "style='border-color:red'";

                }

            }

            return  [
                        'ifValid' => $isValid,                    
                        'email' => $errEmail,
                        'password' => $errPass,
                        'errEmail' => $activEmail,
                        'errPass' => $activPass,                
                    ];


        }            
    }
   // chcek user Email if exisists in DB 
    private function chceckLoginUser($email){

        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $result = $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->db = null;
        
        return $result ? $user : false;
    }   

}



?>