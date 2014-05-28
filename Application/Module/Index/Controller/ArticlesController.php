<?php

namespace Application\Module\Index\Controller;

class ArticlesController extends \Mgr\Controller\Controller {
   
    public function IndexAction(){ 
        $this->layout->__Name="default";
        $this->layout->var= 'a layout var';
        $this->view->name = "notis";
        
    }
    
     public function EditAction(){ 
        $this->layout->__Name="default";
        $this->layout->var= 'a layout var ';
        $this->view->name = "EditAction";
        
    }
    
     
}
