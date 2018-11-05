<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('HOST','mysql02host.comp.dkit.ie');
define('USER','D00194503');
define('PASSWORD','&&95b1BB');
define('DATABASE','D00194503');

function DB()
{
    try{
        $db = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'',USER,PASSWORD);
        return $db;
    } catch (Exception $e) {
        echo $e->getMessage();
        return "Error! " . $e->getMessage();
    }
}
?>