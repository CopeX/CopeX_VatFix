<?php
/**
 * @copyright Roman Hutterer CopeX Gmbh
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace CopeX\VATFix\Test\Unit\Plugin;

use Magento\Framework\ObjectManager;
use Magento\TestFramework\ErrorLog;


/**
 * Class UidTest
 */
class UidTest extends \PHPUnit\Framework\TestCase
{
    /**
     * test the behaviour of CopeX_VATFix which removes the countrycode from the given uid
     * @param $countryCode
     * @param $vatNumber
     * @param $returnedVat
     * @param $requesterCountryCode
     * @param $requesterVatNumber
     * @param $returnedRequesterVatNumber
     * @dataProvider dataProviderUidWithCountryCode
     */
    public function testUidWithCountryCode(
        $countryCode,
        $vatNumber,
        $returnedVat,
        $requesterCountryCode,
        $requesterVatNumber,
        $returnedRequesterVatNumber
    ) {
        $this->objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $vatHelper = $this->getMockBuilder('\CopeX\VATFix\Helper\Data')->getMock();
        $vatHelper->method('isCountryCodeInVAT')->willReturn(true);
        $vatHelper->method('getCountryCodeFromVAT')->willReturn($countryCode);

        $vatModel = $this->objectManager->getObject('CopeX\VATFix\Plugin\UidPlugin', ['helper' => $vatHelper]);

        $subject = $this->objectManager->getObject('\Magento\Customer\Model\Vat');

        $result = $vatModel->beforeCheckVatNumber(
            $subject,
            $countryCode,
            $vatNumber,
            $requesterCountryCode,
            $requesterVatNumber
        );
        $this->assertEquals(
            [
                $countryCode,
                $returnedVat,
                $requesterCountryCode,
                $returnedRequesterVatNumber,
            ],
            $result
        );
    }

    /**
     * @return array
     */
    public function dataProviderUidWithCountryCode()
    {
        return [
            ['AT', 'ATU69932326', 'U69932326', 'AT', 'ATU69932326', 'U69932326'],
        ];
    }
}
