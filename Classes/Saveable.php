<?php
abstract class Saveable {
    public static $_instance; //INSTANCE = null;
    
    public function  __construct() {
        try {
            $this->restore();
        } catch (Exception $e) {
        }
    }

    public static function getInstance() {
    }
    public function save() {
        $saveData = $this->_getSaveData();
        $className = get_class($this);
        echo "Saving ".$className." to Backend.\n";
        $saveableItem = serialize($saveData);
        if($fp = fopen($className.'.save', 'w')) {
            if(fwrite($fp,$saveableItem) === FALSE )
                    throw new Exception ("Could not save");
        }
    }
    public function restore() {
        $className = get_called_class();
        echo "Loading ".$className." from Backend.\n";
        if(!file_exists($className.'.save')) throw new Exception ('no file');
        $item = implode("", @file($className.'.save'));
        $this->_setSaveData(unserialize($item));
    }
    public function  __destruct() {
        $this->save();
    }

    protected abstract function _getSaveData();
    protected abstract function _setSaveData($savedata);
}
?>
