<?php
class Check {
    protected $_dices = array();
    protected $_diceCount;
    protected $_poolCount;
    protected $_minimum;
    protected $_results = array();
    protected $_successCount = 0;
    protected $_criticalCount = 0;
    protected $_endOfRerolling = false;

    public function getSuccess() {
        if($this->_criticalCount<=count($this->_dices))
                return $this->_successCount;
        else
                return -1;
    }
    public function getCritCount() {
        return $this->_criticalCount;
    }
    public function getResults() {
        $ordered_results = array();
        foreach($this->_results as $result){
            if(isset($ordered_results[$result]))
                $ordered_results[$result]++;
            else
                $ordered_results[$result]=1;
        }
        ksort($ordered_results);
        return $ordered_results;
    }
    public function mayReroll() {
        return !$this->_endOfRerolling;
    }
    public function  __construct($diceCount, $poolCount, $minimum) {
        if($diceCount < $poolCount) {
            throw new InvalidArgumentException('Number of pool dices may not be bigger than skill');
        }
        $this->_diceCount = $diceCount;
        $this->_poolCount = $poolCount;
        for($i=0;$i<($diceCount+$poolCount);$i++) {
            array_push($this->_dices, new SixSider(true));
        }
        $this->_minimum = $minimum;
    }

    public function execute() {
        foreach($this->_dices as $diceIndex => $dice) {
            $dice->roll();
            $result = $dice->getResult();
            if($result>=$this->_minimum)
                    $this->_successCount++;
            if($result==1) 
                    $this->_criticalCount++;
            
            $this->_results[$diceIndex] = $result;
        }
        
    }
    public function afterRoll() {
        $this->_endOfRerolling = true;
        $additionalDice = new SixSider(true);
        $this->_dices[] = $additionalDice;
        $this->_results[] = $additionalDice->roll()->getResult();
    }

    public function reroll() {
        if($this->_endOfRerolling) throw new Exception ('No rerolling');
        
        foreach($this->_dices as $diceIndex => $dice) {
            if($dice->getResult()>=$this->_minimum) continue;
            $dice->roll();
            $result = $dice->getResult();
            if($result>=$this->_minimum)
                    $this->_successCount++;
            if($result==1) 
                    $this->_criticalCount++;
            $this->_results[$diceIndex] = $result;
        }
    }

    /**
     *  checks if more 1's than skilldice
     * @return bool
     */
    private function _checkKillswitch() {
        $kills = 0;
         foreach($this->_dices as $diceIndex => $dice) {
            if($dice->getResult()==1) $kills++;
        }
        if($kills>=$this->_dices) return true;
        else return false;
    }
}
?>
