<?php
// Navigation bar of the site 
class NavBar{
    public function __construct($user_id, $uvod, $blogy, $edit, $user, $img){
        echo    
            "
                <div id=nav-contanier>        
                    <div class = navBlog>
                        <nav>
                            <a href ='?uvod'> <div id='".$uvod."'>Úvod</div></a>
                            <a href='?clanky'><div id='".$blogy."'>Blogy</div></a>
                            <input/> 
                            <div id = 'userPanel'>
                            ".$this->CheckForUserON($user_id, $edit, $user, $img)."                                                        
                            </div>                        
                        </nav>
                    </div>
                </div>
            ";
    }
    // Method for if user is logged
    private function CheckForUserON($user_id, $edit , $user, $img){ 
        if($user_id){
            $show = "<a href='?edit'><div id='".$edit."' style ='transform: scale(-1, 1)'>&#9998</div></a><a href='?user&about'><div class='profileImg' id = '".$user."'><img src='".$img."'></div></a>";
        }else{
            $show = "<a href='client/login/'><div id='none' >SingIn</div></a><a href='client/registration/'><div id='none'>SingUp</div></a>";
        }
        return $show;      
    }
}



?>
