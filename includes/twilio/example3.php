<?php
	/* Include the PHP TwilioRest library */
	require "twiliorest.php";
	
	/* Twilio REST API version */
	$ApiVersion = "2008-08-01";
	
	/* Set our AccountSid and AuthToken */
	$AccountSid = "AC94b06e556ff5dc4047cf5599522ff470";
	$AuthToken = "4a11eb43a9ab1c1eeaa7d2db067daf73";

	/* Outgoing Caller ID you have previously validated with Twilio */
	$CallerID = '919-386-1678';
	
	/* Instantiate a new Twilio Rest Client */
	$client = new TwilioRestClient($AccountSid, $AuthToken);
	
	/* The main method of the TwilioRestClient object is the request method.  Here's it's signature:
	 * 		request($urlPath, $httpMethod = 'GET', $parameters = array())
	 * 			
	 * 			$urlPath: the REST URL path, everything after https://api.twilio.com/$ApiVersion
	 * 			$httpMethod: which HTTP method to use, defaults to GET.  Depending on the operation, may be GET, POST, PUT or DELETE
	 * 			$parameters: for PUT or POST methods, you'll often need to pass data to the resource via this associative array
	 */
	
	/****************************************************************************************
	 * Initiate a new outbound call
	 * 		Is a POST to the Calls resource
	 * 		Returns a TwilioRestResponse object
	 ****************************************************************************************/
	$response = $client->request("/$ApiVersion/Accounts/$AccountSid/Calls", "POST", array(
		"Caller" => $CallerID, 	// Outgoing Caller ID you have previously validated with Twilio
		"Called" => "919-386-1678",		// The phone number you wish to dial
		"Url" => "http://10000projects.info/call.php?msg=Mummy+Mummy+i+want+a+game+and+my+name+is+manish+khanchandani." 		// the URL of the web application on your server that will handle the call when it connects
	));
	
	// check response for success or error
	if($response->IsError)
		echo "Error starting phone call: {$response->ErrorMessage}\n";
	else
		echo "Started call: {$response->ResponseXml->Call->Sid}\n";
?>