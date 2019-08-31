
<?php
//Edit profile form
 require_once 'abstrackt_form.php';
class Edit extends Form{
     
    protected function view($valid){
        
       return   "
                    <script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=your_API_key'></script>
                                    <script>
                                        tinymce.init({
                                        selector: '#postTextarea'
                                        });

                                    </script>  
                    
                    <div class = 'editBlock'>
                        
                    <form action = '?user&edit' method='post' enctype='multipart/form-data'> 
                        <h2>Profile image</h2>                                     
                        <input type='file'name='img' />
                        </br>  
                       ".$valid['upload']."
                        </br>                   
                            
                        </br>
                        <h2>Tell something about you here:</h2>   
                        <textarea id='postTextarea' name='textarea'></textarea>
                        </br>
                            
                        </br>           
                        <h2>Password</h2>   
                        <input type='password' ".$valid['errOldPass']." name = 'oldpassword' placeholder='Old password' />
                        </br>
                            ".$valid['oldPassword']."
                        </br>            
                        <input type='password' ".$valid['errPass']." name = 'password' placeholder='New password' />
                        </br>
                            ".$valid['password']."    
                        </br>
                                
                        <input type='submit' value= 'Save'/>
                        
                        
                        
                    </form>
                    </div>
                ";
    }
}


?>