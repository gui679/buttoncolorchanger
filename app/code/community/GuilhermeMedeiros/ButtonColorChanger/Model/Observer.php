<?php

class GuilhermeMedeiros_ButtonColorChanger_Model_Observer
{
    public function addCssToEnd($observer)
    {
        $layout = $observer->getEvent()->getLayout()->getUpdate();
        $layout->addHandle('buttoncolorchanger_add_block_css');
        Mage::log('add handle',null, 'debug_aquele.log', true);
        return $this;
    }
}
