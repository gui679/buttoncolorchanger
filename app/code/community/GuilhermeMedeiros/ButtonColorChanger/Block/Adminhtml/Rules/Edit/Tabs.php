<?php
class GuilhermeMedeiros_ButtonColorChanger_Block_Adminhtml_Rules_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("buttoncolorchanger_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("buttoncolorchanger")->__("Regra"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("buttoncolorchanger")->__("Configurações da Regra"),
				"title" => Mage::helper("buttoncolorchanger")->__("Configurações da Regra"),
				"content" => $this->getLayout()->createBlock("buttoncolorchanger/Adminhtml_Rules_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
