<?php 
	require 'tableGateway/Post.php';
	require 'rowGateway/Post.php';

	// ---- Create some example posts -----
	$tableGateway = new PostTableGateway;
	# clear all rows
	foreach ($tableGateway->findAll() as $post) {
		$tableGateway->delete($post);
	}

	$entry1 = new Post;
	$entry1->setCreated("2013-10-28");
	$entry1->setTitle("Test 1 Title.");
	$entry1->setContent("Lorem ipsum dorol sit amet.");
	
	$entry2 = new Post;
	$entry2->setCreated("2013-10-28");
	$entry2->setTitle("Test 2 Title.");
	$entry2->setContent("Lorem ipsum dorol sit amet. Lorem ipsum dorol sit amet. Lorem ipsum dorol sit amet.");
	
	$entry3 = new Post;
	$entry3->setCreated("2012-06-05");
	$entry3->setTitle("Title 3");
	$entry3->setContent("asdf asdf asdf asdf asdf asdf asdf asdf asdf.");
	
	$tableGateway->create($entry1);
	$tableGateway->create($entry2);
	$tableGateway->create($entry3);
	// -------------------------------------
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="v07">

    <title>PHP/MySQL - ZHAW - 2013 - v07</title>
  </head>

  <body>

  	<h1>Table Gateway</h1>
	<p>All Posts:</p>
	<table border="1" cellspacing="0">
		<tr>
			<th>Created</th>
			<th>Title</th>
			<th>Content</th>
		</tr>
	<?php
	foreach ($tableGateway->findAll() as $post) {
		echo '<tr>';
			echo '<td>'.$post->getCreated().'</td>';
			echo '<td>'.$post->getTitle().'</td>';
			echo '<td>'.$post->getContent().'</td>';
		echo '</tr>';
	}
	?>
	</table>

	<br/>

	<p>Posts by Attribute (created = 28.10.2013):</p>
	<table border="1" cellspacing="0">
		<tr>
			<th>Created</th>
			<th>Title</th>
			<th>Content</th>
		</tr>
	<?php
	foreach ($tableGateway->findByAttribute('created', '2013-10-28') as $post) {
		echo '<tr>';
			echo '<td>'.$post->getCreated().'</td>';
			echo '<td>'.$post->getTitle().'</td>';
			echo '<td>'.$post->getContent().'</td>';
		echo '</tr>';
	}
	?>
	</table>
	
	<br/>

	<p>Post with id = 1</p>
	<table border="1" cellspacing="0">
		<tr>
			<th>Created</th>
			<th>Title</th>
			<th>Content</th>
		</tr>
	<?php
	$post = $tableGateway->findById($entry2->getId());
	echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
	echo '</tr>';
	?>
	</table>
	
	<br/>

	<p>Updating post with id = 1</p>
	<?php
	$post->setContent("NEW NEW NEW NEW NEW");
	$tableGateway->update($post);
	?>

	<p>Post with id = 1</p>
	<table border="1" cellspacing="0">
		<tr>
			<th>Created</th>
			<th>Title</th>
			<th>Content</th>
		</tr>
	<?php
	$post = $tableGateway->findById($post->getId());
	echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
	echo '</tr>';
	?>
	</table>


	<h1>Row Gateway</h1>
	<p>All Posts:</p>

	<table border="1" cellspacing="0">
		<tr>
			<th>Created</th>
			<th>Title</th>
			<th>Content</th>
		</tr>
	<?php
	foreach ($tableGateway->findAll() as $post) {
	echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
	echo '</tr>';
	}
	?>
	</table>

	<br />


	<p>Post with id = 1</p>
	<table border="1" cellspacing="0">
		<tr>
			<th>Created</th>
			<th>Title</th>
			<th>Content</th>
		</tr>
	<?php
	$post = new Post;
	$post->findById($entry2->getId());
	echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
	echo '</tr>';
	?>
	</table>

	<br/>

	<p>Updating post with id = 1</p>
	<?php
	$post->setContent("NEWER NEWER NEWER NEWER NEWER");
	$post->update();
	?>

	<p>Post with id = 1</p>
	<table border="1" cellspacing="0">
		<tr>
			<th>Created</th>
			<th>Title</th>
			<th>Content</th>
		</tr>
	<?php
	$post = new Post;
	$post->findById($entry2->getId());
	echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
	echo '</tr>';
	?>
	</table>
	
	<?php
	foreach ($tableGateway->findAll() as $post) {
		$post->delete();
	}
	?>
  </body>
</html>
