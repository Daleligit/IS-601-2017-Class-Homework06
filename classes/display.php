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
            switch ($method) {
                case 'findAll';
                    switch ($tableName) {
                        case 'accounts';
                            $this->html .= table::createTable(accounts::findAll());
                            break;
                        case 'todos';
                            $this->html .= table::createTable(todos::findAll());
                            break;
                    }
                    break;
                case 'findOne';
                    $id = $_POST['id'];
                    if (!empty($id)) {
                        switch ($tableName) {
                            case 'accounts';
                                $this->html .= table::createTable(accounts::findOne($id));
                                break;
                            case 'todos';
                                $this->html .= table::createTable(todos::findOne($id));
                                break;
                        }
                    } else {
                        $this->html .= htmlTags::changeRow('Please input an ID');
                    }
                    break;
                case 'delete';
                    $id = $_POST['id'];
                    if (!empty($id)) {
                        switch ($tableName) {
                            case 'accounts';
                                $account = new account();
                                $this->html .= $account->delete($id);
                                break;
                            case 'todos';
                                $todo = new todo();
                                $this->html .= $todo->delete($id);
                                break;
                        }
                    } else {
                        $this->html .= htmlTags::changeRow('Please input an ID');
                    }
                    break;
                case 'save';
                    $id = $_POST['id'];
                    if (!empty($id)) {
                        switch ($tableName) {
                            case 'accounts';
                                $account = new account();
                                $account->id = $id;
                                $account->email = $_POST['email'];
                                $account->fname = $_POST['fname'];
                                $account->lname = $_POST['lname'];
                                $account->phone = $_POST['phone'];
                                $account->birthday = $_POST['birthday'];
                                $account->gender = $_POST['gender'];
                                $account->password = $_POST['password'];
                                $this->html .= $account->save();
                                break;
                            case 'todos';
                                $todo = new todo();
                                $todo->id = $id;
                                $todo->owneremail = $_POST['owneremail'];
                                $todo->ownerid = $_POST['ownerid'];
                                $todo->createddate = $_POST['createddate'];
                                $todo->duedate = $_POST['duedate'];
                                $todo->message = $_POST['message'];
                                $todo->isdone = $_POST['isdone'];
                                $this->html .= $todo->save();
                                break;
                        }
                    } else {
                        $this->html .= htmlTags::changeRow('Please input an ID');
                    }
                    break;
            }
            $this->html .= htmlTags::turnPage('index.php?page=display&table=' . $tableName,'Back');
        }
    }
?>