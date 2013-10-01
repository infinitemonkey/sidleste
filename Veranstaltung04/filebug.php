<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST['send'])) {

    $PASSWORD = 'PA$$WORD1';

    // File Upload ------
	$tmp_name = $_FILES['screenshot']['tmp_name'];
	$filename = $_FILES['screenshot']['name'];
	$filepath = 'images/'.$filename;
	if (!move_uploaded_file($tmp_name, $filepath)) {
	    die('Failed to upload file :(');
    }

    $name  = trim($_POST['name']);
    $type  = trim($_POST['type']);
    $tel   = trim($_POST['tel']);
    $cb    = trim($_POST['callback']) == 'on';
    $email = trim($_POST['email']);
    $web   = trim($_POST['web']);
    $date  = trim($_POST['datum']);
    $prio  = trim($_POST['prio']);
    $text  = trim($_POST['text']);
    $pass  = trim($_POST['password']);
    $types = array(1 => 'Connectivity',
                   2 => 'Credentials/Login',
                   3 => 'Other');

    // Validation ------
    if (empty($name) ||
        !array_key_exists($type, $types) ||
        ($cb && empty($tel)) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        !filter_var($web, FILTER_VALIDATE_URL) ||
        empty($date) ||
        !ctype_digit($prio) ||
        empty($text) ||
        $pass !== $PASSWORD) {

        die('Validation failed!');
    }

    // PEAR Mail ------
    require_once "Mail.php";
    require_once "Mail/mime.php";

    $from       = 'noreply@bugreportin.ch';
    $to         = $email;
    $subject    = 'New Bug';
    $body       = 'New Bug: \n\n' .
                      'Name: ' . $name . '\n\n' .
                      'Type: ' . $types[$type] . '\n\n' .
                      $cb ? 'Rückruf: ' . $tel . '\n\n' : '' .
                      'E-Mail: ' . $mail . '\n\n' .
                      'Web: ' . $web . '\n\n' .
                      'Date: ' . $date . '\n\n' .
                      'Prio: ' . $prio . '\n\n' .
                      'Text: ' . $text;
    $html       = '<html><body>'.$body.'</body></html>';
    $headers    = array(
                    'From' => $from,
                    'To' => $to,
                    'Subject' => $subject
                    );

    $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'stefan.sidler@gmail.com',
            'password' => 'XXXXXX'
        ));


    $crlf = "rn";

    $mime = new Mail_mime($crlf);

    $mime->setTXTBody($body);
    $mime->setHTMLBody($html);

    $mime->addAttachment($filepath,'application/octet-stream');

    $body = $mime->get();
    $hdrs = $mime->headers($headers);

    $mail =& Mail::factory('smtp', array(
               'host' => 'ssl://smtp.gmail.com',
               'port' => '465',
               'auth' => true,
               'username' => 'stefan.sidler@gmail.com',
               'password' => 'XXXXXX'
           ));
    $mail->send($to, $hdrs, $body);

    if (PEAR::isError($mail)) {
        echo('<p>' . $mail->getMessage() . '</p>');
    } else {
        echo('<p>Message successfully sent!</p>');
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit us your Bug!</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>
<body>

<h2>Bitte melde deinen Bug mit diesem Formular</h2>

<form class="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

    <p class="name">
        <input type="text" name="name" id="name" placeholder="John Doe" required>
        <label for="name">Name</label>
    </p>

    <p class="email">
        <input type="email" name="email" id="email" placeholder="mail@example.com" required>
        <label for="email">Email</label>
    </p>

    <p class="tel">
        <input type="tel" name="tel" id="tel" placeholder="041 123 12 12" required>
        <label for="tel">Telefon</label>
        <input type="checkbox" name="callback"> Rückruf erforderlich?
    </p>

    <p class="type">
        <label for="type">Bugtype</label>
        <select name="type" id="type" >
            <option value=1>Connectivity</option>
            <option value=2>Credentials/Login</option>
            <option value=3>Other</option>
        </select>
    </p>

    <p class="web">
        <input type="url" name="web" id="web" placeholder="http://www.example.com" required>
        <label for="web">Website</label>
    </p>

    <p class="screenshot">
        <input type="file" name="screenshot" id="screenshot" />
        <label for="screenshot">Screenshot</label>
    </p>

    <p class="datum">
        <input type="datetime" name="datum" id="datum" />
        <label for="datum">Datum</label>
    </p>

    <p class="prio">
        <label for="prio">Priorität</label>
        <select name="prio" id="prio" >
            <option value=1>High</option>
            <option value=2>Medium</option>
            <option value=3>Low</option>
        </select>
    </p>

    <p class="text">
        <textarea name="text" placeholder="Fehlerreport" required></textarea>
    </p>

    <p class="password">
        <input type="password" name="password" id="password" required />
        <label for="password">Passwort</label>
    </p>

    <p class="submit">
		<input type="hidden" name="send" id="send" value="1" />
        <input type="submit" value="Senden" />
    </p>
</form>

</body>
</html>
