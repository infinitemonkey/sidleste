<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


if (isset($_POST['send'])) {

    require_once "Mail.php";

    $from = $_POST['from'];
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $body = $_POST['msg'];

    $headers = array(
        'From' => $from,
        'To' => $to,
        'Subject' => $subject
    );

    $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => $_POST['from'],
            'password' => $_POST['gpassword']
        ));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        echo('<p>' . $mail->getMessage() . '</p>');
    } else {
        echo('<p>Message successfully sent!</p>');
    }
}

?>
<!DOCTYPE html>
<head>
    <title>Veranstaltung 03 - Mail</title>
    <meta name="viewport" content="width=device-width"/>
</head>
<body>
    <h1>PHP-Mailer</h1>
    <h2>With SMTP-Authentication (GMAIL)</h2>
    <p>Use your gmail address and pw to send mails</p>
    <form action="gmailer.php" method="post">
        <input type="text" name="from" placeholder="Sender" value="<?php echo @$_POST['from']; ?>" /><br />
        <input type="password" name="gpassword" placeholder="Google PW" value="<?php echo @$_POST['gpassword']; ?>" /><br />
        <input type="text" name="to" placeholder="Receiver" value="<?php echo @$_POST['to']; ?>"/><br />
        <input type="text" name="subject" placeholder="Subject" value="<?php echo @$_POST['subject']; ?>"/><br />
    	<textarea name="msg" placeholder="Message"><?php echo @$_POST['msg']; ?></textarea><br /><br />

    	<input type="hidden" name="send" value="1" />
    	<input type="submit" value="Send"/>
    </form>

</body>
</html>