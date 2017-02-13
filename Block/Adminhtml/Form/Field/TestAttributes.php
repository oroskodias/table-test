<?php

	namespace ImaginationMedia\TableTest\Block\Adminhtml\Form\Field;

	class TestAttributes extends \Magento\Framework\View\Element\Html\Select {

		public function __construct(
			\Magento\Framework\View\Element\Context $context, array $data = []
		) {
			parent::__construct($context, $data);
		}

		public function getTestAttributes(){
			$attributes = array(
				'key1' => 'value1',
				'key2' => 'value2',
				'key3' => 'value3',
				'key4' => 'value4',
				'key5' => 'value5'
			);

			return $attributes;
		}

		public function _toHtml() {
			if (!$this->getOptions()) {
				foreach($this->getTestAttributes() as $key => $attr){
					$this->addOption($key, $key);
				}
			}
			return parent::_toHtml();
		}

		public function setInputName($value) {
			return $this->setName($value);
		}

	}
