<!DOCTYPE html>
<html>
<head>
<!-- formv1.php Created 5-7-2018 by Ray Ryon -->
<!-- This page is an example of form input. -->
<title>Form Version 1</title>
</head>
<body>
<p><b>Form For Input</b></p>
<form name="contact" action="ProcessForm.php" method="post">
<p>Your Name: <input type="text" name="Name" value="" /></p>
<p>Your Age: <input type="text" name="Age" value="" size="5" /></p>
<p>Gender: <input type="text" name="Gender" placeholder="M or F" /></p>
<p>
<input type="reset" value="Clear Form" />
&nbsp;&nbsp;
<input type="submit" name="Submit" value="Send Form" />
</p>
</form>
</body>
</html>