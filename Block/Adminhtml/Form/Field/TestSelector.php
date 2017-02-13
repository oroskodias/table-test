<?php

	namespace ImaginationMedia\TableTest\Block\Adminhtml\Form\Field;

	class TestSelector extends \Magento\Framework\View\Element\Html\Select {

		public function __construct(
			\Magento\Framework\View\Element\Context $context, array $data = []
		) {
			parent::__construct($context, $data);
		}

		public function _toHtml() {
			if (!$this->getOptions()) {
				$this->addOption('false', 'Off');
				$this->addOption('true', 'On');
			}
			return parent::_toHtml();
		}

		public function setInputName($value) {
			return $this->setName($value);
		}

	}
