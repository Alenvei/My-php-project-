<?php 
    class Article_Upload{

        private $UPLODER;
        private $db;
        private $VALIDATION;

        public function __construct($user_id){
            require 'db.php';
            require_once 'model/validation.php';
            require_once 'model/uploder.php';           
            
           
            $this->db = $db;
            $this->VALIDATION = new Validation();
            $this->profile = new Profile();
            $this->user_id = $user_id; 
            $this->UPLODER = new Uploder();
               
        }
        // chcel if articel from is valid 
        public function chcekIfValid(){
            $date = date('dmY');
            
            if ($_SERVER["REQUEST_METHOD"] === "POST"){ 

                $validTitle = $this->VALIDATION->titleName();
                $validImg = $this->UPLODER->imgUploder();

                if($validTitle){

                    $title =  $validTitle['postTitle'];
                    $errTitle = $validTitle['errTitle']; 
                    $isValid = $validTitle['ifValid'];
                   

                }else{

                    echo 'Title validation issue';

                }

                if($validImg['ok']){

                    $errImg = $validImg['errImg'];
                    $img = $validImg['img'];

                }else{

                    $isValid = false;

                }

                if(empty($_POST['textarea'])){

                    $textarea = '';
                    $isValid = false;
                    $errText = '<span>Text is required</span>';

                }else{

                    $textarea = $_POST['textarea']; 
                    $errText = '';          

                } 
                if($isValid){
                    $this->uploadPost($title, $img, $date, $textarea, $this->user_id);
                }
                
                return  [

                        'ifValid' => $isValid,
                        'title' => $errTitle,                        
                        'img' => $errImg,
                        'text' => $errText,

                ];
            }


        }
        //send articels's data to DB 
        private function uploadPost($title,$img,$date,$text,$id_user){

            $stmt = $this->db->prepare('INSERT INTO users(title, img, article id_user) VALUES(?,?,?)');            
            $result = $stmt->execute([$title,$img,$date,$text]); 
            
            $this->db = null;

        }
        
    }
?>