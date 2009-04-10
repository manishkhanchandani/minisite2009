<?php
// http://curl.phptrack.com
// PHP/CURL FTP upload to a remote site
// Copyright imran@phptrack.com
$ftp_url = "ftp://id:password@phptrack.com/public_html/cu/dt.jpg";
$file_to_upload_path = realpath("product.jpg");
$file_size = filesize($file_to_upload_path);
$fp = fopen($file_to_upload_path,'rb');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ftp_url);
curl_setopt($ch, CURLOPT_UPLOAD, 1);
curl_setopt($ch, CURLOPT_INFILE, $fp);
curl_setopt($ch, CURLOPT_INFILESIZE, $file_size);
$result = curl_exec ($ch);
curl_close ($ch);
print $result;
?>