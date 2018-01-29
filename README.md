# CopeX_VatFix
## Magento2 module to enable VAT ID Validation with countrycodes (ex. ATU69932326) as usual in EU.
[![Latest Stable Version](https://poser.pugx.org/copex/vatfix/v/stable)](https://packagist.org/packages/copex/vatfix)
[![Total Downloads](https://poser.pugx.org/copex/vatfix/downloads)](https://packagist.org/packages/copex/vatfix)
[![Monthly Downloads](https://poser.pugx.org/copex/vatfix/d/monthly)](https://packagist.org/packages/copex/vatfix)
[![Build Status](https://travis-ci.org/CopeX/CopeX_VatFix.svg?branch=master)](https://travis-ci.org/CopeX/CopeX_VatFix)

This extension for Magento2 changes the behaviour of VAT ID validation in Magento.

Magento2 can change a customers group regarding to a valid VAT ID. This feature is especially useful for companies within the EU.
There is a small issue in Magento2 (also Magento1) thus it is not possible to correctly validate a VAT ID where the country code is in it.
In Europe the VAT consists of 2 letters that represent the country and additional letters for the company identification.
This plugin changes the behaviour how Magento validates the VAT ID so a full VAT ID can be entered.
With this plugin it is possible to validate a VAT ID even for countries like Greece (ISO: GR, VAT: EL)
or the United Kingdom (ISO: GB, VAT: UK) where the declarations collide.
 
With this extension installed it enables Magento2 to accept VAT IDs (UID) with prepended countrycodes (ex. **AT**U69932326)for all european countries.
For all other countries the check stays the same. We use the original VIES Service to validate the given VAT ID / UID.



## Installation
Copy the folder to your Magento2 "app/code" directory
or install via composer
```composer require copex/vatfix```

after that enable the plugin by:

```bin/magento module:enable CopeX_VATFix```

followed by 
```bin/magento setup:upgrade```

followed by
```bin/magento setup:di:compile```



## Workflow
When a customer saves a vat number:
1. the plugin takes the given string 
2. validates the country code if it is a valid EU country code defined in ISO-3166-Alpha-2-Code
3. if it is valid, it changes the parameter for original method of magento.
4. magento sends the validation-request to the VIES-Service and the normal workflow of magento is executed

## Information
This extension is a plugin, it will work out of the box when it is installed correctly. 
There are no settings in the backend.

## Demonstration
[I made a Demonstration Video here](https://www.youtube.com/watch?v=wSgHk4Wq7pA)

Author: Roman Hutterer  
Website: [CopeX eCommerce Solutions](https://copex.io)
