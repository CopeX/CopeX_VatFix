<?php
/**
 * @copyright Roman Hutterer CopeX Gmbh
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace CopeX\VATFix\Plugin;

class UidPlugin
{
    protected $_helper;

    /**
     * @param \CopeX\VATFix\Helper\Data $helper
     */
    public function __construct(\CopeX\VATFix\Helper\Data $helper)
    {
        $this->_helper = $helper;
    }

    /**
     * @param \Magento\Customer\Model\Vat $subject
     * @param $countryCode
     * @param $vatNumber
     * @param string $requesterCountryCode
     * @param string $requesterVatNumber
     * @return array
     */
    public function beforeCheckVatNumber(\Magento\Customer\Model\Vat $subject, $countryCode, $vatNumber, $requesterCountryCode = '', $requesterVatNumber = '')
    {
        $newVatNumber = $vatNumber;
        $newRequesterVatNumber = $requesterVatNumber;

        if ($requesterVatNumber !== '' && $this->_helper->isCountryCodeInVAT($requesterVatNumber)) {
            $newRequesterVatNumber = substr(str_replace(' ', '', trim($requesterVatNumber)), 2);
        }


        if ($this->_helper->isCountryCodeInVAT($newVatNumber)) {
            $newVatNumber = substr(str_replace(' ', '', trim($vatNumber)), 2);
        }
        return array($countryCode, $newVatNumber, $requesterCountryCode, $newRequesterVatNumber);
    }


}