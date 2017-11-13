<?php
    class homepage extends page {
        public function get()
        {
            $this->html .= htmlTags::headingOne(htmlTags::changeRow('Please select a table:'));
            $this->html .= form::createTableSelectForm();
        }
        public function post() {
            $tableName = $_POST['Selection'];
            $this->html .= pageFunctions::changePage('index.php?page=display&table=' . $tableName);
        }
    }
?>