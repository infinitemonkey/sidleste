<?php  
  
require 'db_config.php';

class PostTableGateway {  
	
    public function findByID($id) {
    	$sql = "SELECT * FROM tbl_person WHERE id = :id";
    	$fieldValueMapping = array(':id'=>$id);
    	
    	$pquery = prepareSql($sql);
    	$pquery->setFetchMode(PDO::FETCH_CLASS, 'Post');
    	$pquery = executeSql($pquery, $fieldValueMapping);
    	
    	return $pquery->fetch();
    }
    
    public function findByAttribute($attribute, $value) {
    	$sql = "SELECT * FROM tbl_person WHERE $attribute = :$attribute";
    	$fieldValueMapping = array(":$attribute"=>$value);
    	
    	$pquery = prepareSql($sql);
    	$pquery->setFetchMode(PDO::FETCH_CLASS, 'Post');
    	$pquery = executeSql($pquery, $fieldValueMapping);
    	 
    	return $pquery->fetchAll();
    }
    
    public function findAll() {
    	$sql = "SELECT * FROM tbl_person";
    	 
    	$pquery = prepareSql($sql);
    	$pquery->setFetchMode(PDO::FETCH_CLASS, 'Post');
    	$pquery = executeSql($pquery, array());
    
    	return $pquery->fetchAll();
    }
    
    public function create($entry) {
    	$sql = "INSERT INTO tbl_person (created, title, content) VALUES (:created, :title, :content)";
    	$fieldValueMapping = array(':created'=>$entry->getCreated(),':title'=>$entry->getTitle(), ':content'=>$entry->getContent());
    
    	$pquery = prepareSql($sql);
    	$pquery = executeSql($pquery, $fieldValueMapping);
    	$entry->setId(getDb()->lastInsertId());
    	return $entry;
    }
    
    public function update($entry) {
    	$sql = "UPDATE tbl_person SET created = :created, title = :title, content = :content WHERE id = :id";
    	$fieldValueMapping = array(':created'=>$entry->getCreated(),':title'=>$entry->getTitle(), ':content'=>$entry->getContent(), ':id'=>$entry->getId());

    	$pquery = prepareSql($sql);
    	$pquery = executeSql($pquery, $fieldValueMapping);
    	return $entry;
    }
    
    public function delete($entry) {
    	$sql = "DELETE FROM tbl_person  WHERE id=:id";
    	$fieldValueMapping = array(':id'=>$entry->getId());
    	
    	$pquery = prepareSql($sql);
    	$pquery = executeSql($pquery, $fieldValueMapping);
    }
}

?>