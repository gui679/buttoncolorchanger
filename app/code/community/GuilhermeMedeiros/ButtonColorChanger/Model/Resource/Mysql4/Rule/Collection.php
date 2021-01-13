<?php

use Mage_Core_Model_Mysql4_Collection_Abstract as CollectionAbstract;
use GuilhermeMedeiros_ButtonColorChanger_Interfaces_RuleInterface as RuleInterface;

class GuilhermeMedeiros_ButtonColorChanger_Model_Resource_Mysql4_Rule_Collection extends CollectionAbstract
{
    protected function _construct()
    {
        $this->_init(RuleInterface::MODEL);        
    }
}
