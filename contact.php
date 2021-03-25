<?php
if(isset($_POST['email'])) {
    // CHANGE THE TWO LINES BELOW
    $email_to = "hello@oarealestategroup.com";
    $email_subject = "OA REAL ESTATE GROUP CONTACT FORM";
    function died($error) {
        // your error code can go here
        echo "We're sorry, but there's errors found with the form you submitted.<br /><br />";
        echo $error."<br /><br />";
        echo "Please fix these errors.<br /><br />";
        die();
    }
    // validation expected data exists
    if(!isset($_POST['firstname']) ||
        !isset($_POST['surname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
    $firstname = $_POST['firstname']; // required
    $suranme = $_POST['surname']; // required
    $email = $_POST['email']; // required
    $message = $_POST['message']; // required
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
      $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
  
  if(strlen($error_message) > 0) {
      died($error_message);
  }
    $email_message = "Form details below.\n\n";
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    $email_message .= "First Name: ".clean_string($firstname)."\n";
    $email_message .= "Surname: ".clean_string($surname)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
header('Location: contact.html');
?>
<?php
}
die();
?>

