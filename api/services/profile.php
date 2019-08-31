<?php

class Profile{
    private $db;
    public function __construct(){
        require '../db.php';
        $this->db = $db;       
    }
    //call the signed in user's data 
    public function userData($id, $articles = 'with_articels'){
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($articles === 'with_articels'){
            $articles_of_user = $this->userArticles( $user['id']);
        }else{
            $articles_of_user = '';
        }       
        
        return [
                'user'=> $user,
                'articels' => $articles_of_user,
               ];
    }
    //call the other user's data 
    public function profileData($name){
        $stmt = $this->db->prepare('SELECT *  FROM users WHERE name = ?');
        $stmt->execute([$name]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $articles_of_user = $this->userArticels( $user['id']);       

        return  [
                'user'=> $user,
                'articels' => $articles_of_user,
                ];
    }
    // call the user's articels 
    private function userArticles($id){
        $stmt = $this->db->prepare('SELECT * FROM articles WHERE id_user = ?');
        $stmt->execute([$id]);
        $articles = $stmt->fetchALL(PDO::FETCH_ASSOC);      

        return $articles;
    }
}
?>