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
     * test the behaviour of CopeX_VATFix which removed the countrycode from the given uid
     * and the valoi
     * @param $subject
     * @param $countryCode
     * @param $vatNumber
     * @param $returnedVat
     * @dataProvider dataProviderUidWithCountryCode
     */
    public function testUidWithCountryCode($subject, $countryCode, $vatNumber, $returnedVat)
    {
        $vatModel = $this->getMockBuilder('CopeX\VATFix\Plugin\Uid')->setConstructorArgs(
            array(new \CopeX\VATFix\Helper\Data()))->getMock();

        $vatModel->method('beforeCheckVatNumber')->with($subject, $countryCode, $vatNumber)->willReturn($returnedVat);
        $this->assertEquals($returnedVat, $vatModel->beforeCheckVatNumber($subject, $countryCode, $vatNumber));

    }

    public function dataProviderUidWithCountryCode()
    {
        return [
            ['', 'AT', 'U69932326', 'U69932326'],
            ['', 'AT', 'ATU69932326', 'U69932326']
        ];
    }
}
