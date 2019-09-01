<?php
class Validation {

    private $border;
    protected $isValid;
   

    public function __construct(){
        $this->border = "style='border-color:red'";
        $this->isValid = 'valid';       
    }
    //check if email is valid
    public function email (){

        $email ='';
        
        if(empty($_POST["email"])){

            $activEmail =  $this->border;
            $errEmail = '<span>Email is required!</span>';
            $this->isValid = false;

        }else{

            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

                $activEmail = '';
                $errEmail = '';
                $email = $_POST["email"];

            }else{
                
                $activEmail =  $this->border;
                $errEmail = '<span>Invalid Email form!</span>';
                $this->isValid = false;
            }                    

        }   

        return [
           
            'ifValid'=> $this->isValid,
            'userEmail' => $email,
            'email'=> $errEmail,
            'errEmail' => $activEmail,
            
        ];
    }
    //check  if nickname is valid
    public function nickname(){

        $nickname = '';

        if(empty($_POST["nickname"])){
            $activNick =   $this->border;
            $errNick = '<span>Nickname is required!</span>';
            $this->isValid = false;
        }else{
            $activNick = '';
            $errNick='';
            $nickname = htmlentities($_POST["nickname"]);

        }

        return [
            
            'ifValid'=> $this->isValid,
            'userNick' => $nickname,
            'nick' => $errNick,            
            'errNick' => $activNick,  
        ];
    }
    //check  if password is valid
    public function password(){

        $password ='';

        if(empty($_POST["password"])){

            $activPass =  $this->border;
            $errPass = '<span>Password is required!</span>';
            $this->isValid = false;

        }else{
            $passDirty= $_POST["password"];
            $password = $this->hash($passDirty);                    
            $activPass = "";
            $errPass ='';

        }

        return [

            'ifValid'=> $this->isValid,
            'userPass'=> $password,
            'password'=> $errPass,
            'errPass' => $activPass,   
        ];
    }
    //check  if textarea is valid
    public function textarea(){
        if(!empty($_POST["textarea"])){
            $textarea = $_POST["textarea"];
        }
    }
    //check  if title is valid
    public function titleName(){

        $nickname = '';

        if(empty($_POST["titleName"])){
            $activTitle =   $this->border;
            $errTitle = '<span>Title is required!</span>';
            $this->isValid = false;
        }else{
            $activTitle = '';
            $errTitle='';
            $title = htmlentities($_POST["titleName"]);

        }

        return [
            
            'ifValid'=> $this->isValid,
            'postTitle' => $title,
            'title' => $errTitle,            
            'errTitle' => $activTitle,  
        ];
    }
    
    //make hash password;
    private function hash($password){

        $options=[
            'cost'=>12,
        ];

         return password_hash($password, PASSWORD_DEFAULT,$options);           
     }
}

?>