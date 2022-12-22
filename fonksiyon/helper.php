<?php
function getFonksiyonu($getFonksiyonu){

    if (isset($_GET[$getFonksiyonu])){
        return trim($_GET[$getFonksiyonu]);
    }else{
        return false;
    }
}

function postFonksiyonu($postFonksiyonu){

    if (isset($_POST[$postFonksiyonu])){
        return trim($_POST[$postFonksiyonu]);
    }else{
        return false;
    }
}

function sessionFonksiyonu($sessionFonksiyonu){

    if (isset($_SESSION[$sessionFonksiyonu])){
        return trim($_SESSION[$sessionFonksiyonu]);
    }else{
        return false;
    }
}

function cookieFonksiyonu($cookieFonksiyonu){

    if (isset($_COOKIE[$cookieFonksiyonu])){
        return trim($_COOKIE[$cookieFonksiyonu]);
    }else{
        return false;
    }
}
?>