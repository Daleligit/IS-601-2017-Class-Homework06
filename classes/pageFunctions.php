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
                    switch ($tableName) {
                        case 'accounts';
                            $result = table::createTable(accounts::findAll());
                            break;
                        case 'todos';
                            $result = table::createTable(todos::findAll());
                            break;
                    }
                    break;
                case 'findOne';
                    if (!empty($id)) {
                        switch ($tableName) {
                            case 'accounts';
                                $result = table::createTable(accounts::findOne($id));
                                break;
                            case 'todos';
                                $result = table::createTable(todos::findOne($id));
                                break;
                        }
                        if ($result == '<table id=displayTable></table>') {
                            $result = htmlTags::changeRow('There is not a line with id = ' . $id);
                        }
                    } else {
                        $result = htmlTags::changeRow('Please input an ID');
                    }
                    break;
                case 'delete';
                    if (!empty($id)) {
                        switch ($tableName) {
                            case 'accounts';
                                $account = account::create();
                                $result = $account->delete($id);
                                break;
                            case 'todos';
                                $todo = todo::create();
                                $result = $todo->delete($id);
                                break;
                        }
                    } else {
                        $result = htmlTags::changeRow('Please input an ID');
                    }
                    break;
                case 'save';
                    if (!empty($id)) {
                        switch ($tableName) {
                            case 'accounts';
                                $account = account::create();
                                $account->id = $id;
                                $account->email = $_POST['email'];
                                $account->fname = $_POST['fname'];
                                $account->lname = $_POST['lname'];
                                $account->phone = $_POST['phone'];
                                $account->birthday = $_POST['birthday'];
                                $account->gender = $_POST['gender'];
                                $account->password = $_POST['password'];
                                $result = $account->save();
                                break;
                            case 'todos';
                                $todo = todo::create();
                                $todo->id = $id;
                                $todo->owneremail = $_POST['owneremail'];
                                $todo->ownerid = $_POST['ownerid'];
                                $todo->createddate = $_POST['createddate'];
                                $todo->duedate = $_POST['duedate'];
                                $todo->message = $_POST['message'];
                                $todo->isdone = $_POST['isdone'];
                                $result = $todo->save();
                                break;
                        }
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