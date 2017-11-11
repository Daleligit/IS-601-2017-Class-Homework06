<?php
    //Bug report massage
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    //autoload all classes
    class Manage {
        static public function autoload($class) {
            include './classes/' . $class . '.php';
        }
    }
    //register all loaded classes
    spl_autoload_register(array('Manage', 'autoload'));
    define('DATABASE', 'yl622');
    define('USERNAME', 'yl622');
    define('PASSWORD', 'evPkHDGVf');
    define('CONNECTION', 'sql2.njit.edu');
    $connErr = '';
    $sqlErr = '';
    $obj = new main();
?>