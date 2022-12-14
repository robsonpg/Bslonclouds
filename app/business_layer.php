<?php

// ####################################################################
// Biblioteca utilizada

//#####################################################################
// Retorna o IP do visitante
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//#####################################################################
// Retorna o pais do visitante
function getVisitorCountry()
{
    $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".getRealIpAddr());
    $country = $xml->geoplugin_countryName ;

    return $country;
}

function saveVisitorInfo() {
    logger(1,"VisitorInfo","Visitor from " . getVisitorCountry() . ".");
}
