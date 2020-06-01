<?php
function validateLogin()
{
    if($_SESSION["login"])
    {
        return true;
    }
    else
        return false;
}

function login($user,$password)
{
    $pass = encrypt($password);
    $where = "usuario = '".$user."' AND password ='".$pass."'";
    $result=query("users","*",$where,false);
    if($result)
    {
        $_SESSION["userLog"]=$result[0];
        $_SESSION["login"]=true;
        return true;
    }
    else
    {
        return false;
    }
}

function logout()
{
    session_destroy();
    $_SESSION["login"]=false;
    $_SESSION["userLog"]=$result[0];
    return true;
}

function encriptar($cadena){
    $key='triviafabricademedios';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted;
}

function decrypt($string, $key) {
    $key = "sdfvdbcvbgbnfgngnfhnregdasfs";
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
       $char = substr($string, $i, 1);
       $keychar = substr($key, ($i % strlen($key))-1, 1);
       $char = chr(ord($char)-ord($keychar));
       $result.=$char;
    }
    return $result;
 }
function encrypt($string) {
    $key = "sdfvdbcvbgbnfgngnfhnregdasfs";
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
       $char = substr($string, $i, 1);
       $keychar = substr($key, ($i % strlen($key))-1, 1);
       $char = chr(ord($char)+ord($keychar));
       $result.=$char;
    }
    return base64_encode($result);
 }
?>