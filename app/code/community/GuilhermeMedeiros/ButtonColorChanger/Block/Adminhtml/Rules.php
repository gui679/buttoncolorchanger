<?php

class GuilhermeMedeiros_ButtonColorChanger_Block_Adminhtml_Rules extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct()
	{	
	$this->_controller = "adminhtml_rules";
	$this->_blockGroup = "buttoncolorchanger";
	$this->_headerText = Mage::helper("buttoncolorchanger")->__("Gerenciar Regras Trocar Cor dos Botões");
	$this->_addButtonLabel = Mage::helper("buttoncolorchanger")->__("Adicionar Regra");
	parent::__construct();
	}
}