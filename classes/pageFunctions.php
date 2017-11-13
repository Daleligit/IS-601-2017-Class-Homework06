<?php
    class pageFunctions {
        static public function getRequestPage () {
            $pageRequest = 'homepage';
            if (isset($_REQUEST['page'])) {
                $pageRequest = $_REQUEST['page'];
            }
            return $pageRequest;
        }
        static public function runPageFunction ($page) {
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $page->get();
            } else {
                $page->post();
            }
        }
        static public function changePage($linkUrl) {
            header('Location: ' . $linkUrl);
        }
    }
?>