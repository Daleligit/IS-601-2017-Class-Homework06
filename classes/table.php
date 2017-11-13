<?php
    class table {
        static public function createTable($inputArray) {
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
        }
    }
?>