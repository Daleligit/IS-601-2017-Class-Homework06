<?php
    class form {
        static public function createTableSelectForm () {
            $form = '<form action="index.php?page=homepage" method="post">';
            $form .= '<select name="Selection"> ';
            $form .= '<option>accounts';
            $form .= '<option>todos';
            $form .= '</select>';
            $form .= '<input type="submit" value="Select">';
            $form .= '</form>';
            return $form;
        }
        static public function createFindIdForm () {
            $form = '<form action="index.php?page=display" method="get">';
            $form .= '<input type="text" name="id"> ';
            $form .= '<input type="submit" value="id" name="submit">';
            $form .= '</form>';
            return $form;
        }
    }
?>