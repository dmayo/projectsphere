<?php

/**
 * Securimage with AJAX
 *
 * Author: Drew Phillips (www.phpcaptcha.org)
 *
 * This code is released to the public domain.
 *
 */


// get form data into shorter variables
// each $_POST variable is named based on the form field's id value

$code    = $_POST['code'];

$errors  = array(); // array of errors

// basic validation

  // only check the code if there are no other errors
  require_once 'securimage/securimage.php';
  $img = new Securimage;
  if ($img->check($code) == false) {
  die('NO');
  
  } // if the code checked is correct, it is destroyed to prevent re-use
die('OK');

if (sizeof($errors) > 0) {
  // if errors, send the error message
  $str = implode("\n", $errors);
  die("There was an error with your submission!  Please correct the following:\n\n" . $str);
}

$time = date('r');
$body = <<<EOD
Hi!

A message was sent to you from $name on $time.

Here is their message:

$message
EOD;

// send email
mail($your_email, "Contact Form Sent", $body, "From: $your_email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=ISO-8859-1\r\nMIME-Version: 1.0");

 // send success indicator

?>