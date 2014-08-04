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

    public function DbAction() { 

        try {
            $db = new \Mgr\DB\PDO\MgrPDO('mysql:host=127.0.0.1;dbname=mapper', "root", "toor", array(\Mgr\DB\PDO\MgrPDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
            $db->setAttribute(\Mgr\DB\PDO\MgrPDO::ATTR_ERRMODE, \Mgr\DB\PDO\MgrPDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
        $article = new \Application\Module\Index\Model\DB\Schema\Article($db, $lock=false, $recursive=true, $allowDeleteColums=true);
        
        $article->select(array("id","title"));
    }

}
