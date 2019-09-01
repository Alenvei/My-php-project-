<?php
    require 'edit_profile.php';
    class UserProfile{
        
        private $SHOWCASE;
        private $tabOpen; 

        public function __construct($showcase, $tab){
            $this->SHOWCASE = $showcase;
            $this->tabOpen = $tab;            
        }
        //chcek witch button is pressed in profile/user render 
        public function profile($user, $profile_update){
            $content = null; 
            $active =''; 
            $url ='Location: http://localhost/Blog/?user&edit';     
            switch ($this->tabOpen) {
                case 'about':
                $content = $this->bioOfUser($user);
                $active ='about';                
                    break;
                case 'articels':
                $content = $this->articlesOfUser($user);
                $active ='articels'; 
                    break;
                case 'edit':
                $edit =  new Edit();
                $content =  $edit->render($profile_update, $url);
                $active ='edit';
                    break;
                default:
                $content = 'upss nic sa nenaslo';
                $active = '';
                    break ;              
            }
                        
            return  [   
                        'content'=>$content,
                        'active'=>$active,
                    ];
        }
        //render the autor's articles 
        private function articlesOfUser($user){
            
            return  "   
                        <div id='comments'><h1>My Articles</h1>            
                            ". $this->SHOWCASE->showArticlesByCat($user['articels'])."            
                        </div>
                    "; 
        }
         //render the user's bio
        private function bioOfUser($user){
            return 
                "
                    <div  id='userContent'>
                    <h1>Smothing about me </h1> 
                       
                        ".$user['user']['bio']."
                    </div>                     

                ";

        }      
        
    }
?>