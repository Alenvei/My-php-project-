<?php
//abstract for Forms 
abstract class Form {

    public function render($class, $url ='Location: http://localhost/Blog/?uvod' ){ 

        $valid = $class->chcekIfValid();
        switch ($valid['ifValid']){
            case 'valid':
            header($url);
            exit;
                break;            
            default:
            return $this->view($valid);
                break;
        }        
    }

    abstract protected function view($valid);
}
?>