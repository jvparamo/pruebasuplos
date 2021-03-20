<?php
require_once 'config/connection.php';
class Conect
{
    public  static function connection()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=intelcost_bienes;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}