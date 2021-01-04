<?php

$customer_email = $customer_name = $customer_phone = $event_type = $bg_music =
$dj = $multiple_soloists = $acoustic = $troubadour = $strings = $message = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

#Receive user input and check that the method used is allowed
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $customer_email = test_input($_POST['customer-email']);
  $customer_name =  test_input($_POST['customer-name']);
  $customer_phone = test_input($_POST['customer-phone']);
  $event_type = test_input($_POST['event']);
  $bg_music = test_input($_POST['bg-music']);
  $dj = test_input($_POST['dj']);
  $multiple_soloists = test_input($_POST['multiple-soloists']);
  $acoustic = test_input($_POST['acoustic']);
  $troubadour = test_input($_POST['troubadour']);
  $message = test_input($_POST['message']);
  $strings = test_input($_POST['strings']);

  #Send email to business owner
  $form = "From:  " . $customer_email .
          "\n Name: " . $customer_name .
          "\n Phone: " . $customer_phone .
          "\n Event type: " . $event_type .
          "\n Interested also in: " . $bg_music . $dj . $multiple_soloists . $acoustic . $troubadour . $strings .
          "\n Message: " . $message;
  $sent = mail('email@instaglamour.fi', 'New message from your site: ', $form);
}

#Thank user and send a confirmation email
if ($sent) {

?><html>
<head>
<title>Thank you for your message!</title>
</head>
<body>
<h1>Your message was sent succesfully.</h1>
<p>You have recieved a confirmation email to the email address you submitted.</p>
</body>
</html>
<?php

  $confirmation = "Kiitos viestistäsi! Olemme sinuun yhteydessä pian." .
                   "\nThank you for your message! We will contact you soon." .
                   "\nViestisi // Your message:\n" .
                   "\n Email: " . $customer_email .
                   "\n Name: " . $customer_name .
                   "\n Phone: " . $customer_phone .
                   "\n Message: " . $message;
  $headers = "From: Instaglamour <email@instaglamour.fi>";
  mail($customer_email, 'Instaglamour.fi: Kiitos viestistäsi. Thank you for your message.', $confirmation, $headers);

#If something went wrong
} else {

?><html>
<head>
<title>Something went wrong</title>
</head>
<body>
<h1>Something went wrong</h1>
<p>We could not send your feedback. Please try again.</p>
</body>
</html>
<?php
}
?>

