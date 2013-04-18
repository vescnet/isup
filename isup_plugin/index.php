<?php
header("access-control-allow-origin: *");

function Visit ( $url ) {
        $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();

        curl_setopt ($ch, CURLOPT_URL,$url );
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch,CURLOPT_VERBOSE,false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $page=curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if($httpcode>=200 && $httpcode<400) return true;

        else return false;
}

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
        if ( Visit($_GET["site"]) ) {
                echo "true";
        } else {
                echo "false";
        }
}

?>
