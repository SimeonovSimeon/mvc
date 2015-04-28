<?php
class dbConnect {
    private static $dbConn;
    private static $host = 'localhost';
    private static $db = 'database_name';
    private static $user = 'user';
    private static $pass = 'password';
    
    public static function connect(){
       try {
           self::$dbConn = new PDO('mysql:host=localhost;dbname='.self::$db, self::$user, self::$pass);
           return self::$dbConn;
       } catch (PDOException $e) {
           echo 'Could not connect to the database '.$e->getMessage();
       }
    }
    
}