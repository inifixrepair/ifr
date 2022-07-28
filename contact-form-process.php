<?php
header("Location: kontaktai.html");
if (isset($_POST['Email'])) {

    $email_to = "inifix.repair@gmail.com";
    $email_subject = "Inifix Susisiekimas";

    function problem($error)
    {
        echo "Atsiprašome, bet radome klaidų jūsų susisiekimo prašyme. ";
        echo "Klaidos.<br><br>";
        echo $error . "<br><br>";
        echo "Prašome gryžti ir sutvarkyti šias klaidas.<br><br>";
        die();
    }

    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Atsiprašome, bet radome klaidų jūsų susisiekimo prašyme..');
    }

    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $message = $_POST['Message'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Elektroninio pašto adresas kurį pateikėte yra klaidingas.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Vardas kurį pateikėte yra klaidingas.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Žinutė kurią pateikėte yra klaidinga.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Inifix Susisiekimas.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Vardas: " . clean_string($name) . "\n";
    $email_message .= "El. Paštas: " . clean_string($email) . "\n";
    $email_message .= "Žinutė: " . clean_string($message) . "\n";

    $headers = 'Nuo: ' . $email . "\r\n" .
        'Atrašyti: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>


    Ačiū kad susisiekėte su mumis. Nedelsdami su jumis susisieksime.


<?php
}
?>