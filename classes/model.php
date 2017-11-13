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
                $columArray = array_keys($array);
                $columnString = implode(',', $columArray);
                $valueString = implode(',', $array);
                if (empty($this->tableName::findOne($this->id))) {
                    $sql = $this->insert($this->tableName, $columnString, $valueString);
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
            $sql = 'UPDATE ' . $tableName . 'SET ';
            $temp = 0;
            foreach ($columArray as $key=>$colum) {
                if ($colum != 'id') {
                    if ($temp != 0) {
                        $sql .= ', ';
                    }
                    $sql .= $columArray[$key] . ' = ' . $array[$key];
                    $temp++;
                }
            }
            $sql .= ' WHERE id = ' . $this->id;
            return $sql;
        }
        public function delete($id) {
            global $sqlErr;
            $db = dbConn::getConnection();
            if (!empty($db)) {
                $tableName = get_called_class();
                $sql = 'DELETE * FROM ' . $tableName . ' WHERE id = ' . $id;
                try {
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    $result = htmlTags::changeRow('I just deleted record with id = ' . $this->id);
                    return $result;
                } catch (PDOException $e){
                    $sqlErr .= htmlTags::changeRow('SQL query error: ' . $e->getMessage());
                }
            }
        }
    }
?>