<?php
// Render a certain article
class Article{
    public function render($articel){
        if($articel){

            return  "    
                        <article id ='realContent'>
                       
                            <img src='".$articel['img']."'> 
                            <h1> ".$articel['title']."</h1>            
                            <div id='autor'>
                                <p id='info'>Od: </p>
                                <a href ='?profile=".$articel['name']."&about'>
                                    <img src='".$articel['img_profile']."'>
                                    ".$articel['name']."
                                </a>
                                <p id='info'>Dátum: ".$articel['date']."</p>
                            </div>           
                            ".$articel['article']."           
                       
                        </article>

                        <div id='comments'><h1>Comments</h1> </div>             

                    ";
       }else {

           return "Not find any post";

       }
    }
}


?>