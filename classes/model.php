<?php
    abstract class model
    {
        protected $tableName;
        static public function create () {
            $model = new static::$modelName;
            return $model;
        }
        public function save()
        {
            global $sqlErr;
            $db = dbConn::getConnection();
            if (!empty($db)) {
                $array = get_object_vars($this);
                $array = arrayFunctions::arrayPop($array);
                foreach ($array as $key=>$value){
                    if (empty($value)) {
                        $array[$key] = 'null';
                    }
                }
                $columArray = arrayFunctions::arrayKeys($array);
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
                    $sql = $this->insert($columString, $valueString);
                    $result = htmlTags::changeRow('I just inserted a new record with id = ' . $this->id);
                } else {
                    $sql = $this->update($array);
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
        private function insert($columString, $valueString) {
            $sql = 'INSERT INTO ' . $this->tableName . ' (' . $columString . ') VALUES (' . $valueString . ')';
            return $sql;
        }
        private function update($array) {
            $sql = 'UPDATE ' . $this->tableName . ' SET ';
            foreach ($array as $key=>$colum) {
                if ($key == 'id') {
                    $sql .= $key . '=' . $colum;
                } else {
                    $sql .= ',' . $key . '=' . $colum;
                }
            }
            $sql .= ' WHERE id = ' . $this->id;
            return $sql;
        }
        public function delete() {
            global $sqlErr;
            $db = dbConn::getConnection();
            if (!empty($db)) {
                $sql = 'DELETE FROM ' . $this->tableName . ' WHERE id = ' . $this->id;
                try {
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    $result = htmlTags::changeRow('I just deleted records with id = ' . $this->id);
                    return $result;
                } catch (PDOException $e){
                    $sqlErr .= htmlTags::changeRow('SQL query error: ' . $e->getMessage());
                }
            }
        }
    }
?>