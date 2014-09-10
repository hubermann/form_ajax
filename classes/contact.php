<?php if ( !isset( $_SESSION ) ) session_start();

// Incluye parámetros para el envío del formulario.
include 'child-theme/config_landing.php';

if ( !$_POST ) exit;

if ( !defined( "PHP_EOL" ) ) define( "PHP_EOL", "\r\n" );

///////////////////////////////////////////////////////////////////////////
//
// Do not edit the following lines
//
///////////////////////////////////////////////////////////////////////////

$postValues = array();
foreach ( $_POST as $nombre => $value ) {
    $postValues[$nombre] = trim( $value );
}
extract( $postValues );


// Important Variables
/*$posted_verify = isset( $postValues['verify'] ) ? md5( $postValues['verify'] ) : '';
$session_verify = empty( $_SESSION['verify'] ) ? $_COOKIE['verify'] : $_SESSION['verify'];*/

$error = '';

///////////////////////////////////////////////////////////////////////////
//
// Begin verification process
//
// You may add or edit lines in here.
//
// To make a field not required, simply delete the entire if statement for that field.
//
///////////////////////////////////////////////////////////////////////////


////////////////////////
// nombre field is required
if ( empty( $nombre ) || $nombre == 'nombre*') {
    $error .= '<li>Su nombre y ciudad son necesarios.</li>';
}
////////////////////////



////////////////////////
// lastnombre field is required
if ( empty( $ciudad ) || $ciudad == 'Ciudad*') {
    $error .= '<li>Su ciudad es necesario.</li>';
}
////////////////////////

// fecha field is required
if ( empty( $fecha ) || $fecha == 'Fecha*') {
    $error .= '<li>La fecha es necesaria.</li>';
}

////////////////////////
// Email field is required
if ( empty( $email ) ) {
    $error .= '<li>Su e-mail es necesario.</li>';
} elseif ( !isEmail( $email ) ) {
    $error .= '<li>Usted ha ingresado una dirección de e-mail inválida.</li>';
}
////////////////////////


////////////////////////
// Phone field isn't required
/*
if ( empty( $phone ) ) {
    $error .= '<li>Su teléfono es necesario.</li>';
} elseif ( !is_numeric( $phone ) ) {
    $error .= '<li>Su teléfono solo contiene dígitos.</li>';
}
*/
////////////////////////


////////////////////////
/* Verification code is required
if ( $session_verify != $posted_verify ) {
    $error .= '<li>El código de verificación ingresado es incorrecto.</li>';
}*/
////////////////////////

if ( !empty($error) ) {
    echo '<div class="error_message"><h2>Atención!</h2>';
    echo '<ul class="error_messages">' . $error . '</ul>';
    echo '</div>';

    // Important to have return false in here.
    return false;

}

// Advanced Configuration Option.
// i.e. The standard subject will appear as, "You've been contacted by John Doe."

$e_subject = $asunto_email;

// Advanced Configuration Option.
// You can change this if you feel that you need to.
// Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.

$msg  = "$nombre, ha enviado el siguiente mensaje." . PHP_EOL . PHP_EOL;
/*$msg .= $comments . PHP_EOL . PHP_EOL;*/
$msg .= "mensaje de $nombre, Ciudad: $ciudad , Nac: $fecha - $email."  . PHP_EOL . PHP_EOL;
//$msg .= "$nombre chose option: $agree";
$msg .= "-------------------------------------------------------------------------------------------" . PHP_EOL;
$msg .= "Este mensaje ha sido enviado a través de formulario en facebook ($hoy).";


$msg = wordwrap( $msg, 70 );

// $headers  = "From: $address" . PHP_EOL;
$headers  = "From: $email_saliente" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;
$headers .= 'Bcc: adminfire@gmail.com, demian@e-roy.com' . "\r\n";
// Si quiero un GRACIAS con redireccionamiento de URL. 
/*
if ( mail( $email_recibe, $e_subject, $msg, $headers ) ) {

	echo "1";
	// Important to have return false in here.
    return false;
}
*/
// Si quiero un GRACIAS con AJAX. 

// Si quiero un GRACIAS con redireccionamiento de URL. 
if ( mail( $email_recibe, $e_subject, $msg, $headers ) ) {
    echo "<div id='success_page'>";
    #echo "<h2>EXITO!</h2>";
    echo "<p>Gracias por enviarnos tus datos, nos contactaremos a la brevedad.</p>";
    echo "</div>";


    // Important to have return false in here.
    return false;
}


///////////////////////////////////////////////////////////////////////////
//
// Do not edit below this line
//
///////////////////////////////////////////////////////////////////////////
echo 'ERROR! Please confirm PHP mail() is enabled.';
return false;

function isEmail( $email ) { // Email address verification, do not edit.

    return preg_match( "/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|nombre|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email );

}
?>