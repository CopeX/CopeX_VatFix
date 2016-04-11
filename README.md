# CopeX_VatFix
##Magento2 module enable UID Validation with countrycodes (ex. ATU69932326) as usual in EU.

This extension for Magento2 changes the behaviour of VAT validation in Magento. 
With this extension installed it allows the Magento2 to accept VAT (UID) with prepended countrycodes (ex. **AT**U69932326)for all european countries.
For all other countries the check stays the same. It uses the original VIES Service to validate the given VAT / UID.


##Installation
Copy the folder to your Magento2 "app/code" directory and run   
```bin/magento setup:upgrade```

##Workflow
When a customer saves a vat number:
1. the plugin takes the given string 
2. validates the country code if it is a valid EU country code defined in ISO-3166-Alpha-2-Code
3. if it is valid, it changes the parameter for original method of magento.
4. magento sends the validation-requrest to the VIES-Service and the normal workflow of magento is executed

##Information
This extension is a plugin, it will work out of the box when it is installed correctly. 
There are no settings for it to work.


Author: Roman Hutterer  
Website: [CopeX eCommerce Solutions](https://copex.io)