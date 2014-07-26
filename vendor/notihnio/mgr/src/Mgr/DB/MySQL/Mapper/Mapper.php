<?php

/**
  @author Panagiotis Mastrandrikos <pmastrandrikos@gmail.com>  https://github.com/notihnio

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

 */

namespace Mgr\DB\MySQL\Mapper;

/**
 * @name Mapper 
 * @description Handles ORM mapping logic
 * 
 */
class Mapper {

    /**
     *
     * @var \Mgr\DB\PDO $pdo
     * @description the pdo instance
     * 
     * */
    public $pdo;

    public function __construct(\Mgr\DB\PDO\MgrPDO $pdo, $lock = true) {
        $this->pdo = $pdo;

        if (!$lock) {
            $this->updateStructure();
        }
    }

    /**
     * @name getTableName
     * @description returns table name
     * 
     * @return string the table name
     */
    public function getTableName() {
        return end(explode('\\', get_called_class()));
    }

    /**
     * @name getTableExistingColums
     * @description returns table existing colums
     * 
     * @param string $tableName - the table name
     * @return array existingColums
     */
    private function getTableExistingColums() {
        try {
            $sql = " 
            SELECT
               *
            FROM
               INFORMATION_SCHEMA.COLUMNS
            WHERE 
              TABLE_NAME LIKE :table
              AND table_schema = :databaseName";

            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':table', $this->getTableName(), \Mgr\DB\PDO\MgrPDO::PARAM_STR, 150);
            $statement->bindParam(':databaseName', $this->pdo->getDbName(), \Mgr\DB\PDO\MgrPDO::PARAM_STR, 150);
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;
        } catch (PDOException $Exception) {
            throw new MyDatabaseException($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     * @name getProperties
     * @description returns running orm class properties
     * 
     * @return array properties
     */
    private function getProperties() {
        $properties = get_object_vars($this);
        unset($properties["pdo"]);
        return $properties;
    }

    /**
     * @name createTable
     * @description returns create table sql script
     * 
     * 
     * @return string sqlCode
     */
    private function createTable() {

        //  save constraits primiry keys etc to append at the bottom of th script
        $constraits = "";
        $sql = "CREATE TABLE {$this->getTableName()}( ";
        $properties = $this->getProperties();
        
        // add class properties
        foreach ($properties as $propertyName => $propertyScript) {
            $propArray = $this->convertPropertyToSql($propertyName, $propertyScript);

            //add the propery sql to create table script
            $sql.= $propArray["propertySql"];

            // add posible constraints example primary key etc to buffer to append at the end of the script
            $constraits.=$propArray["constraitsBuffer"];
        }
        $sql.=$constraits;


        $sql.=" ) ENGINE={$properties["__engine"]};";

        //get ORM object properties exept pdo
        $sql=preg_replace("/,\s+\)/", " ) ", $sql);
        echo(var_dump($sql));
    }

    /**
     * @name updateTable
     * @description returns update table sql script
     * 
     * 
     * @return string sqlCode
     */
    private function updateTable() {
        
    }

    private function convertPropertyToSql($name, $script) {
        $returnScript = array();
        $name = str_replace("$", "", $name);

        // if propery starts width __ do nothing
        
        if (preg_match("/^#__.*/", $name)) {
            $returnScript["constraitsBuffer"] = "";
            $returnScript["propertySql"] = "";
            return $returnScript;
        }


        //check from primary keys
        if (preg_match("/^#.*/", $script)) {
            $returnScript["propertySql"] = $name . " " . trim(str_replace("#", "", $script)) . ", ";
            $returnScript["constraitsBuffer"] = "CONSTRAINT pk PRIMARY KEY({$name}), ";
            return $returnScript;
        }

        //check for indexes
        if (preg_match("/^@.((?!>>).)*$/", $script)) {
            $returnScript["propertySql"] = $name . " " . trim(str_replace("@", "", $script)) . ", ";
            $returnScript["constraitsBuffer"] = "INDEX({$name}), ";
            return $returnScript;
        }
        
        
        
        //check for foreign keys
        if (preg_match("/^@.*>>.*$/", $script)) {

            //extract the script part
            $explode = explode(">>", $script);
            $returnScript["propertySql"] = $name . " " . trim(str_replace("@", "", $explode[0])) . ", ";

            //get the foreign key reference class and the reference field
            $foreignKeyClassExplodes = explode("->", $explode[1]);

            $foreignKeyClassName = trim($foreignKeyClassExplodes[0]);
            $foreignKeyClassField = trim($foreignKeyClassExplodes[1]);
            $foreignKeyOnDeleteOnUpdate = trim($explode[2]);


            //get the reference table name
            $referenceClass = new $foreignKeyClassName($this->pdo, false);


            $returnScript["constraitsBuffer"] = "INDEX({$name}) FOREIGN KEY({$name}) REFERENCES {$referenceClass->getTableName()}({$foreignKeyClassField}) {$foreignKeyOnDeleteOnUpdate}, ";
            return $returnScript;
        }
        $returnScript["constraitsBuffer"] = "";
        $returnScript["propertySql"] = "";
        return $returnScript;
    }

    /**
     * @name updateStructure
     * @description update table structure
     * 
     * 
     * @return void
     */
    public function updateStructure() {


        $this->createTable();



        $slq = "      
            -- First check if the table exists
                        IF EXISTS(SELECT table_name 
                                    FROM INFORMATION_SCHEMA.TABLES
                                   WHERE table_schema = '{$this->pdo->getDbName()}'
                                     AND table_name LIKE '{$this->getTableName()}')

                        -- If exists, retreive columns information from that table
                        THEN
                           {$this->updateTable()}
                        ELSE
                           create table

                        END IF;
               ";
    }

    public function select() {
        
    }

    public function selectFull() {
        
    }

    public function update() {
        
    }

    public function insert() {
        
    }

    public function delete() {
        
    }

}
