<?php
//Define Dirpath for hooks
define('CAL_PATH', __DIR__);
/**
 * Plugin Name: Calculator
 * Version: 1.0
 * Description: 
 * Author: Asad Maqsood
 * Author URI: 
 * Plugin URI: 
 */

//Auto loading UserList and User class
require_once 'vendor/autoload.php';
$calculator = new Calculator();

$calculator->action_hooks();
