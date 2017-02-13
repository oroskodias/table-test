<?php

namespace ImaginationMedia\TableTest\Block\System\Config\Form\Field;

class Active extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray {

	protected $_columns = [];
	protected $_m2AttributesRenderer;
	protected $_testAttribsRenderer;
	protected $_testSelectorRenderer;
	protected $_addAfter = TRUE;
	protected $_addButtonLabel;

	protected function _construct() {
		parent::_construct();
		$this->_addButtonLabel = __('Add Row');
	}

	protected function getMagentoAttributesRenderer() {
		if (!$this->_m2AttributesRenderer) {
			$this->_m2AttributesRenderer = $this->getLayout()->createBlock(
				'\ImaginationMedia\TableTest\Block\Adminhtml\Form\Field\MagentoAttributes',
				'',
				['data' =>
					['is_render_to_js_template' => TRUE]
				]);
		}

		return $this->_m2AttributesRenderer;
	}

	protected function getTestAttributesRenderer() {
		if (!$this->_testAttribsRenderer) {
			$this->_testAttribsRenderer = $this->getLayout()->createBlock(
				'\ImaginationMedia\TableTest\Block\Adminhtml\Form\Field\TestAttributes',
				'',
				['data' =>
					['is_render_to_js_template' => TRUE]
				]);
		}

		return $this->_testAttribsRenderer;
	}

	protected function getTestSelectorRenderer() {
		if (!$this->_testSelectorRenderer) {
			$this->_testSelectorRenderer = $this->getLayout()->createBlock(
				'\ImaginationMedia\TableTest\Block\Adminhtml\Form\Field\TestSelector',
				'',
				['data' =>
					['is_render_to_js_template' => TRUE]
				]);
		}

		return $this->_testSelectorRenderer;
	}

    protected function _prepareToRender() {
		$this->addColumn('m2_attribute', ['label' => __('M2'), 'renderer' => $this->getMagentoAttributesRenderer()]);
		$this->addColumn('test_attribute', ['label' => __('TestAttr'), 'renderer' => $this->getTestAttributesRenderer()]);
		$this->addColumn('test_selector', ['label' => __('TestSelect'), 'renderer' => $this->getTestSelectorRenderer()]);

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Attribute');
    }

    protected function _prepareArrayRow(\Magento\Framework\DataObject $row) {
		$optionExtraAttr = [];
		$optionExtraAttr['option_' . $this->getMagentoAttributesRenderer()->calcOptionHash($row->getData('m2_attribute'))] = 'selected="selected"';
		$optionExtraAttr['option_' . $this->getTestAttributesRenderer()->calcOptionHash($row->getData('test_attribute'))] = 'selected="selected"';
		$optionExtraAttr['option_' . $this->getTestSelectorRenderer()->calcOptionHash($row->getData('test_selector'))] = 'selected="selected"';
		$row->setData('option_extra_attrs', $optionExtraAttr);
	}

    public function renderCellTemplate($columnName) {
		$this->_columns[$columnName]['class'] = 'input-text required-entry validate-number';
		$this->_columns[$columnName]['style'] = 'width:100%';

        return parent::renderCellTemplate($columnName);
    }
}
