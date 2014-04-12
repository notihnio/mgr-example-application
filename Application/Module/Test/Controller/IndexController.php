<?php

namespace Application\Module\Test\Controller;

class IndexController extends \Mgr\Controller\Controller {
   
    public function IndexAction(){
        $this->layout->__Name="default";
        $this->layout->var= 'a layout var';
        $this->view->name = "notis";
    }
    
     public function TestAction(){
        $this->layout->__Name="default";
        $this->layout->var= 'a layout var';
        $this->view->name = "notis";
    }
    
}
