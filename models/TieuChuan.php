<?php
namespace Models;
class TieuChuan {
    const COLLECTION = 'tieuchuan';
    private $_mongodb;
    private $_collection;

    public $id = '';
    public $ma = '';
    public $ten = '';
    public $id_parent = '';
    public $mota = '';
    public $orders = 0;

    public function __construct(){
        $this->_mongodb = DBConnect::getDB();
        $this->_collection = $this->_mongodb->{TieuChuan::COLLECTION};
    }

    public function get_list_root(){
        $query = array('id_parent' => '');
        return $this->_collection->find($query)->toArray();
    }

    public function get_all_list(){
        return $this->_collection->find(array(), array('sort' => array('orders' => 1)))->toArray();
    }

    public function get_list_condition($condition){
        return $this->_collection->find($condition, array('sort' => array('orders' => 1)))->toArray();
    }

    public function get_one(){
        $query = array('_id' => DBConnect::ObjectId($this->id));
        return $this->_collection->findOne($query);
    }

    public function get_id_by_ma(){
        $query = array('ma' => trim($this->ma));
        $field = array('_id' => true);
        $result = $this->_collection->findOne($query, $field);
        if(isset($result['_id'])) return $result['_id'];
        else return false;
    }

    public function insert(){
        $query = array(
            'ma' => $this->ma,
            'ten' => $this->ten,
            'id_parent' => $this->id_parent ? DBConnect::ObjectId($this->id_parent) : '',
            'mota' => $this->mota,
            'orders' => intval($this->orders)
        );
        return $this->_collection->insertOne($query);
    }

    public function edit(){
        $query = array('$set' => array(
            'ma' => $this->ma,
            'ten' => $this->ten,
            'id_parent' => $this->id_parent ? DBConnect::ObjectId($this->id_parent) : '',
            'mota' => $this->mota,
            'orders' => intval($this->orders)));
        $condition = array('_id' => DBConnect::ObjectId($this->id));
        return $this->_collection->updateOne($condition, $query);
    }

    public function delete(){
        $query = array('_id' => DBConnect::ObjectId($this->id));
        return $this->_collection->deleteOne($query);
    }

    public function check_dmdonvi($id_parent){
        $query = array('id_parent' => $id_parent ? DBConnect::ObjectId($id_parent) : '');
        //$field = array('_id' => true);
        $result = $this->_collection->findOne($query);
        if(isset($result['_id']) && $result['_id']) return true;
        else return false;
    }

    public function check_dmtieuchuan($id_tieuchuan){
        $query = array('id_parent' => DBConnect::ObjectId($id_tieuchuan));
        $result = $this->_collection->findOne($query);
        if(isset($result['_id']) && $result['_id']) return true;
        else return false;
    }

}
?>
