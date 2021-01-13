<?php
class GuilhermeMedeiros_ButtonColorChanger_Block_Adminhtml_Rules_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{        

		$rule_data = Mage::registry("buttoncolorchanger_rule_data");
		$form_data = null;
		if(!empty($rule_data))
			$form_data = $rule_data->getData();		
		$form = new Varien_Data_Form();
        $this->setForm($form);
        
        $fieldset = $form->addFieldset("buttoncolorchanger_form", array("legend" => Mage::helper("buttoncolorchanger")->__("Configurações da Regra")));		
        $fieldset->addType('color', 'GuilhermeMedeiros_ButtonColorChanger_Block_Adminhtml_Rules_Renderer_Color');
        
        $outputFormat = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);        

        $fieldset->addField("type", "select", array(
			"label" => Mage::helper("buttoncolorchanger")->__("Tipo"),
			"name" => "type",			
			'values'   => Mage::getModel('buttoncolorchanger/entity_types')->getOption(),
			"required" => true,
        ));
        
        $fieldset->addField("color", "color", array(
			"label" => Mage::helper("buttoncolorchanger")->__("Cor"),
			"name" => "color",            
			"required" => true,
		));

		$fieldset->addField("date_from", "date", array(
			"label" => Mage::helper("buttoncolorchanger")->__("De"),
			"name" => "date_from",			
			'time'      =>    true,
            'format'    =>    $outputFormat,
            'image'     =>    $this->getSkinUrl('images/grid-cal.gif'),
            "required" => true
        ));
        
        $fieldset->addField("date_to", "date", array(
			"label" => Mage::helper("buttoncolorchanger")->__("Até"),
			"name" => "date_to",			
			'time'      =>    true,
            'format'    =>    $outputFormat,            
            'image'     =>    $this->getSkinUrl('images/grid-cal.gif'),
            "required" => true
        ));
        
        $fieldset->addField("day_week", "multiselect", array(
			"label" => Mage::helper("buttoncolorchanger")->__("Dia da Semana"),
			"name" => "day_week",			            	
            "values" => Mage::getModel('adminhtml/system_config_source_locale_weekdays')->toOptionArray(),
			"required" => true,
		));

		$fieldset->addField("description", "text", array(
			"label" => Mage::helper("buttoncolorchanger")->__("Descrição"),
			"name" => "description",			
			"type" => "text",	
		));

        $this->setChild('form_after', $this->getLayout()
    	->createBlock('adminhtml/widget_form_element_dependence')
        ->addFieldMap('type', 'type')
        ->addFieldMap('date_from', 'date_from')
        ->addFieldMap('date_to', 'date_to')
        ->addFieldMap('day_week', 'day_week')		
		->addFieldDependence('date_from', 'type', '1')
        ->addFieldDependence('date_to', 'type', '1')
        ->addFieldDependence('day_week', 'type', '2')
		);

		if (Mage::getSingleton("adminhtml/session")->getButtonColorRuleData()) {
			$form->setValues(Mage::getSingleton("adminhtml/session")->getButtonColorRuleData());
			Mage::getSingleton("adminhtml/session")->setButtonColorRuleData(null);
		} elseif ($form_data) {
			$form->setValues($form_data);
		}
		return parent::_prepareForm();
    }    
}
