<?php

namespace Application\Module\Index\Controller;

class IndexController extends \Mgr\Controller\Controller {

    public function IndexAction() {
      
        $this->layout->__Name = "default";
        $this->layout->var = \Application\Module\Index\Model\Foo::bar();
        $this->view->name = "notis";
    }

}
