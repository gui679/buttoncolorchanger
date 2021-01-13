<?php

class GuilhermeMedeiros_ButtonColorChanger_Block_Adminhtml_Rules_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

	public function __construct()
	{
		parent::__construct();
		$this->setId("buttoncolorchangerRulesGrid");
		$this->setDefaultSort("");
		$this->setDefaultDir("DESC");
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel("buttoncolorchanger/rule")->getCollection();
        $collection->getSelect()->distinct(true);
        
        foreach($collection as $rule){
            $workrule = "";
            if($rule->getType() == 1){
                $rule->setWorkrule("de ".date("d/m/Y h:m", strtotime($rule->getDateFrom()))." até ".date("d/m/Y h:m", strtotime($rule->getDateTo())));
            } else if($rule->getType() == 2){
                $weekdays = Mage::getModel('adminhtml/system_config_source_locale_weekdays')->toOptionArray();
                $dias = explode(",",$rule->getDayWeek());
                $dias_str = "";
                foreach($dias as $index => $dia){
                    if($index == 0){
                        $dias_str .= "dias: ";
                    }
                    else if($index == ( count($dias) - 1 )){
                        $dias_str .= " e ";
                    } else {
                        $dias_str .= ", ";
                    }
                    $dias_str .= $weekdays[$dia]['label'];
                }
                $rule->setWorkrule($dias_str);
            }
        }

		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	protected function _prepareColumns()
	{
		$this->addColumn("entity_id", array(
			"header" => Mage::helper("buttoncolorchanger")->__("#"),
			"align" => "right",
			"width" => "50px",
			"type" => "number",
			"index" => "id",
        ));
        
        $this->addColumn("color", array(
			"header" => Mage::helper("buttoncolorchanger")->__("Cor"),
			"index" => "color",            
            "width" => "100px",
            "frame_callback" => array($this, 'callback_color'),
		));


		$this->addColumn("type", array(
			"header" => Mage::helper("buttoncolorchanger")->__("Tipo"),
			"index" => "type",
            'type'      => 'options',
            "width" => "100px",
            'options'      => Mage::getModel('buttoncolorchanger/entity_types')->getOption(),
		));

		$this->addColumn("workrule", array(
            "header" => Mage::helper("buttoncolorchanger")->__("Regra"),
            "filter" => false,
			"index" => "workrule",
		));

		$this->addColumn("description", array(
            "header" => Mage::helper("buttoncolorchanger")->__("Descrição"),            
			"index" => "description",
		));		
		$this->addColumn("updated_at", array(
			"header" => Mage::helper("buttoncolorchanger")->__("Atualizado Em"),
			"type" => "date",
			"index" => "updated_at",
		));
		$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
		$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		return $this->getUrl("*/*/edit", array("id" => $row->getId()));
	}

	public function callback_color($value)
	{		
		return "<div style='width:100px;height:20px;background-color:#$value;text-align:center;'><span style='color:#$value;filter:invert(100%);font-weight:bold;'>".$value."</span></div>";
	}
}
