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
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

namespace WirecardTest\PaymentSdk\Entity;

use Wirecard\PaymentSdk\Entity\Item;
use Wirecard\PaymentSdk\Entity\Amount;

class ItemUTest extends \PHPUnit_Framework_TestCase
{
    const NAME = 'Item xsfgdgh';
    const QUANTITY = 1;

    /**
     * @var Amount
     */
    private $amount;

    /**
     * @var Item
     */
    private $item;

    public function setUp()
    {
        $this->amount = new Amount(1, 'EUR');
        $this->item = new Item(self::NAME, $this->amount, self::QUANTITY);
    }

    public function testMappedPropertiesOnlyRequiredProperties()
    {
        $expected = [
            'name' => self::NAME,
            'amount' => [
                'value' => '1',
                'currency' => 'EUR'
            ],
            'quantity' => self::QUANTITY,
        ];

        $this->assertEquals($expected, $this->item->mappedProperties());
    }

    public function testMappedPropertiesWithAllProperties()
    {
        $this->item->setTaxAmount(new Amount(0.1, 'EUR'));
        $this->item->setArticleNumber('1232f5445');
        $this->item->setDescription('dthfbvdfg');
        $this->item->setTaxRate('0.2');

        $expected = [
            'name' => self::NAME,
            'description' => 'dthfbvdfg',
            'article-number' => '1232f5445',
            'amount' => [
                'value' => '1',
                'currency' => 'EUR'
            ],
            'tax-amount' => [
                'value' => '0.1',
                'currency' => 'EUR'
            ],
            'quantity' => self::QUANTITY,
            'tax-rate' => '0.2'
        ];

        $this->assertEquals($expected, $this->item->mappedProperties());
    }
}
