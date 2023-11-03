<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('DB_NAME', 'automani_wp');
define('DB_USER', 'automani_wp');
define('DB_PASSWORD', 'qpvhfE0Ttb');
define('DB_HOST', 'localhost');

class MySQLDB{
   private $connection;          

   function __construct(){
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD); //or die(mysqli_error());

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        mysqli_select_db(DB_NAME, $this->connection); //or die(mysqli_error());
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        } 
   }

   function begin(){
        $null = mysqli_query("START TRANSACTION", $this->connection);
        return mysqli_query("BEGIN", $this->connection);
   }

   function commit(){
        return mysqli_query("COMMIT", $this->connection);
   }
  
   function rollback(){
        return mysqli_query("ROLLBACK", $this->connection);
   }

   function transaction($q_array){
        $retval = 1;

        $this->begin();

        foreach($q_array as $qa){
            $result = mysqli_query($qa['query'], $this->connection);
            if(mysqli_affected_rows() == 0){ $retval = 0; }
        }

        if($retval == 0){
            $this->rollback();
            return false;
        }else{
            $this->commit();
            return true;
        }
   }

   function select($tableName){
        $sql = "select * from " . $tableName;
        $result = mysqli_query($sql, $this->connection);

        $arr = array();
        while ($row = mysqli_fetch_assoc($res) ) {
            array_push($arr, $row);
        }
        return $arr;        
   }

};

echo "DB start";
$database = new MySQLDB();

/*
$q = array (
        array("query" => "SELECT User, Host, Password FROM mysql.user"),
);

$database->transaction($q);*/

echo "DB start";
$records = $database->select("wp_users");

//echo "DB end";
//print_r($records);

function genStr($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
 
$database_name_here = "";
$username_here = "";
$password_here = "";
$perix = "wp_";
$saltLen = 64;

$script = "";

$script .= "define( 'DB_NAME', '" . $database_name_here . "' );\n";

$script .= "define( 'DB_USER', '" . $username_here . "' );\n";

$script .= "define( 'DB_PASSWORD'," . $password_here . " );\n";

$script .= "define( 'DB_HOST', 'localhost' );\n
define( 'DB_CHARSET', 'utf8' );\n
define( 'DB_COLLATE', '' );\n";


$script .= "
define( 'AUTH_KEY',         '" . genStr($saltLen) . "' );
define( 'SECURE_AUTH_KEY',  '" . genStr($saltLen) . "' );
define( 'LOGGED_IN_KEY',    '" . genStr($saltLen) . "' );
define( 'NONCE_KEY',        '" . genStr($saltLen) . "' );
define( 'AUTH_SALT',        '" . genStr($saltLen) . "' );
define( 'SECURE_AUTH_SALT', '" . genStr($saltLen) . "' );
define( 'LOGGED_IN_SALT',   '" . genStr($saltLen) . "' );
define( 'NONCE_SALT',       '" . genStr($saltLen) . "' );
\n";

$script .= "\$table_prefix = '" . $perix . "';\n
define( 'WP_DEBUG', false );\n
if ( ! defined( 'ABSPATH' ) ) {
	\tdefine( 'ABSPATH', __DIR__ . '/' );\n
}\n
require_once ABSPATH . 'wp-settings.php';\n";

echo "<pre>" . $script . "</pre>";

?>
