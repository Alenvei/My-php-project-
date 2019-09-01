<?php 
require "components/nav_bar.php";
require "components/article.php";
require "components/category_holder.php";
require "components/edit_article.php";
require "components/user_profile.php";
require "components/user_panel.php";
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

        $user_data = $this->server->getUser($user_id);
        $userTab = $this->server->getUserTabs();
        $ARTICLE = new Article();
        $EDIT = new EditArticle();
        $SHOWCASE = new ArticlesShowcase();
        $USER = new UserProfile($SHOWCASE, $userTab);       
        $USER_panel = new UserPanel();
       
       // switching content | articles, profile, showcase of articels,  atc...
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
                $userp_rofile = $USER->profile($user_data, $this->profile_update);
                $USER_panel->render($user_data, $user_profile['active']);               
                $user ='active'; 
                $insert = $user_profile['content'];  
            }else{
                $insert= null;
            }
                break;

            case 'profile':
            $profile_data = $this->server->getProfile(); 
            $user_profile = $USER->profile($profile_data,$this->profile_update);           
            $USER_panel->render($profile_data, $user_profile['active']);
            $insert = $user_profile['content'];            
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
    // hold content like articles, showcase of articles, user profile atc...
    private function contentBlock($insert = null){
        echo "<div class = 'contentBlock'>".$insert."</div>";
    }   
}
?>