<?php
    require_once ("filedata.php");
    

    class User {
        public $id;
        public $name;
        public $surname;
        public $address;
        public $email;
        public $phone;
        public $rating;
        public $totalratings;
        
        public  function rate ($value) {
            $this->totalratings++;
            $this->rating += $value / $this->totalratings;
        }
    };
    
    class UserList extends FileData{
        public function addUser ($json) {
            $data = json_decode ($json,true);
            $tmp = new User();
            $this->openAndLoad();
            $tmp->id = isset($data["id"])?$data["id"]:uniqid();
            $tmp->name = isset($data["name"])?$data["name"]:"Name";
            $tmp->surname = isset($data["surname"])?$data["surname"]:"Surname";
            $tmp->address = isset($data["address"])?$data["address"]:"Address";
            $tmp->email = isset($data["email"])?$data["email"]:"E-mail";
            $tmp->phone = isset($data["phone"])?$data["phone"]:"000-000-0000000";
            $tmp->rating = isset($data["rating"])?$data["rating"]:3;
            $tmp->totalratings = isset($data["totalratings"])?$data["totalratings"]:1;
            array_push ($this->data,$tmp);
            $this->saveAndClose();
        }
        public function getUserBy ($filter,$value,$users = null) {
            if ($users == null) $users = $this->users;
            
            switch ($filter) {
                case "id": $this->getUserById($value); break;
            }
            
        }
        public function getUserById($value) {
            foreach ($this->users as $user) {
                if($user->id == $value) return $user;
            }
        }
        public function __construct (){
            $this->openAndLoad();
        }
    };


?>
