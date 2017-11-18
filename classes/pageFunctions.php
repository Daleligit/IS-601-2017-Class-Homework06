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
        static public function runMethod ($method,$tableName,$id) {
            switch ($method) {
                case 'findAll';
                    $result = table::createTable($tableName::findAll());
                    break;
                case 'findOne';
                    if (!empty($id)) {
                        $result = table::createTable($tableName::findOne($id));
                        if ($result == '<table id=displayTable></table>') {
                            $result = htmlTags::changeRow('There is not a line with id = ' . $id);
                        }
                    } else {
                        $result = htmlTags::changeRow('Please input an ID');
                    }
                    break;
                case 'delete';
                    $tableName = stringFunctions::rightTrim($tableName, 's');
                    if (!empty($id)) {
                        $table = $tableName::create();
                        $table->id = $id;
                        $result = $table->delete();
                    } else {
                        $result = htmlTags::changeRow('Please input an ID');
                    }
                    break;
                case 'save';
                    $tableName = stringFunctions::rightTrim($tableName, 's');
                    if (!empty($id)) {
                        $table = $tableName::create();
                        $table->id = $id;
                        switch ($tableName) {
                            case 'account';
                                $table->email = $_POST['email'];
                                $table->fname = $_POST['fname'];
                                $table->lname = $_POST['lname'];
                                $table->phone = $_POST['phone'];
                                $table->birthday = $_POST['birthday'];
                                $table->gender = $_POST['gender'];
                                $table->password = $_POST['password'];
                                break;
                            case 'todo';
                                $table->owneremail = $_POST['owneremail'];
                                $table->ownerid = $_POST['ownerid'];
                                $table->createddate = $_POST['createddate'];
                                $table->duedate = $_POST['duedate'];
                                $table->message = $_POST['message'];
                                $table->isdone = $_POST['isdone'];
                                break;
                        }
                        $result = $table->save();
                    } else {
                        $result = htmlTags::changeRow('Please input an ID');
                    }
                    break;
            }
            return $result;
        }
        static public function getID ($method) {
            if ($method != 'findAll') {
                return $_POST['id'];
            } else {
                return null;
            }
        }
        static public function outputErrorMassage () {
            global $connErr;
            global $sqlErr;
            if (!empty($connErr)) {
                $output = $connErr;
                $connErr = '';
                return $output;
            } elseif (!empty($sqlErr)) {
                $output = $sqlErr;
                $sqlErr = '';
                return $output;
            } else {
                $output = '';
                return $output;
            }
        }
    }
?>