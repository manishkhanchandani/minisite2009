<?php
// Example 009
// HTTPS (SSL Pages)
// Copyright http://curl.phptrack.com
$url = "https://your_Secure_site.com/login.php"; // URL
$POSTFIELDS = 'name=admin&password=guest&submit=save';
$reffer = "https://your_Secure_site.com/index.php";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
$cookie_file_path = "C:/Inetpub/wwwroot/spiders/cookie/cook"; // Please set your Cookie File path. This file must have CHMOD 777 (Full Read / Write Option).
$ch = curl_init(); // Initialize a CURL session.
curl_setopt($ch, CURLOPT_URL, $url); // The URL to fetch. You can also
set this when initializing a session with curl_init().
curl_setopt($ch, CURLOPT_USERAGENT, $agent); // The contents of the "User-Agent: " header to be used in a HTTP request.
curl_setopt($ch, CURLOPT_POST, 1); //TRUE to do a regular HTTP POST. This POST is the normal application/x-www-form-urlencoded kind, most commonly used by HTML forms.
curl_setopt($ch, CURLOPT_POSTFIELDS,$POSTFIELDS); //The full data to postin a HTTP "POST" operation.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // TRUE to follow any "Location: " header that the server sends as part of the HTTP header (note this is recursive, PHP will follow as many "Location: " headers that it is sent, unless CURLOPT_MAXREDIRS is set).
curl_setopt($ch, CURLOPT_REFERER, $reffer); //The contents of the "Referer: " header to be used in a HTTP request.
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path); // The name of the file containing the cookie data. The cookie file can be in Netscape format, or just plain HTTP-style headers dumped into a file.
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); // The name of a file to save all internal cookies to when the connection closes.
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //FALSE to stop CURL from verifying the peer's certificate. Alternate certificates to verify against can be specified with the CURLOPT_CAINFO option or a certificate directory can be specified with the CURLOPT_CAPATH option. CURLOPT_SSL_VERIFYHOST may also need to be TRUE or FALSE if CURLOPT_SSL_VERIFYPEER is disabled (it defaults to 2). TRUE by default as of CURL 7.10. Default bundle installed as of CURL 7.10. 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 1 to check the existence of a common name in the SSL peer certificate. 2 to check the existence of a common name and also verify that it matches the hostname provided.
$result = curl_exec($ch); // grab URL and pass it to the variable.
curl_close($ch); // close curl resource, and free up system resources.
echo $result; // Print page contents.
?>