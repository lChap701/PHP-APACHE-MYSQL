<!DOCTYPE html>
<html>
<head>
<!-- formv2.php Created 6-15-2018 by Ray Ryon -->
<!-- This page is an example of form input and
form handling together in the same program. -->
<title>Form Version 2</title>
</head>
<body>
<?php
// The isset decision checks to see if the Submit button has a value set.
// If it does have a value then the form has been submitted and needs to handle the input.
// If it does not have a value then we need to display the form.
if (isset($_POST['Submit']))
{
// This is the form handling code.
$Name = $_POST['Name'];
$Age = $_POST['Age'];
$Gender = $_POST['Gender'];
echo "<p>Your form has been submitted. Thank you, $Name.</p>\n";
echo "<p>Age $Age </p>\n";
echo "<p>Gender $Gender </p>\n";
echo $_POST['Submit'];
} // End brace to end the if statement's true block.
else
{
// This part of the code creates the Form.
?>
<p><b>Form For Input</b></p>
<form name="contact" action="formv2.php" method="post">
<p>Your Name: <input type="text" name="Name" value="" /></p>
<p>Your Age: <input type="text" name="Age" value="" size="5" /></p>
<p>Gender: <input type="text" name="Gender" placeholder="M or F" /></p>
<p>
<input type="reset" value="Clear Form" />
&nbsp;&nbsp;
<input type="submit" name="Submit" value="Send Form" />
</p>
</form>
<?php
} // End brace to end the else clause block.
?>
</body>
</html>
