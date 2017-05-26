# CopeX_VatFix
## Magento2 module enable UID Validation with countrycodes (ex. ATU69932326) as usual in EU.
[![Latest Stable Version](https://poser.pugx.org/copex/vatfix/v/stable)](https://packagist.org/packages/copex/vatfix)
[![Total Downloads](https://poser.pugx.org/copex/vatfix/downloads)](https://packagist.org/packages/copex/vatfix)
[![Monthly Downloads](https://poser.pugx.org/copex/vatfix/d/monthly)](https://packagist.org/packages/copex/vatfix)
[![Build Status](https://travis-ci.org/CopeX/CopeX_VatFix.svg?branch=master)](https://travis-ci.org/CopeX/CopeX_VatFix)

This extension for Magento2 changes the behaviour of VAT validation in Magento. 

Magento2 can change a customers customergroup regarding a valid VAT. This feature is useful but cannot used by european companies because Magento2 (also Magento1) 
cannot handle VAT's with country code in it but this is usual in all countries of the EU. With this Plugin installed the feature "nable Automatic Assignment to Customer Group" 
can be enabled and so the customers will be assigned to the configured customergroup.
 
With this extension installed it allows Magento2 to accept VAT (UID) with prepended countrycodes (ex. **AT**U69932326)for all european countries.
For all other countries the check stays the same. It uses the original VIES Service to validate the given VAT / UID.



## Installation
Copy the folder to your Magento2 "app/code" directory and run   
```bin/magento setup:upgrade```

or via composer     
```composer require copex/vatfix```


## Workflow
When a customer saves a vat number:
1. the plugin takes the given string 
2. validates the country code if it is a valid EU country code defined in ISO-3166-Alpha-2-Code
3. if it is valid, it changes the parameter for original method of magento.
4. magento sends the validation-requrest to the VIES-Service and the normal workflow of magento is executed

##Information
This extension is a plugin, it will work out of the box when it is installed correctly. 
There are no settings for it to work.

## Demonstration
[I made a Demonstration Video here](https://www.youtube.com/watch?v=wSgHk4Wq7pA)

Author: Roman Hutterer  
Website: [CopeX eCommerce Solutions](https://copex.io)
