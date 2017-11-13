<?php
    abstract class model
    {
        protected $tableName;
        public function save()
        {
            global $sqlErr;
            $db = dbConn::getConnection();
            if (!empty($db)) {
                $array = get_object_vars($this);
                $array = arrayFunctions::arrayPop($array);
                $columArray = array_keys($array);
                $columString = implode(',', $columArray);
                $valueString = implode(',', $array);
                switch ($this->tableName) {
                    case 'accounts';
                        $getId = accounts::findOne($this->id);
                        break;
                    case 'todos';
                        $getId = todos::findOne($this->id);
                        break;
                }
                if (empty($getId[0])) {
                    $sql = $this->insert($this->tableName, $columString, $valueString);
                    $result = htmlTags::changeRow('I just inserted a new record with id = ' . $this->id);
                } else {
                    $sql = $this->update($this->tableName, $columArray, $array);
                    $result = htmlTags::changeRow('I just updated a record with id = ' . $this->id);
                }
                try {
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    return $result;
                } catch (PDOException $e) {
                    $sqlErr .= htmlTags::changeRow('SQL query error: ' . $e->getMessage());
                }
            }
        }
        private function insert($tableName, $columString, $valueString) {
            $sql = 'INSERT INTO ' . $tableName . ' (' . $columString . ') VALUES (' . $valueString . ')';
            return $sql;
        }
        private function update($tableName, $columArray, $array) {
            $sql = 'UPDATE ' . $tableName . ' SET ';
            $temp = 0;
            foreach ($columArray as $key=>$colum) {
                if ($colum != 'id') {
                    if ($temp != 0) {
                        $sql .= ', ';
                    }
                    if (!empty($array[$colum])) {
                        $sql .= $columArray[$key] . ' = ' . $array[$colum];
                    } else {
                        $sql .= $columArray[$key] . ' = NULL';
                    }
                    $temp++;
                }
            }
            $sql .= ' WHERE id = ' . $this->id;
            print ($sql);
            return $sql;
        }
        public function delete($id) {
            global $sqlErr;
            $db = dbConn::getConnection();
            if (!empty($db)) {
                $sql = 'DELETE FROM ' . $this->tableName . ' WHERE id = ' . $id;
                try {
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    $result = htmlTags::changeRow('I just deleted record with id = ' . $id);
                    return $result;
                } catch (PDOException $e){
                    $sqlErr .= htmlTags::changeRow('SQL query error: ' . $e->getMessage());
                }
            }
        }
    }
?>