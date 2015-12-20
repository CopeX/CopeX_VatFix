<?php

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