<?php
/* @var $this MessageController */

$this->breadcrumbs=array(
	'Message'=>array('/message'),
	'Goodbye',
);
?>
<h1>Goodbye!</h1>

<h3><?php echo $this->time; ?></h3>

<p><?php echo CHtml::link('Hello',array('message/hello')); ?></p>
