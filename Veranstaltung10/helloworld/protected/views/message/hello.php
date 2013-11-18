<?php
/* @var $this MessageController */

$this->breadcrumbs=array(
	'Message'=>array('/message'),
	'Hello',
);
?>
<h1>Hallo Welt!</h1>

<h3><?php echo $this->time; ?></h3>

<p><?php echo CHtml::link('Goodbye', array('message/goodbye')); ?></p>
