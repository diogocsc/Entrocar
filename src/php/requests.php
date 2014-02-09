<?php
    require_once("filedata.php");
    
    class Request  {
        public $id;
        public $user;
        public $description;
        public $type;
        public $category;
        public $details;
        public $status;
    };
    
    class RequestList extends FileData {
        private $category_type = array(
            "Cook",
            "Cloth",
            "Jogging",
            "Firefight",
            "Misc."
        );    
        private $status_type =  array (
            "Open",
            "Done",
            "Closed",
            "Reported"
        );
        
        
        public function addRequest ($json) {
            $data = json_decode ($json,true);
            $tmp = new Request();
            $this->openAndLoad();
            $tmp->id = isset($data["id"])?$data["id"]:uniqid();
            $tmp->user = isset($data["user"])?$data["user"]:"User";
            $tmp->description = isset($data["description"])?$data["description"]:"Description";
            $tmp->type = isset($data["type"])?$data["type"]:"Type";
            $tmp->category = isset($data["category"])?$data["category"]:"Misc.";
            $tmp->details = isset($data["details"])?$data["details"]:"Details";
            $tmp->status = isset($data["status"])?$data["status"]:"Reported";
            
            array_push ($this->data,$tmp);
            $this->saveAndClose();
        }
        
        public function getCategory_type () { return $this->category_type; }
        public function getStatus_type () { return $this->status_type; }
        public function getRequestBy ($filter,$value,$data = null) {
            if ($data == null) $data = $this->data;
            
            switch ($filter) {
                case "id": $this->getRequestById($value); break;
            }
            
        }
        private function getRequestById($value) {
            foreach ($this->data as $d) {
                if($user->id == $value) return $d;
            }
        }
        public function __construct (){
            $this->openAndLoad();
        }
    };

?>
