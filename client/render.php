<?php 
require "components/nav_bar.php";
require "components/article.php";
require "components/category_holder.php";
require "components/edit_article.php";
require "components/user_profile.php";
require "components/user_data.php";
require "components/articles_showcase.php";


class Blog{
    private $server;
    private $profile_update;
    private $article_upload; 
    public function __construct(Server $server, Profile_update $profile_update, Article_Upload $article_upload){
        $this->server = $server;
        $this->profile_update = $profile_update;
        $this->article_upload = $article_upload;
    }   
    //page renderer 
    public function render($user_id){  
        $uvod = 'none';
        $articles = 'none';  
        $edit = 'none';  
        $user = 'none' ;
        $userTab = $this->server->getUserTabs();
        $ARTICLE = new Article();
        $EDIT = new Edit_Article();
        $SHOWCASE = new ArticlesShowcase();
        $USER = new UserProfile($SHOWCASE, $userTab);
        
        $user_data = $this->server->getUser($user_id);
        $USER_data_holder = new UserData();
       
       // switching content | articels, profile, showcase of articels,  atc...
        switch ($this->server->getPage()){
            case 'uvod':
            $insert =  '';            
            $uvod = 'active';            
                break;

            case 'clanky': 
            new CategoryHolder();          
            $insert = $SHOWCASE->showArticlesByCat($this->server->getPost());           
            $articles = 'active';           
                break;

            case 'edit':
            $insert = $EDIT->render($this->article_upload );                 
            $edit = 'active';      
                break;

            case 'user':
            if($user_id){                 
                $userProfile = $USER->profile($user_data, $this->profile_update);
                $USER_data_holder->render($user_data, $userProfile['active']);               
                $user ='active'; 
                $insert = $userProfile['content'];  
            }else{
                $insert= null;
            }
                break;

            case 'profile':
            $profile_data = $this->server->getProfile(); 
            $userProfile = $USER->profile($profile_data,$this->profile_update);           
            $USER_data_holder->render($profile_data, $userProfile['active']);
            $insert = $userProfile['content'];            
                break;

            case 'post':
            new CategoryHolder();
            $insert = $ARTICLE->render($this->server->showPost());
                break;

            default:
            $articles = 'none';
            $edit = 'none';
            $uvod = 'none';
            $user = 'none';
            $insert = null;
                break;
        }


        $nav = new NavBar($user_id, $uvod, $articles, $edit, $user, $user_data['user']['img_profile']);
        $this->contentBlock($insert);  
         
    } 
    // hold content like articels, showcase of articels, user profile atc...
    private function contentBlock($insert = null){
        echo "<div class = 'contentBlock'>".$insert."</div>";
    }   
}
?>