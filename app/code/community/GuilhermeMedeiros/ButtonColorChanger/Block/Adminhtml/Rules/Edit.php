<?php

class GuilhermeMedeiros_ButtonColorChanger_Block_Adminhtml_Rules_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "";
				$this->_blockGroup = "buttoncolorchanger";
				$this->_controller = "Adminhtml_Rules";
				$this->_updateButton("save", "label", Mage::helper("buttoncolorchanger")->__("Salvar Regra"));
				$this->_updateButton("delete", "label", Mage::helper("buttoncolorchanger")->__("Apagar Regra"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("buttoncolorchanger")->__("Salvar e continuar editando"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("buttoncolorchanger_seller_data") && Mage::registry("buttoncolorchanger_seller_data")->getId() ){

				    return Mage::helper("buttoncolorchanger")->__("Editar Regra ID: %s", $this->htmlEscape(Mage::registry("buttoncolorchanger_seller_data")->getId()));

				}
				else{

				     return Mage::helper("buttoncolorchanger")->__("Adicionar Regra");

				}
		}
}