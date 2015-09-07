# WHMCS Flexible Invoice Fee Addon

This WHMCS addon module provides payment gateway dependent fee entry for invoices. It is flexible to configure for various situations.

## Installation

To install, simply download the latest [release](https://github.com/openfactory-ch/whmcs-flexibleinvoicefee-addon/releases), unzip it, and upload the `modules` folder to your WHMCS root directory.

Once uploaded, go to Setup > Addon Modules in your admin area and click Activate for the "OATH Flexible Invoice Fee" entry. Once activated, click Configure to customize your settings. Currently there is no need to set permission for any admin role, there are no advanced configurations yet.

## Workflow examples

### Postal invoice delivery

Assuming generated invoices for a specific gateway are sent automatically by postal delivery. You may like to have an automated fee for the costs to frank the mail. To achieve this, select your desired gateway module, the invoice item entry values and select only the "Track Invoice Create" checkbox. This way you cover these costs without automatically removing them if the customer decides to change the gateway for the future.

### Cover payment gateway fees

You can use this module to cover payment gateway dependent transaction fees and want the customer to cover them more or less. To achieve this, select your desired gateway module, the invoice item entry values and select all the "Track Invoice *" checkboxes. This way you cover these costs whenever payments are going to pay and are automatically removed when the invoice gateway is changed.

## Issues

Latest tested Release: WHMCS v6.0.2.

If you discover any issues or bugs, please report them on the [issue tracker](https://github.com/openfactory-ch/whmcs-flexibleinvoicefee-addon/issues).

### Known flaws

* The fee entry in the invoice item can not be translated
* The fee amount is fixed only currently, can't be made percental
* Only one gateway configurable (workaround: copy complete module folder and rename all prefixes and filenames to the new module name)
* Invoice status is not tracked, changes should be only made for unpaid invoices

## License

This module is licensed under GPLv3. See GPLv3.txt for complete license terms.
