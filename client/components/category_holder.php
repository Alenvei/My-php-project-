<?php
//category holder 
 class CategoryHolder{
    public function __construct(){
        echo    
            "
                <div class = 'tagsHolder'>
                    <h2>Categorie</h2>
                    <a href='?clanky'><div>All</div></a>
                    <a href='?clanky=php'><div>Php</div></a>
                    <a href='?clanky=javascript'><div>JavaScript</div></a>
                    <a href='?clanky=css'><div>css3</div></a>                           
                </div>
            
            ";
    }
}
?>