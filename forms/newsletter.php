
<?php
if(isset($_POST['email'])) {
    // CHANGE THE TWO LINES BELOW
    $email_to = "hello@oarealestategroup.com";
    $email_subject = "Subscribe to OA Real Estate Group";
    function died($error) {
        // your error code can go here
        echo "We're sorry, but there's errors found with the form you submitted.<br /><br />";
        echo $error."<br /><br />";
        echo "Please fix these errors.<br /><br />";
        die();
    }
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
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
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $headers); 
header('Location: thankyou.html');
?>
<?php
}
die();
?>