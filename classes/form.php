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
        static public function createFindAllForm ($tableName) {
            $form = '<form action="index.php?page=display&table=' . $tableName . '&method=findAll" method="post">';
            $form .= '<input type="submit" value="Display Whole Table" name="submit">';
            $form .= '</form>';
            return $form;
        }
        static public function createFindIdForm ($tableName) {
            $form = '<form action="index.php?page=display&table=' . $tableName . '&method=findOne" method="post">';
            $form .= '<input type="text" name="id">';
            $form .= '<input type="submit" value="Display the line with this ID" name="submit">';
            $form .= '</form>';
            return $form;
        }
        static public function createDeleteForm ($tableName) {
            $form = '<form action="index.php?page=display&table=' .$tableName . '&method=delete" method="post">';
            $form .= '<input type="text" name="id">';
            $form .= '<input type="submit" value="Delete the line with this ID" name="submit">';
            $form .= '</form>';
            return $form;
        }
        static public function createSaveForm ($tableName) {
            $form = '<form action="index.php?page=display&table=' . $tableName . '&method=save" method="post">';
            switch ($tableName) {
                case 'accounts';
                    $res = accounts::findAll();
                    break;
                case 'todos';
                    $res = todos::findAll();
                    break;
            }
            $res = $res[0];
            foreach ($res as $key=>$value) {
                $form .= '<input type="text" name="' . $key . '">';
                $form .= $key . '</br>';
            }
            $form .= '<input type="submit" value="Update/Insert the line with this ID" name="submit">';
            $form .= '</form>';
            return $form;
        }
    }
?>