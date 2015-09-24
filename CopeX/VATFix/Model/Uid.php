<?php

use Magento\Customer\Model\Vat;

class Uid extends Vat {

    protected $_helper;

    public function __construct() {
        $object_manager = \Magento\Core\Model\ObjectManager::getInstance();
        $helper_factory = $object_manager->get( '\Magento\Core\Model\Factory\Helper' );
        $this->_helper = $helper_factory->get( '\CopeX\VATFix\Helper\Data' );
    }

    public function beforeCheckVatNumber() {
        
    }

    public function checkVatNumber( $countryCode, $vatNumber, $requesterCountryCode = '', $requesterVatNumber = '' ) {
        // Default response


        $gatewayResponse = new \Magento\Framework\Object(
            [ 'is_valid' => false, 'request_date' => '', 'request_identifier' => '', 'request_success' => false ]
        );

        if (!extension_loaded( 'soap' )) {
            $this->logger->critical(
                new \Magento\Framework\Exception\LocalizedException(
                    __( 'PHP SOAP extension is required.' )
                )
            );
            return $gatewayResponse;
        }

        if (!$this->canCheckVatNumber( $countryCode, $vatNumber, $requesterCountryCode, $requesterVatNumber )) {
            return $gatewayResponse;
        }

        try {
            $soapClient = $this->createVatNumberValidationSoapClient();

            $requestParams = [ ];

            $requestParams['countryCode'] = $countryCode;
            $requestParams['vatNumber'] = str_replace( [ ' ', '-' ], [ '', '' ], $vatNumber );
            $requestParams['requesterCountryCode'] = $requesterCountryCode;
            $requestParams['requesterVatNumber'] = str_replace( [ ' ', '-' ], [ '', '' ], $requesterVatNumber );

            // Send request to service
            $result = $soapClient->checkVatApprox( $requestParams );

            $gatewayResponse->setIsValid( (bool)$result->valid );
            $gatewayResponse->setRequestDate( (string)$result->requestDate );
            $gatewayResponse->setRequestIdentifier( (string)$result->requestIdentifier );
            $gatewayResponse->setRequestSuccess( true );
        } catch (\Exception $exception) {
            $gatewayResponse->setIsValid( false );
            $gatewayResponse->setRequestDate( '' );
            $gatewayResponse->setRequestIdentifier( '' );
        }

        return $gatewayResponse;
    }
}