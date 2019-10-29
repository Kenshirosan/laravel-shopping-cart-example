<?php

function set_active($path, $active = 'active')
{
    return Request::is($path) || Request::is($path . '/*') ? $active : '';
}

function formatPhoneNumber($phone)
{
    $phone = preg_replace('/[^0-9]/','',$phone);

    if(strlen($phone) > 10) {
        $countryCode = substr($phone, 0, strlen($phone)-10);
        $areaCode = substr($phone, -10, 3);
        $nextThree = substr($phone, -7, 3);
        $lastFour = substr($phone, -4, 4);

        $phone = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phone) == 10) {
        $areaCode = substr($phone, 0, 3);
        $nextThree = substr($phone, 3, 3);
        $lastFour = substr($phone, 6, 4);

        $phone = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phone) == 7) {
        $nextThree = substr($phone, 0, 3);
        $lastFour = substr($phone, 3, 4);

        $phone = $nextThree.'-'.$lastFour;
    }

    return $phone;
}

function regex($items)
{
    return preg_replace('/[]:["]/', ' ', $items);
}