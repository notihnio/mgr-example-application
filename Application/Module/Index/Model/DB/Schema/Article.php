<?php

namespace Application\Module\Index\Model\DB\Schema;

class Article extends \Mgr\DB\MySQL\Mapper\Mapper {
    
    public function __construct(\Mgr\DB\PDO\MgrPDO $pdo, $lock, $recursive, $allowDeleteColums) {
        parent::__construct($pdo, $lock, $recursive, $allowDeleteColums);
    }

    public $id = "#int NOT NULL AUTO_INCREMENT";
    
    public $title = "varchar(20) DEFAULT NULL ";
    
    public $content = "text";
    
    public $date = "@date";
    
    public $category = "@int(11) >> \Application\Module\Index\Model\DB\Schema\Category->id >> ON UPDATE CASCADE ON DELETE RESTRICT";
       
    public $__engine = "INNODB";

}
