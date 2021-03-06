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
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

namespace WirecardTest\PaymentSdk\Entity;

use Wirecard\PaymentSdk\Entity\AccountHolder;
use Wirecard\PaymentSdk\Entity\Address;

class AccountHolderUTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AccountHolder
     */
    private $accountHolder;

    public function setUp()
    {
        $this->accountHolder = new AccountHolder();
    }

    public function testGetMappedPropertiesLastAndFirstName()
    {
        $firstName = 'Jane';
        $lastName = 'Doe';
        $this->accountHolder->setLastName($lastName);
        $this->accountHolder->setFirstName($firstName);

        $this->assertEquals(
            [
                'last-name' => $lastName,
                'first-name' => $firstName
            ],
            $this->accountHolder->mappedProperties()
        );
    }

    public function testGetMappedPropertiesLastNameAndEmail()
    {
        $email = 'Jane@doe.com';
        $this->accountHolder->setEmail($email);

        $this->assertEquals(
            [
                'email' => $email
            ],
            $this->accountHolder->mappedProperties()
        );
    }

    public function testGetMappedPropertiesLastNameAndPhone()
    {
        $phone = '+123 456 789';
        $this->accountHolder->setPhone($phone);

        $this->assertEquals(
            [
                'phone' => $phone
            ],
            $this->accountHolder->mappedProperties()
        );
    }

    public function testMappedPropertiesWithAddress()
    {
        $addr = new Address('AT', 'Graz', 'Reininghausstraße 13a');
        $addr->setPostalCode('8020');

        $this->accountHolder->setAddress($addr);

        $expectedResult = [
            'address' => [
                'street1' => 'Reininghausstraße 13a',
                'city' => 'Graz',
                'country' => 'AT',
                'postal-code' => '8020'
            ]
        ];

        $this->assertEquals($expectedResult, $this->accountHolder->mappedProperties());
    }

    public function testGetMappedPropertiesCrmId()
    {
        $crmId = '1243df';
        $this->accountHolder->setCrmId($crmId);

        $this->assertEquals(
            [
                'merchant-crm-id' => $crmId
            ],
            $this->accountHolder->mappedProperties()
        );
    }

    public function testGetMappedPropertiesDateOfBirth()
    {
        $dateOfBirth = new \DateTime('2016-01-01');
        $this->accountHolder->setDateOfBirth($dateOfBirth);

        $this->assertEquals(
            [
                'date-of-birth' => $dateOfBirth->format('d-m-Y')
            ],
            $this->accountHolder->mappedProperties()
        );
    }
}
