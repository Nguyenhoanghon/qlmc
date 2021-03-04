<?php
namespace Models;
class Users{
	const COLLECTION = 'users';
	public $id = '';
	public $username = '';
	public $password = '';
	public $roles = array();
	public $person = '';
	public $id_tieuchuan = '';

	private $_mongo;
	private $_collection;
	private $_user;

	public function __construct(){
		$this->_mongodb = DBConnect::getDB();
		$this->_collection = $this->_mongodb->{Users::COLLECTION};
		if ($this->isLoggedIn()) $this->_loadData();
	}

	public function get_list(){
		return $this->_collection->find();
	}

	public function get_list_50(){
		return $this->_collection->find(array(), array('limit' => 50));//->limit(50);
	}

	public function get_one(){
		$query = array('_id'=> DBConnect::ObjectId($this->id));
		return $this->_collection->findOne($query);
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition);
	}

	public function get_one_default(){
		$id_user = $this->get_userid();
		return $this->_collection->findOne(array('_id'=>DBConnect::ObjectId($id_user)));
	}

	public function check_exist_username(){
		$query = array('username'=> $this->username);
		$result = $this->_collection->findOne($query);
		if($result['_id']) return true;
		return false;
	}

	public function insert(){
		$query = array(
			'username'=> $this->username,
			'password'=>md5($this->password),
			'roles' => $this->roles,
			'person' => $this->person,
			'id_tieuchuan' => $this->id_tieuchuan,
			'date_post' => DBConnect::setDate()
		);
		return $this->_collection->insertOne($query);
	}

	public function edit(){
		$condition = array('_id'=> DBConnect::ObjectId($this->id));
		$query = array('$set' => array(
			'username'=> $this->username,
			'password'=>md5($this->password),
			'roles'=>$this->roles,
			'person'=>$this->person,
			'id_tieuchuan'=>$this->id_tieuchuan,
			'date_update' => DBConnect::setDate()
		));
		return $this->_collection->updateOne($condition, $query);
	}

	public function reset_password(){
		$condition = array('_id' => DBConnect::ObjectId($this->id));
		$query = array('$set' => array('password' => md5($this->password)));
		return $this->_collection->updateOne($condition, $query);
	}

	public function delete(){
		return $this->_collection->deleteOne(array('_id'=> DBConnect::ObjectId($this->id)));
	}

	//public function insert_list(){

	//}

	public function isLoggedIn() {
		return isset($_SESSION['user_id']);
	}

	public function getRole(){
		return $_SESSION['roles'];
	}

	public function get_username(){
		$result = $this->_collection->findOne(array("_id"=>DBConnect::ObjectId($_SESSION['user_id'])), array('username'=>true));
		return $result['username'];
	}

	public function get_userid(){
		return $_SESSION['user_id'];
	}

	public function authenticate($username, $password){
		$query = array(
			'username' => $username,
			'password' => md5($password)
		);

		$this->_user = $this->_collection->findOne($query);
		if (empty($this->_user)) return false;
			$_SESSION['user_id'] = (string) $this->_user['_id'];
			$_SESSION['roles'] = $this->_user['roles'];
			return true;
	}

	public function logout(){
		unset($_SESSION['user_id']);
		session_destroy();
	}

	private function _loadData() {
		$id = DBConnect::ObjectId($_SESSION['user_id']);
		$this->_user = $this->_collection->findOne(array('_id' => $id));
	}

	public function is_admin(){
		$roles = iterator_to_array($_SESSION['roles']);
		return in_array('ADMIN', $roles);
	}

	public function is_manager(){
		$roles = iterator_to_array($_SESSION['roles']);
		return in_array('MANAGER', $roles);
	}

	public function is_updater(){
		$roles = iterator_to_array($_SESSION['roles']);
		return in_array('TEACHER', $roles);
	}

	public function is_role($role){
		$roles = iterator_to_array($_SESSION['roles']);
		return in_array($role, $roles);
	}

	public static function isRole($role){
		$roles = iterator_to_array($_SESSION['roles']);
		return in_array($role, $roles);
	}
}

?>
