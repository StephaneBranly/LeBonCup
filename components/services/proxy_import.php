<?php
    
    include('../../lib/start_session.php');
    class Ad{

    }
    class Response{

    }
    $response = new Response;
    $ad = new Ad;
    $response->ad = $ad;

    if(secure_session('connected'))
    {
      

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json');
        $url = secure_get('url');
        $ch = curl_init();

        $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection: keep-alive";
        $header[] = "Keep-Alive: 300";
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[] = "Access-Control-Allow-Origin: *";
        $header[] = "Accept-Language: en-us,en;q=0.5";
        $header[] = "Pragma: "; //browsers keep this blank.
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'LeBoncup, asso étudiante (https://assos.utc.fr/leboncup/)');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec ($ch);
        curl_close($ch);

        $patternVinted = "/^https?:\/\/www.vinted/i";
        if(preg_match($patternVinted, $url))
        {   
            $ad->importedFrom = "Vinted";
            $ad->description = "";
            $ad->title = "";
            $ad->price = "";

            $pattern = "/property=\"og:description\" content=\"([^\/]*)\"/i";
            if(preg_match($pattern, $result, $description))
            $ad->description = $description[1]."\n\nAnnonce importée de Vinted - ($url)";

            $pattern = "/property=\"og:price:amount\" content=\"([^\/]*)\"/i";
            if(preg_match($pattern, $result, $price))
            $ad->price = $price[1];

            $pattern = "/property=\"og:title\" content=\"([^\/]*)\"/i";
            if(preg_match($pattern, $result, $title))
            $ad->title = $title[1];

            $response->status="OK";
        }
        else
        {
            $response->status="KO_unvalide_website";
        }
    }
    else
    {
        $response->status="KO_unvalide_website";
    }
    
    $jsonData = json_encode($response);
    echo $jsonData."\n";
    
?>