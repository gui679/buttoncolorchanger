<?php

use Mage_Core_Model_Mysql4_Abstract as Mysql4Abstract;
use GuilhermeMedeiros_ButtonColorChanger_Interfaces_RuleInterface as RuleInterface;

class GuilhermeMedeiros_ButtonColorChanger_Model_Resource_Mysql4_Rule extends Mysql4Abstract
{
    protected function _construct()
    {
        $this->_init(
            RuleInterface::MODEL,
            RuleInterface::ID
        );
        $this->_isPkAutoIncrement = false;
    }
}
