<?php

namespace Application\Module\Index\Controller;

class IndexController extends \Mgr\Controller\Controller {

    public function IndexAction() {



        //session example
        $session = new \Mgr\Session\Session("admin");
        $session->set("foo", "bar");
        $session->get("foo");

        $this->view->foo = $session->get("foo");

        $this->layout->__Name = "default";
        $this->layout->var = \Application\Module\Index\Model\Foo::bar();
        $this->view->name = "notis";
    }
    
    
    public function DbAction(){
        $article= new \Application\Module\Index\Model\DB\Schema\Article("Fd");
        
    }

   

}
