<?php

    require_once ("requests.php");
    require_once ("users.php");
    require_once ("exchanges.php");

    class HourTime {
        public $users = null;
        public $requests = null;
        public $exchanges = null;
    
        public function __construct () {
            $this->users = new UserList();
            $this->requests = new RequestList();
            $this->exchanges = new ExchangeList();

            $this->users->filename = "data/users";
            $this->requests->filename = "data/requests";
            $this->exchanges->filename = "data/exchanges";
        }
        
        public function httpRequestHandler () {
            $answer = null;
            if (isset($_REQUEST["function"])) {
                $data = isset($_REQUEST["data"])?$_REQUEST["data"]:array();
                switch ($_REQUEST["function"]){
                    case "addUser" : 
                        $answer = $this->users->addUser($data); 
                    break;
                    case "getUsers":
                        $answer = $this->users-getUsers();
                    break;
                    case "getUserBy": 
                        $d = json_decode ($data,true);
                        $filter = isset($d["filter"])?$d["filter"]:"";
                        $value  = isset($d["value"])?$d["value"]:"";
                        $array  = isset($d["array"])?$d["array"]:null;
                        $answer = $this->users->getUserBy ($filter,$value,$array);
                    break;
                    case "rateUser":
                        $d = json_decode ($data,true);
                        $userid = isset($d["id"])?$d["id"]:"";
                        $value  = isset($d["value"])?$d["value"]:"";
                        $this->users->openAndLoad();
                        $user = $this->users->getUserById($userid);
                        $answer = $user->rate($value);
                        $this->users->saveAndClose();
                    break;
                    case "getCategory_type": 
                        $answer = $this->requests->getCategory_type();
                    break;
                    case "getStatus_type": 
                        $answer = $this->requests->getStatus_type();
                    break;
                    case "addRequest" : 
                        $answer = $this->requests->Request($data); 
                    break;
                    case "getRequests":
                        $answer = $this->requests-getRequests();
                    break;
                    case "getRequestBy": 
                        $d = json_decode ($data,true);
                        $filter = isset($d["filter"])?$d["filter"]:"";
                        $value  = isset($d["value"])?$d["value"]:"";
                        $array  = isset($d["array"])?$d["array"]:null;
                        $answer = $this->requests->getRequestBy ($filter,$value,$array);
                    break;
                    case "addExchange" : 
                        $answer = $this->exchanges->addExchange($data); 
                    break;
                    case "getExchanges":
                        $answer = $this->exchanges-getExchanges();
                    break;
                    case "getExchangeBy": 
                        $d = json_decode ($data,true);
                        $filter = isset($d["filter"])?$d["filter"]:"";
                        $value  = isset($d["value"])?$d["value"]:"";
                        $array  = isset($d["array"])?$d["array"]:null;
                        $answer = $this->exchanges->getExchangeBy ($filter,$value,$array);
                    break;
                }
            }
            return json_encode($answer);
        }

    };

    $hourtime = new HourTime();
    print $hourtime->httpRequestHandler();
?>
