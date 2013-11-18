<?php 
	require_once "lebewesen.php";
	require_once "mensch.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="v08">

    <title>PHP/MySQL - ZHAW - 2013 - v08</title>
  </head>

  <body>
  		<?php
  		$mensch = new Mensch("Fritzli", "m");

  		echo $mensch->getName();
  		echo $mensch->getAlter();
  		?>
  </body>
</html>
