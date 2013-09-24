<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if( isset( $_POST['send'] ) ) {

	$from = $_POST['from'];
	$to = explode(";" , $_POST['to']);

	$subject = $_POST['subject'];
	$message = $_POST['msg'];

	$header = 'From: '.$from.'' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	foreach ($to as $m) {
		mail ( $m , $subject , $message, $header );
	}
}
?><!DOCTYPE html>
<html>
<head>
    <title>Veranstaltung 03 - Mail</title>
    <meta name="viewport" content="width=device-width"/>
</head>
<body>
    <form action="index.php" method="post">
    	<p>
    	    <input type="text" name="from" placeholder="Sender" value="<?php echo @$_POST['from']; ?>" />
    	</p>

    	<p>
    	    <input type="text" name="to" placeholder="Receiver(s), separated by ;" value="<?php echo @$_POST['to']; ?>"/>
    	</p>

    	<p>
    	    <input type="text" name="subject" placeholder="Subject" value="<?php echo @$_POST['subject']; ?>"/>
    	</p>

    	<p>
    	<textarea name="msg" placeholder="Message"><?php echo @$_POST['msg']; ?></textarea>
    	</p>
    	<input type="hidden" name="send" value="1" />
    	<input type="submit" value="Send"/>
    </form>

</body>
</html>