<?php
 class Uploder{
     
     public function imgUploder($user_img = null){
        $uploadOk = 1;
        $target_dir = './img/';
        $name =  pathinfo($_FILES['img']['name'], PATHINFO_FILENAME);        
        $imageFileType = strtolower(pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION));
        $increment = '';
        
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES['img']["tmp_name"]);
            if($check !== false) {
                $err = "<span id='correct'>File is an image - " . $check["mime"] . ".</span>";
                $uploadOk = 1;
            } else {
                $err = "<span>File is not an image.</span>";
                $uploadOk = 0;                
            }
        }
        // Check if file already exists and rename it ;
        while(file_exists( $target_dir . $name . $increment . '.' . $imageFileType)){
            $increment++;
        }

        $target_file = $target_dir . $name . $increment . '.' . $imageFileType;

        // Check file size
        if ($_FILES['img']["size"] > 50000000) {
            $err = "<span>Sorry, your file is too large.</span>";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $err = "<span>Sorry, only JPG, JPEG & PNG files are allowed.</span>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk === 0) {
            $err = "<span>Sorry, your file was not uploaded.</span>";
        // if everything is ok, it will upload img
        } else {
            if (move_uploaded_file($_FILES['img']["tmp_name"], $target_file)) {
                if($user_img !=='./img/user.png'){
                    unlink($user_img);
                }
                $err = "<span id='correct'>The file ". basename($_FILES['img']["name"]). " has been uploaded.</span>";
            } else {
                $err = "<span>Sorry, there was an error uploading your file.</span>";
            }
        }
        return  [   
                    'errImg'=> $err, 
                    'img'=> $target_file,
                    'ok' => $uploadOk,
                ];
     }
     
 }

?>