<?php
if(!defined("WHMCS")) {
	die("This file cannot be accessed directly");
}

function flexibleinvoicefee_config() {
	$paymentmethods = localAPI('getpaymentmethods');
	$paymentlist = array();
	foreach($paymentmethods['paymentmethods']['paymentmethod'] as $paymentmethod) {
		$paymentlist[] = $paymentmethod['module'];
	}
	return array (
		"name" => "Flexible Invoice Fee",
		"description" => "Provides payment gateway dependent fee entry for invoices",
		"version" => "1.0.0",
		"author" => "openfactory-ch",
		"fields" => array (
			"gateway" => array("FriendlyName" => "Select Gateway", "Type" => "dropdown", "Options" => implode(',', $paymentlist), "Description" => "Select gateway to keep track of for invoices"),
			"name" => array("FriendlyName" => "Entry Description", "Type" => "text", "Description" => "Enter your desired text which will be added to the invoice (MUST BE UNIQUE to all possible item entries)"),
			"amount" => array("FriendlyName" => "Entry Amount", "Type" => "text", "Description" => "Enter your desired fixed amount which will be added to the invoice"),
			"istaxed" => array("FriendlyName" => "Entry Taxed?", "Type" => "yesno", "Description" => "Check this if your entry should be taxed"),
			"oncreate" => array("FriendlyName" => "Track Invoice Create?", "Type" => "yesno", "Description" => "Apply fee on invoice creation (is done before sending mail)"),
			"onchangeto" => array("FriendlyName" => "Track Invoice Change To?", "Type" => "yesno", "Description" => "Apply fee on payment gateway changes to the selected gateway on invoices"),
			"onchangeaway" => array("FriendlyName" => "Track Invoice Change Away?", "Type" => "yesno", "Description" => "Remove fee on payment gateway changes away from the selected gateway on invoices")
		)
	);
}