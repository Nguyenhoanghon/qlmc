<?php
namespace Models;
class LoaiVanBan {
    const COLLECTION = 'loaivanban';
    private $_mongodb;
    private $_collection;

    public $id = '';
    public $ten = '';
    public $thutu = 0;

    public function __construct(){
        $this->_mongodb = DBConnect::getDB();
        $this->_collection = $this->_mongodb->{LoaiVanBan::COLLECTION};
    }

    public function get_all_list(){
        return $this->_collection->find(array(), array('sort' => array('thutu'=> 1)))->toArray();
    }

    public function get_list_condition($condition){
        return $this->_collection->find($condition, array('sort' => array('thutu' => 1)))->toArray();
    }

    public function get_one(){
        $query = array('_id' => DBConnect::ObjectId($this->id));
        return $this->_collection->findOne($query);
    }

    public function insert(){
        $query = array('ten' => $this->ten, 'thutu' => intval($this->thutu));
        return $this->_collection->insertOne($query);
    }

    public function edit(){
        $query = array('$set' => array( 'ten' => $this->ten, 'thutu' => intval($this->thutu)));
        $condition = array('_id' => DBConnect::ObjectId($this->id));
        return $this->_collection->updateOne($condition, $query);
    }

    public function delete(){
        $query = array('_id' => DBConnect::ObjectId($this->id));
        return $this->_collection->deleteOne($query);
    }

    public function get_vanban($arr){
        $arr_vanban = array();
        if($arr){
            foreach($arr as $key => $value){
                $this->id = $value; $vb = $this->get_one();
                array_push($arr_vanban, $vb['ten']);
            }
        }
        if($arr_vanban) return implode(", ", $arr_vanban);
        else return '';
    }
}
?>
