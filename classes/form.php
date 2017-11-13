<?php
    class form {
        static public function createSelectForm () {
            $form = '<form action="index.php?page=homepage" method="post">';
            $form .= '<select name="Selection"> ';
            $form .= '<option>accounts';
            $form .= '<option>todos';
            $form .= '</select>';
            $form .= '<input type="submit" value="Select">';
            return $form;
        }
    }
?>