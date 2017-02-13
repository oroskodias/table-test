<?php

	namespace ImaginationMedia\TableTest\Block\Adminhtml\Form\Field;

	class MagentoAttributes extends \Magento\Framework\View\Element\Html\Select {

		/**
		 * Constructor
		 *
		 * @param \Magento\Framework\View\Element\Context $context
		 * @param array $data
		 */
		public function __construct(
		\Magento\Framework\View\Element\Context $context, array $data = []
		) {
			parent::__construct($context, $data);
		}

		public function getMagentoAttributes(){
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$coll = $objectManager->create(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection::class);
			$coll->addFieldToFilter(\Magento\Eav\Model\Entity\Attribute\Set::KEY_ENTITY_TYPE_ID, 4);
			$coll->setOrder('frontend_label','ASC');
			$attrAll = $coll->load()->getItems();

			foreach ($attrAll as $attribute) {
				$attribute = $attribute->getData();
				@$attributes[] = array(
					'frontend_label' => urlencode(($attribute['frontend_label']) ? $attribute['frontend_label'] : $attribute['attribute_code']),
					'attribute_code' => $attribute['attribute_code']
				);
			}

			return $attributes;
		}

		/**
		 * Render block HTML
		 *
		 * @return string
		 */
		public function _toHtml() {
			if (!$this->getOptions()) {
				foreach($this->getMagentoAttributes() as $attr){
					$this->addOption($attr['attribute_code'], $attr['frontend_label']);
				}
			}
			return parent::_toHtml();
		}

		/**
		 * Sets name for input element
		 *
		 * @param string $value
		 * @return $this
		 */
		public function setInputName($value) {
			return $this->setName($value);
		}

	}