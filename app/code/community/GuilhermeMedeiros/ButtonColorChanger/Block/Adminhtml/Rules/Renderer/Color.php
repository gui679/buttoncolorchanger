<?php

class GuilhermeMedeiros_ButtonColorChanger_Block_Adminhtml_Rules_Renderer_Color extends  Varien_Data_Form_Element_Abstract
{
    protected $_element;

    public function getElementHtml()
    {
        $rule = false;
        if(Mage::app()->getRequest()->getParam('id'))
            $rule =  Mage::getModel('buttoncolorchanger/rule')->load(Mage::app()->getRequest()->getParam('id'));
        $html = '<input id="color" name="color" class="input-text color" value="'.($rule ? $rule->getColor() : "FFFFFF").'" data-jscolor="{}">';
        return $html;
    }
}
