<?php
session_start();

if(isset($_SESSION['login'])){
    $user_id = $_SESSION['login'];
}else{
    $user_id = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css ?timesptam =<?php echo time()?>">
    
    <title>Alenvei</title>
</head>
<body>
    <?php
        
        require "./client/render.php";
        require "./api/server.php";
        require "./api/services/profile_update.php";
        require "./api/services/article_upload.php";           
        $BLOG = new Blog(new Server(), new Profile_update($user_id), new Article_Upload($user_id));
        $BLOG->render($user_id); 
               
       
    ?>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>