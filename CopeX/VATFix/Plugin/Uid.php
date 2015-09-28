<?php

namespace CopeX\VATFix\Plugin;

class Uid
{
    protected $_helper;
    protected $_logger;

    public function __construct(\CopeX\VATFix\Helper\Data $helper, \Psr\Log\LoggerInterface $logger)
    {
        $this->_helper = $helper;
        $this->_logger = $logger;
    }

    public function beforeCheckVatNumber($subject, $countryCode, $vatNumber, $requesterCountryCode = '', $requesterVatNumber = '')
    {
        $newVatNumber = $vatNumber;
        $newRequesterVatNumber = $requesterVatNumber;

        if ($requesterVatNumber !== '' && $this->_helper->isCountryCodeInVAT($requesterVatNumber)) {
            $newRequesterVatNumber = substr(str_replace(' ', '', trim($requesterVatNumber)), 2);
        }


        if ($this->_helper->isCountryCodeInVAT($newVatNumber)) {
            $newVatNumber = substr(str_replace(' ', '', trim($vatNumber)), 2);
            return array($countryCode, $newVatNumber, $requesterCountryCode, $newRequesterVatNumber);
        }
    }


}