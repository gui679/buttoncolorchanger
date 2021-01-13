<?php
class GuilhermeMedeiros_ButtonColorChanger_Adminhtml_RulesController extends Mage_Adminhtml_Controller_Action
{

	protected function _isAllowed()
	{
		//return Mage::getSingleton('admin/session')->isAllowed('buttoncolorchanger/buttoncolorchanger');
		return true;
	}

	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu("cms/buttoncolorchanger")->_addBreadcrumb(Mage::helper("adminhtml")->__("CMS"), Mage::helper("adminhtml")->__("Trocar Cor dos Botões"));
		return $this;
	}
	public function indexAction()
	{
		$this->_title($this->__("Trocar Cor dos Botões"));
		$this->_title($this->__("Trocar Cor dos Botões"));
		$this->_initAction();
		$this->renderLayout();
	}
	public function editAction()
	{
		$this->_title($this->__("Trocar Cor dos Botões"));
		$this->_title($this->__("Trocar Cor dos Botões"));
		$this->_title($this->__("Editar Regra"));

		$id = $this->getRequest()->getParam("id");
		$model = Mage::getModel("buttoncolorchanger/rule")->load($id);

		if ($model->getId()) {
			Mage::register("buttoncolorchanger_rule_data", $model);
			$this->loadLayout();
			$this->_setActiveMenu("buttoncolorchanger/rule");
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Gerenciar Regras"), Mage::helper("adminhtml")->__("Gerenciar Regras"));
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Configuração dos Regras"), Mage::helper("adminhtml")->__("Configuração dos Regras"));
			$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock("buttoncolorchanger/adminhtml_rules_edit"))->_addLeft($this->getLayout()->createBlock("buttoncolorchanger/adminhtml_rules_edit_tabs"));
			$this->renderLayout();
		} else {
			Mage::getSingleton("adminhtml/session")->addError(Mage::helper("buttoncolorchanger")->__("Regra não encontrada."));
			$this->_redirect("*/*/");
		}
	}

	public function newAction()
	{

		$this->_title($this->__("Trocar Cor dos Botões"));
		$this->_title($this->__("Trocar Cor dos Botões"));
		$this->_title($this->__("Cadastrar Regra"));

		// $id   = $this->getRequest()->getParam("id");
		// $model  = Mage::getModel("buttoncolorchanger/rule")->load($id);

		// $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		// if (!empty($data)) {
		// 	$model->setData($data);
		// }

		// Mage::register("buttoncolorchanger_rule_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("buttoncolorchanger/rule");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Gerenciar Regras"), Mage::helper("adminhtml")->__("Gerenciar Regras"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Configuração dos Regras"), Mage::helper("adminhtml")->__("Configuração dos Regras"));


		$this->_addContent($this->getLayout()->createBlock("buttoncolorchanger/adminhtml_rules_edit"))->_addLeft($this->getLayout()->createBlock("buttoncolorchanger/adminhtml_rules_edit_tabs"));

		$this->renderLayout();
	}
	public function saveAction()
	{
		$post_data = $this->getRequest()->getPost();
		if ($post_data) {
			unset($post_data['form_key']);
			try {				
				if (isset($post_data['date_from']) || isset($post_data['date_to'])) {
					$date_fields = ['date_from', 'date_to'];

					$post_data      = $this->_filterDateTime($post_data, $date_fields);
					$store_timezone = new DateTimeZone(Mage::getStoreConfig('general/locale/timezone'));

					foreach ($post_data as $key) if (isset($data[$key])) {
						$dateTime = new DateTime($data[$key], $store_timezone);
						$data[$key] = $dateTime->format('Y-m-d H:i:s');
					}
				} else if(isset($post_data['day_week'])){
					$post_data['day_week'] = implode(",",$post_data['day_week']);
				}
					$model = Mage::getModel("buttoncolorchanger/rule")
						->setData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->setUpdatedAt(Mage::getModel('core/date')->gmtDate('Y-m-d H:i:s'));
				if (!$this->getRequest()->getParam("id")) {
					$model->setCreatedAt(Mage::getModel('core/date')->gmtDate('Y-m-d H:i:s'));
				}
				$model->save();

				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Regra salvo com sucesso."));

				if ($this->getRequest()->getParam("back")) {
					$this->_redirect("*/*/edit", array("id" => $model->getId()));
					return;
				}
				$this->_redirect("*/*/");
				return;
			} catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				Mage::getSingleton("adminhtml/session")->setButtonColorRuleData($this->getRequest()->getPost());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
				return;
			}
		}
		$this->_redirect("*/*/");
	}

	public function deleteAction()
	{
		if ($this->getRequest()->getParam("id") > 0) {
			try {
				$model = Mage::getModel("buttoncolorchanger/rule");
				$model->setId($this->getRequest()->getParam("id"))->delete();
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Regra foi excluída."));
				$this->_redirect("*/*/");
			} catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
			}
		}
		$this->_redirect("*/*/");
	}


	public function massRemoveAction()
	{
		try {
			$ids = $this->getRequest()->getPost('entity_ids', array());
			foreach ($ids as $id) {
				$model = Mage::getModel("buttoncolorchanger/rule");
				$model->setId($id)->delete();
			}
			Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__(count($ids) . " vendedores foram excluídos."));
		} catch (Exception $e) {
			Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
		}
		$this->_redirect('*/*/');
	}
	/**
	 * Export order grid to CSV format
	 */
	public function exportCsvAction()
	{
		$fileName   = 'rules.csv';
		$grid       = $this->getLayout()->createBlock('buttoncolorchanger/adminhtml_rule_grid');
		$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
	}
	/**
	 *  Export order grid to Excel XML format
	 */
	public function exportExcelAction()
	{
		$fileName   = 'rules.xls';
		$grid       = $this->getLayout()->createBlock('buttoncolorchanger/adminhtml_rule_grid');
		$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
	}

	public function gridAction()
	{
		$this->loadLayout();
		$this->getResponse()->setBody(
			$this->getLayout()->createBlock('buttoncolorchanger/adminhtml_rule_renderer_products_block')->toHtml()
		);
	}
}
