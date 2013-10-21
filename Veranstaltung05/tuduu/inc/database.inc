<?php
function connect(){
    $host='localhost';
    $dbname='tuduu';
    $username='tuduu_user';
    $password='abcdefghijklmn';
    
    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, array(
            PDO::ATTR_PERSISTENT => true
        ));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        
        return $conn;
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    }
}

function getAllItems(){
    $conn = connect();
    try {
        $stmt = $conn->prepare('SELECT * FROM todos ORDER BY completed, id DESC');
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    }
}

function getActiveItems(){
   $conn = connect();
    try {
        $stmt = $conn->prepare('SELECT * FROM todos WHERE completed = false ORDER BY id DESC');
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    } 
}

function getCompletedItems(){
   $conn = connect();
    try {
        $stmt = $conn->prepare('SELECT * FROM todos WHERE completed = true ORDER BY id DESC');
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    } 
}

function getItem($id){
    $conn = connect();
    try {
        $stmt = $conn->prepare('SELECT * FROM todos WHERE id = :id');
        $stmt->execute(array(
            'id' => $id
        ));
     
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    }
}

function addItem($title, $completed = false){
    if(!trim($title)){
        return;
    }
        
    $conn = connect();
    try {
        $stmt = $conn->prepare('INSERT INTO todos (title, completed) VALUES (:title, :completed)');
        $stmt->execute(array(
            ':title' => $title,
            ':completed' => $completed
        ));
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    }    
}

function deleteItem($id){
    $conn = connect();
    try {
        $stmt = $conn->prepare('DELETE FROM todos WHERE id=:id');
        $stmt->execute(array(
            ':id' => $id
        ));
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    }    
}

function editItemTitle($id, $title){
    $conn = connect();
    try {
        $stmt = $conn->prepare('UPDATE todos SET title=:title WHERE id = :id');
        $stmt->execute(array(
            ':id' => $id,
            ':title' => $title,
        ));
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    }
}

function editItemStatus($id, $completed){
    $conn = connect();
    try {
        $stmt = $conn->prepare('UPDATE todos SET completed=:completed WHERE id = :id');
        $stmt->execute(array(
            ':id' => $id,
            ':completed' => $completed
        ));
    } catch(PDOException $e) {
        exit('Error: '.$e->getMessage().'</br>');
    }
}
?>