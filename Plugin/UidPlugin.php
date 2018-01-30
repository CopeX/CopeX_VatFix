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

namespace CopeX\VATFix\Plugin;

use Magento\Framework\Exception\ValidatorException;
use Magento\Customer\Model\Vat;
use Magento\Framework\Message\MessageInterface;

class UidPlugin
{
    private $helper;

    /**
     * @param \CopeX\VATFix\Helper\Data $helper
     */
    public function __construct(
        \CopeX\VATFix\Helper\Data $helper,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->helper = $helper;
        $this->_messageManager = $messageManager;
    }

    /**
     * @param \Magento\Customer\Model\Vat $subject
     * @param                             $countryCode
     * @param                             $vatNumber
     * @param string                      $requesterCountryCode
     * @param string                      $requesterVatNumber
     * @return array
     */
    public function beforeCheckVatNumber(
        Vat $subject,
        $countryCode,
        $vatNumber,
        $requesterCountryCode = '',
        $requesterVatNumber = ''
    ) {
        $countryCodeFromVAT = $this->helper->getCountryCodeFromVAT($vatNumber);
        if (!empty($vatNumber) && !is_numeric($countryCodeFromVAT) && $countryCode != $countryCodeFromVAT) {
            $this->addErrorMessage(__('Your selected country does not match the countrycode in VAT.'));
            return [];
        }
        $newVatNumber = $vatNumber;
        $newRequesterVatNumber = $requesterVatNumber;
        if ($requesterVatNumber !== '' && $this->helper->isCountryCodeInVAT($requesterVatNumber)) {
            $newRequesterVatNumber = substr(str_replace(' ', '', trim($requesterVatNumber)), 2);
        }

        if ($this->helper->isCountryCodeInVAT($newVatNumber)) {
            $newVatNumber = substr(str_replace(' ', '', trim($vatNumber)), 2);
        }
        return [$countryCode, $newVatNumber, $requesterCountryCode, $newRequesterVatNumber];
    }

    /**
     * @param string $errorMsg
     * @return bool
     */
    private function addErrorMessage($errorMsg)
    {
        foreach ($this->_messageManager->getMessages() as $message) {
            /** @var MessageInterface $message */
            if ($message->getText() === $errorMsg) {
                return false;
            }
        }

        $this->_messageManager->addError($errorMsg);
        return true;
    }
}
