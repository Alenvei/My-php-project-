<?php
    session_start();
    
    class Registration{
        private $db;
        private $VALIDATION;

        public function __construct(){
            require '../model/validation.php';            
            require '../db.php';
            $this->db = $db;
            $this->VALIDATION = new Validation();
            
        }
        //check if registration form is valid
        public function checkIfValid(){           
            
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $validNick = $this->VALIDATION->nickname();
                $validEmail = $this->VALIDATION->email();
                $validPassword = $this->VALIDATION->password();
                

                if($validNick){

                    $isValid = $validNick['ifValid'];
                    $errNick = $validNick['nick'];
                    $activNick = $validNick['errNick'];
                    $nickname = $validNick['userNick'];

                }else{

                    echo 'Nickname validation issue!';

                }

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
                    $password = $validPassword['userPass'];

                }else{

                    echo 'Password validation issue!';

                } 

                $exists = false;
                //if form is valid then user will be registered
                if($isValid){
                                         
                    if($this->checkIfNickExists($nickname)){
                        $errNick = '<span>Nickname is already in use</span>';
                        $activNick =  "style='border-color:red'";
                        $exists = true;

                    }
                    if($this->checkIfEmailExists($email)){
                        $errEmail = '<span>Email is already in use</span>';
                        $activEmail = "style='border-color:red'";
                        $exists =  true;
                    }
                    
                    if($exists){ 

                        $isValid =false;                      
                      
                    }else{
                        
                        $result = $this->safeRegistration($nickname,$email,$password);
                        
                        if(is_numeric($result)){
                        
                            $_SESSION['login'] = $result;

                        }                    
                        
                    }               
                    
                }
                

                return  [
                            'ifValid'=> $isValid,
                            'nick' => $errNick,
                            'email'=> $errEmail,
                            'password'=> $errPass,
                            'errEmail' => $activEmail,
                            'errPass' => $activPass,
                            'errNick' => $activNick,
                            
                        ];
            }
        }
        // chcek user Nickname if exisists in DB 
        private function checkIfNickExists($nick){
            $stmt = $this->db->prepare('SELECT name FROM users WHERE name = ?'); 
            $stmt->execute([$nick]) ;
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->db = null;

            return $result;
        }
        // chcek user Email if exisists in DB 
        private function checkIfEmailExists($email){
            $stmt = $this->db->prepare('SELECT name FROM users WHERE email = ?'); 
            $stmt->execute([$email]) ;
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 

            $this->db = null;
            
            return $result;
        }
        //sends to the database user data 
        private function safeRegistration($nick,$email,$password){                        
            $stmt = $this->db->prepare('INSERT INTO users(name, email, password) VALUES(?,?,?)');            
            $result = $stmt->execute([$nick,$email,$password,]); 
            
            $this->db = null;

            return $result ? $this->db->lastInsertId() : false;

        }    
    }

?>