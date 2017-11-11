<?php
    class homepage extends page {
        public function get()
        {
            $res = accounts::findAll();
            $this->html .= table::createWholeTable($res);
        }
    }
?>