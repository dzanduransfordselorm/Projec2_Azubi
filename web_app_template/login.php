<?php
// Retrieve the values of the "username" and "password" fields from the form submission
$username = $_POST['username'];
$password = $_POST['password'];

// Perform some validation and processing of the submitted data
if ($username == 'admin' && $password == 'admin') {
  // The login was successful
  $message = "Login successful!";
  $redirectUrl = "index.php?message=" . urlencode($message);
  // Add a delay before redirecting to the next page
  echo "<meta http-equiv='refresh' content='2;url=$redirectUrl'>";
} else {
  // The login failed
  $message = "Invalid username or password";
  $redirectUrl = "index.php?message=" . urlencode($message);
}

// Redirect back to the index page with the message
header("Location: $redirectUrl");
?>
