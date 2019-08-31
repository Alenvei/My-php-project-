<?php
   
    class ArticlesDB{
        private $db;
        public function __construct(){
            require 'db.php';
            $this->db = $db;
        }
        //call the all articels from DB;
        public function show(){           
            $stmt =  $this->db->prepare('SELECT * FROM articles');
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            $this->db = null;

            return $res;        
        }
        //find the specific articel in DB ;
        public function find($id_articel){
            $stmt =  $this->db->prepare('SELECT articles.*, users.name, users.img_profile FROM articles INNER JOIN users ON articles.id_user = users.id WHERE articles.id = ?');
            $stmt->execute([$id_articel]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->db = null;

            return $res;
        }
    }
?>