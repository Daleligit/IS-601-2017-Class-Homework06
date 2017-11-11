<?php
    class table {
        static public function createTable($inputArray) {
            if (arrayFunctions::countNumber($inputArray,0) != arrayFunctions::countNumber($inputArray,COUNT_RECURSIVE)){
                $table = htmlTags::tableHead('displayTable');
                foreach ($inputArray as $key => $line) {
                    if ($key == 0) {
                        $table .= htmlTags::tableLineStart();
                        foreach ($line as $columns => $value) {
                            $table .= htmlTags::tableTitle($columns);
                        }
                        $table .= htmlTags::tableLineEnd();
                    }
                    $table .= htmlTags::tableLineStart();
                    foreach ($line as $columns => $value) {
                        $table .= htmlTags::tableDetail($value);
                    }
                    $table .= htmlTags::tableLineEnd();
                }
                $table .= htmlTags::tableEnd();
                return $table;
            } else {
                $table = htmlTags::tableHead('displayTable');
                $table .= htmlTags::tableLineStart();
                foreach ($inputArray as $key => $value) {
                    $table .= htmlTags::tableTitle($key);
                }
                $table .= htmlTags::tableLineEnd();
                $table .= htmlTags::tableLineStart();
                foreach ($inputArray as $key => $value) {
                    $table .= htmlTags::tableDetail($value);
                }
                $table .= htmlTags::tableLineEnd();
                return $table;
            }
        }
    }
?>