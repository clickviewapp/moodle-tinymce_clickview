<?php
	require_once(dirname(__FILE__).'/schoolId.php');

	$param = '';

	if(! empty($SCHOOL_ID)) {
		$param = '&schoolId=' . $SCHOOL_ID->value;
	}
	
	unset($CFG_CLICKVIEW);
	
	$CFG_CLICKVIEW =  new stdClass();
	$CFG_CLICKVIEW->onlineHost = "//<~onlineHost~>";
	$CFG_CLICKVIEW->consumerKey = "<~consumerKey~>";
	$CFG_CLICKVIEW->pluginFrameUrl =  $CFG_CLICKVIEW->onlineHost."/v3/plugins/base?consumerKey=".$CFG_CLICKVIEW->consumerKey.$param;
