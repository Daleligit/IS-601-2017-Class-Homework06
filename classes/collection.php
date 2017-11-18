<?php
    abstract class collection {
        static public function findAll() {
            global $sqlErr;
            $db = dbConn::getConnection();
            if (!empty($db)) {
                $class = static::$modelName;
                $sql = 'SELECT * FROM ' . $class;
                try {
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_CLASS, $class);
                    $recordsSet = $statement->fetchAll();
                    $recordsSet = arrayFunctions::objToArray($recordsSet);
                    return $recordsSet;
                } catch (PDOException $e){
                    $sqlErr .= htmlTags::changeRow('SQL query error: ' . $e->getMessage());
                }
            }
        }
        static public function findOne ($id) {
            global $sqlErr;
            $db = dbConn::getConnection();
            if (!empty($db)) {
                $class = static::$modelName;
                $sql = 'SELECT * FROM ' . $class . ' WHERE id = ' . $id;
                try {
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_CLASS, $class);
                    $recordsSet = $statement->fetchAll();
                    $recordsSet = arrayFunctions::objToArray($recordsSet);
                    return $recordsSet;
                } catch (PDOException $e){
                    $sqlErr .= htmlTags::changeRow('SQL query error: ' . $e->getMessage());
                }
            }
        }
    }
?>