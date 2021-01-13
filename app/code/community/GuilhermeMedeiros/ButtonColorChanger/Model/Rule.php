<?php

class GuilhermeMedeiros_ButtonColorChanger_Model_Rule extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->model = new Varien_Data_Collection_Db();
        $this->model->__construct(
            Mage::getSingleTon('core/resource')
                ->getConnection('buttoncolorchange_write')
        );
        $this->_init(GuilhermeMedeiros_ButtonColorChanger_Interfaces_RuleInterface::MODEL);
    }

    public function save(){
        $this->setUpdatedAt(Mage::getModel('core/date')->gmtDate('Y-m-d H:i:s'));
        parent::save();
    }
}
