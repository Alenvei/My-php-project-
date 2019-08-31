<?php
//render the showcase of articles 
class ArticlesShowcase{
  //show articles by category 
    public function showArticlesByCat($arr){
       $blocks='';
      $count = count($arr);
        for($i = 0; $i < $count ;$i++){
         $blocks .= 
                  " 
                    <div id='blog'>
                            <div class='imgHolder'><img src='".$arr[$i]['img']."'></div>
                            <div class ='textHolder'>
                                <h4> ".$arr[$i]['title']."</h4>
                                ".substr ($arr[$i]['article'], 0, 200).". </br>
                                <a href='?post=".$arr[$i]['id']."'>Čítať viac.. </a>
                            </div>
                    </div>
                   
                  ";
         
        }
       return $blocks;
    }
}

?>