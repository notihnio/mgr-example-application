<?php

namespace Application\Module\Index\Model\DB\Schema;

class Category extends \Mgr\DB\MySQL\Mapper\Mapper {
    
    public $__engine = "INNODB";

    public $id = "#int NOT NULL AUTO_INCREMENT";
    
    public function __construct(\Mgr\DB\PDO\MgrPDO $pdo, $lock = true) {
        parent::__construct($pdo, $lock);
    }

}
