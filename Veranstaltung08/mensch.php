<?php

class Mensch extends Lebewesen
{
	private $name;
	private $gender;

	public function getName()
	{
		return $this->name;
	}

	public function __construct($name, $gender)
	{
		$this->name = $name;
		$this->gender = $gender;
		$this->age = 1;
	}

	public function __destruct()
	{

	}

	public function umbenennen($newName)
	{
		$this->$name = $newName;
	}

	public function geburtstagFeiern()
	{
		echo "Gratuliere zum ".$this->$age++.". Geburtstag!";
	}
}

?>