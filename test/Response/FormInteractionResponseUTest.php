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
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
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

namespace WirecardTest\PaymentSdk\Response;

use Wirecard\PaymentSdk\Entity\FormFieldMap;
use Wirecard\PaymentSdk\Response\FormInteractionResponse;

class FormInteractionResponseUTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \SimpleXMLElement
     */
    private $simpleXml;

    private $url = 'https://www.example.com/redirect';

    /**
     * @var FormFieldMap
     */
    private $formFields;

    /**
     * @var FormInteractionResponse
     */
    private $response;

    public function setUp()
    {
        $this->formFields = $this->createMock(FormFieldMap::class);
        $this->simpleXml = simplexml_load_string('<raw>
                        <transaction-id>1-2-3</transaction-id>
                        <request-id>123</request-id>
                        <transaction-type>failed-transaction</transaction-type>
                        <statuses><status code="1" description="a" severity="0"></status></statuses>
                    </raw>');

        $this->response = new FormInteractionResponse(
            $this->simpleXml,
            $this->url
        );

        $this->response->setFormFields($this->formFields);
    }

    public function testGetRawResponse()
    {
        $this->assertEquals($this->simpleXml->asXml(), $this->response->getRawData());
    }

    public function testGetRedirectUrl()
    {
        $this->assertEquals($this->url, $this->response->getUrl());
    }

    public function testGetFormFields()
    {
        $this->assertEquals($this->formFields, $this->response->getFormFields());
    }

    public function testGetMethod()
    {
        $this->assertEquals('POST', $this->response->getMethod());
    }
}
