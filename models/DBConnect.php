<?php
namespace Models;
class DBConnect{
	//const HOST = 'mgdb1.agu.edu.vn';
	const DB_HOST = 'localhost';
	const DB_PORT = 27017;
	const DB_NAME = 'BLU_HSMC';
	//const USERNAME = 'root';
	//const PASSWORD = 'root';
	//private static $instance;
	//public $connection;
	//public $database;
	/*private function __construct(){
		//$connectionString = sprintf('mongodb://%s:%s@%s:%d',DBConnect::USERNAME, DBConnect::PASSWORD, DBConnect::HOST, DBConnect::PORT);
		$connectionString = sprintf('mongodb://%s:%d', DBConnect::HOST, DBConnect::PORT);
		try {
			$this->connection = new MongoClient($connectionString);
			$this->database = $this->connection->selectDB(DBConnect::DBNAME);
		} catch (MongoConnectionException $e) { throw $e; }
	}
	static public function init() {
		if (!isset(self::$instance)) {
			$class = __CLASS__;
			self::$instance = new $class;
		}
		return self::$instance;
	}

	public function getCollection($name) {
		return $this->database->selectCollection($name);
	}*/
		public static function getDB(){
      static $db = null;
      if ($db === null) {
          //$dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
          //$db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
          $dns = 'mongodb://'.DBConnect::DB_HOST.':'.DBConnect::DB_PORT;
          // Throw an Exception when an error occurs
          //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $db = new \MongoDB\Client($dns);
          $db = $db->{DBConnect::DB_NAME};
      }
      return $db;
    }

		public static function ObjectId($id){
			return new \MongoDB\BSON\ObjectId($id);
		}
		public static function Id(){
      return new \MongoDB\BSON\ObjectId();
    }

		public static function setDate(){
      $tz = new \DateTimeZone('Asia/Ho_Chi_minh'); //Change your timezone
      $date = date("Y-m-d h:i:s");
      $a = new \MongoDB\BSON\UTCDateTime(strtotime($date)*1000);
      return $a;
    }

    public static function getDate($date, $format){
      $tz = new \DateTimeZone('Asia/Ho_Chi_minh'); //Change your timezone
      //$date = date("Y-m-d h:i:sa");
      $a = new \MongoDB\BSON\UTCDateTime(strval($date));
      $datetime = $a->toDateTime();
      $datetime->setTimezone($tz);
      $time=$datetime->format($format);
      return $time;
    }

		public static function convertDate($str){
      $str_date = '';
      $a = explode(" ", $str);
      $b = explode("/", $a[0]);
      $str_date = $b[2].'-'.$b[1].'-'.$b[0];
      $tz = new \DateTimeZone('Asia/Ho_Chi_Minh'); //Change your timezone
      $date = new \MongoDB\BSON\UTCDateTime(strtotime($str_date)*1000);
      return $date;
    }
}

?>
