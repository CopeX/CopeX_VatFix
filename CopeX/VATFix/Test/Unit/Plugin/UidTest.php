<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.12.15
 * Time: 20:44
 */
use Magento\Framework\ObjectManager;
use Magento\TestFramework\ErrorLog;

/**
 * Class UidTest
 */
class UidTest extends PHPUnit_Framework_TestCase
{
    /**
     * test the behaviour of CopeX_VATFix which removes the countrycode from the given uid
     * @param $subject
     * @param $countryCode
     * @param $vatNumber
     * @param $returnedVat
     * @dataProvider dataProviderUidWithCountryCode
     */
    public function testUidWithCountryCode($countryCode, $vatNumber, $returnedVat)
    {
        $this->objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $vatHelper = $this->getMockBuilder('\CopeX\VATFix\Helper\Data')->getMock();
        $vatHelper->method('isCountryCodeInVAT')->willReturn(true);

        $vatModel = $this->objectManager->getObject('CopeX\VATFix\Plugin\Uid', ['helper' => $vatHelper]);

        $subject = $this->objectManager->getObject('\Magento\Customer\Model\Vat');

        $result = $vatModel->beforeCheckVatNumber($subject, $countryCode, $vatNumber);
        $this->assertEquals(array($countryCode, $returnedVat, '', ''), $result);

    }

    public function dataProviderUidWithCountryCode()
    {
        return [
            ['AT', 'ATU69932326', 'U69932326']
        ];
    }
}
