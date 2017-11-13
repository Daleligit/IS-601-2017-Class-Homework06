<?php
    class account extends model {
        public $id;
        public $owneremail;
        public $ownerid;
        public $createddate;
        public $duedate;
        public $message;
        public $isdone;
        public function __construct()
        {
            $this->tableName = 'accounts';
        }
    }
?>