<?php
    class homepage extends page {
        public function get()
        {
            $res1 = accounts::findAll();
            $res2 = todos::findOne(3);
            $this->html .= table::createTable($res1);
            $this->html .= table::createTable($res2);
        }
    }
?>