<?php
    class stringFunctions {
        static public function printThis($input) {
            print($input);
        }
        static public function rightTrim($inputArray, $chr) {
            return rtrim($inputArray, $chr);
        }
    }
?>