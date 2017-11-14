<?php
    class display extends page {
        public function get() {
            $tableName = $_GET['table'];
            $this->html .= form::createFindAllForm($tableName);
            $this->html .= htmlTags::horizontalRule();
            $this->html .= form::createFindIdForm($tableName);
            $this->html .= htmlTags::horizontalRule();
            $this->html .= form::createDeleteForm($tableName);
            $this->html .= htmlTags::horizontalRule();
            $this->html .= form::createSaveForm($tableName);
            $this->html .= htmlTags::horizontalRule();
            $this->html .= htmlTags::turnPage('index.php', 'Back');
        }
        public function post() {
            $tableName = $_GET['table'];
            $method = $_GET['method'];
            $id = pageFunctions::getID($method);
            $this->html .= pageFunctions::runMethod($method,$tableName,$id);
            $this->html .= htmlTags::changeRow(pageFunctions::outputErrorMassage());
            $this->html .= htmlTags::turnPage('index.php?page=display&table=' . $tableName,'Back');
        }
    }
?>