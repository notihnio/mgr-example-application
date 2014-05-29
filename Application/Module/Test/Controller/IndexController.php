<?php

namespace Application\Module\Test\Controller;

class IndexController extends \Mgr\Controller\Controller {
   
    public function IndexAction(){
         var_dump($this->selectedRoute);
        $this->layout->__Name="default";
        $this->layout->var= 'a layout var';
        $this->view->name = "notis";
    }
    
     public function TestAction(){
          var_dump($this->selectedRoute);
        $this->layout->__Name="default";
        $this->layout->var= 'a layout var';
        $this->view->name = "notis";
    }
    
    public function CacheAction() { 
        unset($this->layout->__Name);
        $cache = new \Mgr\Cache\Cache("XCache", 10);
       
        if ($cache->exists("date")) {
            die("date=" . $cache->get("date"));
        } else {
            $cache->set("date", date('l jS \of F Y h:i:s A'));
            die("uncached date=" . $cache->get("date"));
        }
    }
}
