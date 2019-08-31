<?php
    require_once 'abstrackt_form.php';
    //edit article form 
    class Edit_Article extends Form {


        protected function view($valid){
            return 
                "        
                    <script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=your_API_key'></script>
                    <script>
                        tinymce.init({
                        selector: '#postTextarea'
                        });

                    </script>
                    
                    <form class='postForm'  action = 'index.php' method='post'>   
                        <h3>Nazov</h3>
                        <input name = 'name'>
                        ".$valid['title']."
                        <h3>Obrazok</h3>
                        <input name = 'img' type ='file'>
                        ".$valid['img']."                         
                        <h3>Post</h3>
                        <textarea id='postTextarea' name='ed'></textarea>
                        ".$valid['text']."
                        <h3>Tagy</h3>
                        <input name = 'tags'>
                        <h3>Kategorie</h3>
                        <input name = 'cat' type = 'radio' >Javascript <input name = 'cat' type = 'radio' >Php<input name = 'cat' type = 'radio' >Php  
                       
                          
                        <input id= 'submitInput' type= 'submit' value = 'Create post'>
                    </form>
                
                ";
        }
    }
?>
