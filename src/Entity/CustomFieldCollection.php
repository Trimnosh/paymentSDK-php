<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern Europe GmbH
 * (abbreviated to Wirecard CEE) and are explicitly not part of the Wirecard CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 3 (GPLv3) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard CEE does not guarantee their full
 * functionality neither does Wirecard CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Wirecard CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

namespace Wirecard\PaymentSdk\Entity;

use Traversable;

/**
 * Class CustomFieldCollection
 * @package Wirecard\PaymentSdk\Entity
 */
class CustomFieldCollection implements \IteratorAggregate, MappableEntity
{
    /**
     * @var array
     */
    private $customFields = [];

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->customFields);
    }

    /**
     * @param CustomField $customField
     * @return $this
     */
    public function add(CustomField $customField)
    {
        $this->customFields[] = $customField;

        return $this;
    }

    /**
     * @param string $fieldName
     * @return CustomField|null
     */
    protected function getFieldByName($fieldName)
    {
        /** @var CustomField $customField */
        foreach ($this->getIterator() as $customField) {
            if ($customField->getName() === $fieldName) {
                return $customField;
            }
        }
        return null;
    }

    /**
     * @param string $fieldName
     * @return string|null
     */
    public function get($fieldName)
    {
        $field = $this->getFieldByName($fieldName);
        if ($field !== null) {
            return $field->getValue();
        }
        return null;
    }

    /**
     * @return array
     */
    public function mappedProperties()
    {
        $data = ['custom-field' => []];

        /**
         * @var CustomField $customField
         */
        foreach ($this->getIterator() as $customField) {
            $data['custom-field'][] = $customField->mappedProperties();
        }

        return $data;
    }
}
