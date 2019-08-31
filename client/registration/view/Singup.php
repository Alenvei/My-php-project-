<?php 
//registration form

require '../components/abstrackt_form.php';
class Singup extends Form { 

    protected function view($valid){
        
        echo
            "           
             <div class = 'regForm'>
              
                    <form action = 'index.php' method='post' >                      

                        <input type='text' ".$valid['errNick']." name='nickname'placeholder='Nickname'/>
                        </br>
                            ".$valid['nick']."
                        </br>
                      
                        <input type='text'  ".$valid['errEmail']." name='email' placeholder='myemail@emial.com'/>
                        </br>
                            ".$valid['email']."
                        </br>
                      
                        <input type='password' ".$valid['errPass']." name='password' placeholder='password'/>
                        </br>
                            ".$valid['password']."
                        </br>
                        <input type='submit' value= 'Sing up'/>
                        
                    </form>
                </div>               
            ";

    }

}
?>