<?php
if(!defined("WHMCS")) {
	die("This file cannot be accessed directly");
}

function flexibleinvoicefee_getconfig() {
	$res = select_query("tbladdonmodules", "setting, value", array("module" => basename(dirname(__FILE__))));
	$config = array();
	while($row = mysql_fetch_assoc($res)) {
		$config[$row['setting']] = $row['value'];
	}
	return $config;
}

function flexibleinvoicefee_oncreate($params) {
	$config = flexibleinvoicefee_getconfig();
	$invoice = localAPI('getinvoice', array('invoiceid' => $params['invoiceid']));

	if($config['oncreate'] == 'on' && $config['gateway'] == $invoice['paymentmethod']) {
		$update = localAPI('updateinvoice', array(
			'invoiceid' => $params['invoiceid'],
			'newitemdescription' => array($config['name']),
			'newitemamount' => array($config['amount']),
			'newitemtaxed' => array(($config['istaxed']? 1: 0))
		));
	}
}

function flexibleinvoicefee_onchange($params) {
	$config = flexibleinvoicefee_getconfig();
	$invoice = localAPI('getinvoice', array('invoiceid' => $params['invoiceid']));

	$hasfee = false;
	$linefee = 0;
	foreach($invoice['items']['item'] as $item) {
		if($item['description'] == $config['name']) {
			$hasfee = true;
			$linefee = $item['id'];
		}
	}

	if(!$hasfee && $config['onchangeto'] == 'on' && $config['gateway'] == $params['paymentmethod']) {
		$update = localAPI('updateinvoice', array(
			'invoiceid' => $params['invoiceid'],
			'newitemdescription' => array($config['name']),
			'newitemamount' => array($config['amount']),
			'newitemtaxed' => array(($config['istaxed']? 1: 0))
		));
	}

	if($hasfee && $config['onchangeaway'] == 'on' && $config['gateway'] != $params['paymentmethod']) {
		$update = localAPI('updateinvoice', array(
			'invoiceid' => $params['invoiceid'],
			'deletelineids' => array($linefee)
		));
	}
}

add_hook("InvoiceCreationPreEmail", 0, "flexibleinvoicefee_oncreate");
add_hook("InvoiceChangeGateway", 0, "flexibleinvoicefee_onchange");