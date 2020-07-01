<!DOCTYPE html>
<html>
<head>
<!-- ProcessForm.php Created 6-7-2018 by Ray Ryon -->
<!-- This page is an example of form handling. It will be called when the formv1.php page is submitted. -->
<title>Process Form</title>
</head>
<body>
<p><b>Results from Form</b></p>
<?php
 $Name = $_POST['Name'];
 $Age = $_POST['Age'];
 $Gender = $_POST['Gender'];
 echo "<p>Your form has been submitted. Thank you, $Name.</p>\n";
 echo "<p>Age $Age </p>\n";
 echo "<p>Gender $Gender </p>\n";
 echo $Name;
?>
</body>
</html>