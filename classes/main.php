<?php
    class main {
        public function __construct() {
            $pageRequest = pageFunctions::getRequestPage();
            $page = new $pageRequest;
            pageFunctions::runPageFunction($page);
        }
    }
?>