<?php

namespace Application\Module\Index\Model\DB\Schema;

class Article extends \Mgr\DB\MySQL\Mapper\Mapper {
    
    public function __construct(\Mgr\DB\PDO\MgrPDO $pdo, $lock=true) {
        parent::__construct($pdo, $lock);
    }

    public $id = "#int NOT NULL AUTO_INCREMENT";
    
    public $title = "varchar(20) DEFAULT NULL ";
    
    public $content = "text";
    
    public $date = "@date";
    
    public $category = "@int > \Application\Db\Mapper\Category->id ";

}
