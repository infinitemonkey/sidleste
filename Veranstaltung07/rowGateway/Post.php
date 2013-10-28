<?php  
  
class Post {  
	
	private $id;
	private $created;
	private $title;
	private $content;
	
	// row table gateway functionality
	public function findByID($id) {
		$sql = "SELECT * FROM tbl_person WHERE id = :id";
		$fieldValueMapping = array(':id'=>$id);
		 
		$pquery = prepareSql($sql);
		$pquery->setFetchMode(PDO::FETCH_CLASS, 'Post');
		$pquery = executeSql($pquery, $fieldValueMapping);
		 
		$post = $pquery->fetch();
		$this->setId($post->getId());
		$this->setCreated($post->getCreated());
		$this->setTitle($post->getTitle());
		$this->setContent($post->getContent());
	}
	
	public function create() {
		$sql = "INSERT INTO tbl_person (created, title, content) VALUES (:created, :title, :content)";
		$fieldValueMapping = array(':created'=>$this->getCreated(),':title'=>$this->getTitle(), ':content'=>$this->getContent());
	
		$pquery = prepareSql($sql);
		$pquery = executeSql($pquery, $fieldValueMapping);
		$this->setId(getDb()->lastInsertId());
	}
	
	public function update() {
		$sql = "UPDATE tbl_person SET created = :created, title = :title, content = :content WHERE id = :id";
		$fieldValueMapping = array(':created'=>$this->getCreated(),':title'=>$this->getTitle(), ':content'=>$this->getContent(), ':id'=>$this->getId());
		
		$pquery = prepareSql($sql);
		$pquery = executeSql($pquery, $fieldValueMapping);
	}
	
	public function delete() {
		$sql = "DELETE FROM tbl_person  WHERE id=:id";
		$fieldValueMapping = array(':id'=>$this->getId());
		 
		$pquery = prepareSql($sql);
		$pquery = executeSql($pquery, $fieldValueMapping);
	}
	
	// getters and setters
	
	public function setId($id) 	{
		$this->id = $id;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setCreated($created) 	{
		$this->created = $created;
	}
	
	public function getCreated() {
		return $this->created;
	}
	
	public function setTitle($title) 	{
		$this->title = $title;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setContent($content) 	{
		$this->content = $content;
	}
	
	public function getContent() {
		return $this->content;
	}
	
}