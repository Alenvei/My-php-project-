<?php 
 require 'articlesDB.php';
 require_once 'profile.php';
 
class Server{
    protected $ARTICLES_DB ;
    protected $profile ;
    protected $ENCRYPTION;
    public function __construct(){
        $this->ARTICLES_DB = new ArticlesDB;   
        $this->profile = new Profile();   
      
    }
    //get page query 
    public function getPage(){
        $page = null;
        if(isset($_GET["uvod"])){
            $page = "uvod";            
        }
        if(isset($_GET["clanky"])){
            $page = "clanky";
        }
        if(isset($_GET["edit"])){
            $page = "edit";
        }
        if(isset($_GET["user"])){
            $page = "user";
        }
        if(isset($_GET["profile"])){
            $page = "profile";
                                  
        }
        if(isset($_GET["post"])){
            $page = "post";            
        }        
        return $page;
    }
    //get user tabs query 
    public function getUserTabs(){
        $tab = null;
        if(isset($_GET["about"])){
            $tab = "about";            
        }

        if(isset($_GET["articels"])){
            $tab = "articels";
        }

        if(isset($_GET["user"]) && isset($_GET["edit"])){
            $tab = "edit";
        }     
        if(isset($_GET["profile"]) && isset($_GET["edit"])){
            $tab = null;
        } 
        return $tab;
    }
    //send specific articel to client 
    public function showPost(){
       $post_id = (int) $_GET['post'];
        if( $post_id){        
          $post =  $this->ARTICLES_DB->find( $post_id);
            return  $post ? $post : false;

        }else{

            return  false;
        }
        
    }
    //chcek articels by categories
    private function checkPosts($cat){
       
        $arr = array();
        
        $countArt = $this->ARTICLES_DB->show();
        
        for($i=0; $i<count($countArt); $i++){   

            if($cat===$countArt[$i]['category']){
                $arr[] = $countArt[$i];
                
                break;
                
            }
            
            if($cat === null){
               $arr[] = $countArt[$i];               
            } 
        }

      
       
        return $arr;
    }
    //send articels by categories to client 
    public function getPost(){        
        $pageValue = htmlspecialchars($_GET['clanky']);
        if($pageValue==""){
            $category = null;
        }elseif($pageValue=="javascript"){
            $category  = '1';
            
        }elseif($pageValue=="php"){            
            $category  = '2';
           
        }elseif($pageValue=="css"){
            $category  = '3';
        }else{
            $category  = null;
        }
        $articlesByCategory  = $this->checkPosts($category);
        
        return $articlesByCategory;
        
    }
    //send profile of autor to client 
    public function getProfile(){
       $profile = htmlspecialchars($_GET['profile']);
       return  $this->profile->profileData($profile);
    }
    // send user's data to client  
    public function getUser($user_id){      
        
        if($user_id){
            return  $this->profile->userData($user_id);
        }

    }
}
?>