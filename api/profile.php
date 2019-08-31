<?php

class Profile{
    private $db;
    public function __construct(){
        require 'db.php';
        $this->db = $db;       
    }
    //call the signed in user's data 
    public function userData($id, $articels = 'with_articels'){
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($articels === 'with_articels'){
            $articels_of_user = $this->userArticels( $user['id']);
        }else{
            $articels_of_user = '';
        }       
        
        return [
                'user'=> $user,
                'articels' => $articels_of_user,
               ];
    }
    //call the other user's data 
    public function profileData($name){
        $stmt = $this->db->prepare('SELECT *  FROM users WHERE name = ?');
        $stmt->execute([$name]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $articels_of_user = $this->userArticels( $user['id']);       

        return  [
                'user'=> $user,
                'articels' => $articels_of_user,
                ];
    }
    // call the user's articels 
    private function userArticels($id){
        $stmt = $this->db->prepare('SELECT * FROM articles WHERE id_user = ?');
        $stmt->execute([$id]);
        $articels = $stmt->fetchALL(PDO::FETCH_ASSOC);      

        return $articels;
    }
}
?>