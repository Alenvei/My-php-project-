<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css ?timesptam =<?php echo time()?>">
    
    <title>Prihlasanie</title>
</head>
<body>
    <?php
        require './view/Singin.php';
        require '../../api/login.php';
     
        $FORM = new SingIn();
        $FORM->render(new Login);
    ?> 
</body>
</html>