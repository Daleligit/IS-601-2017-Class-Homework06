<?php
    abstract class collection {
        static public function findAll() {
            global $sqlErr;
            $db = dbConn::getConnection();
            if (!empty($db)) {
                $tableName = get_called_class();
                $sql = 'SELECT * FROM ' . $tableName;
                try {
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    $rows = $statement->rowCount();
                    $class = static::$modelName;
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
                $tableName = get_called_class();
                $sql = 'SELECT * FROM ' . $tableName . ' WHERE id = ' . $id;
                try {
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    $class = static::$modelName;
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