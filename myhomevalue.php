
<?php
if(isset($_POST['email'])) {
    // CHANGE THE TWO LINES BELOW
    $email_to = "hello@oarealestategroup.com";
    $email_subject = "What is the Value of my Home?";
    function died($error) {
        // your error code can go here
        echo "We're sorry, but there's errors found with the form you submitted.<br /><br />";
        echo $error."<br /><br />";
        echo "Please fix these errors.<br /><br />";
        die();
    }
    // validation expected data exists
    if(!isset($_POST['fname']) ||
        !isset($_POST['zip']) ||
        !isset($_POST['state']) ||
        !isset($_POST['city']) ||
        !isset($_POST['address1']) ||
        !isset($_POST['address2']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
    $address1 = $_POST['address1']; // required
    $address2 = $_POST['address2']; 
    $city = $_POST['city']; // required
    $state = $_POST['state']; // required
    $zip = $_POST['zip']; // required
    $fname = $_POST['fname']; // required
    $email = $_POST['email']; // required
    $phone = $_POST['phone'];
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
      $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$fname)) {
      $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
      died($error_message);
  }
    $email_message = "Form details below.\n\n";
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    $email_message .= "Full Name: ".clean_string($fname)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Telephone: ".clean_string($phone)."\n";
    $email_message .= "Address 1: ".clean_string($address1)."\n";
    $email_message .= "Address 2: ".clean_string($address2)."\n";
    $email_message .= "City: ".clean_string($city)."\n";
    $email_message .= "State: ".clean_string($state)."\n";
    $email_message .= "Zip: ".clean_string($zip)."\n";
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
header('Location: thankyou.html');
?>
<?php
}
die();
?>