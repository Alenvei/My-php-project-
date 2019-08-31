<?php
    class UserData{
        // render the user data 
        public function render ($user, $active){           

            echo 
            "
                <div class = 'dataHolder'>       
                    <div class = 'imgProfile'><img src='".$user['user']['img_profile']."'></div>
                    <div id='userName'>".$user['user']['name']."</div> 
                    </br> 
                    ".$this->profileButtons($active)."
                </div>
            ";
        }
        //chcek witch button is active 
        private function profileButtons($active){
            $about = 'none';
            $edit = 'none';
            $articels ='none';

            switch ($active) {
                case 'about':
                $about = 'active';
                $edit = 'none';
                $articels = 'none';
                    break;
                case 'articels':
                $articels = 'active';
                $about = 'none';
                $edit = 'none';
                    break;
                case 'edit':
                $edit = 'active';
                $articels ='none' ;
                $about = 'none';                
                    break;
                
                default:
                $about = 'none';
                $edit = 'none';
                $articels ='none';
                    break;
            }


            // if user is logged render this buttons : 
            if(array_key_exists ('user', $_GET)){
                    return  "                  
                                <a href='?user&about'><div id ='profileButton".$about."'>About me</div></a>
                                <a href='?user&articels'><div id ='profileButton".$articels."'>Articels</div></a>
                                <a href='?user&edit'><div id ='profileButton".$edit."'>Edit</div></a> 
                              
                            ";
            }
            // if user chceking profile of autor render this buttons: 
            if(array_key_exists ('profile', $_GET)){
                return  "                 
                    
                            <a href='?profile=".$_GET['profile']."&about'><div id ='profileButton".$about."'>About me</div></a>
                            <a href='?profile=".$_GET['profile']."&articels'><div id ='profileButton".$articels."'>Articels</div></a>
                        
                           
                        ";
            }
        }
    
    }
?>