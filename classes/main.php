<?php
    class main {
        public function __construct() {
            //Set default page as homepage
            $pageRequest = 'homepage';
            if (isset($_REQUEST['page'])) {
                $pageRequest = $_REQUEST['page'];
            }
            $page = new $pageRequest;
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $page->get();
            } else {
                $page->post();
            }
        }
    }
?>