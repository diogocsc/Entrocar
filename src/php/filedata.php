<?php
    require_once ("users.php");
    require_once ("requests.php");
    require_once ("exchanges.php");

    class FileData {
        public $filename;
        private $file;
        public $data = array();
        public function open () {
            $this->file = fopen ($this->filename,"w+");
        }
        public function close() {
            fclose($this->file);
        }
        public function load () {
            $data = unserialize (file_get_contents($this->file));
        }
        public function save () {
            fwrite($this->file,serialize($this->data));
        }
        
        public function openAndLoad(){
            $this->open();
            $this->load();
        }
        public function saveAndClose() {
            $this->save();
            $this->close();
        }
    };

?>
