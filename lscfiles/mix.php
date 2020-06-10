<!DOCTYPE html>
<html>
<head>
<!-- Created 6-3-2020 by Lucas Chapman -->
<!-- This page is an example php application. -->
<title>Mixing</title>
</head>
<body>
<h1>Mixing HTML and PHP</h1>
<hr />
<p>
This example shows two methods of mixing HTML and PHP. The results are the same.
</p>
<h3>Example 1: HTML outside of PHP block.</h3>
<?php //Example 1: HTML outside of PHP block. ?>
<p>
Today’s date is <?php echo date("m/d/Y"); ?>
</p>
<h3>Example 2: HTML inside of PHP block.</h3>
<?php
// Example 2: HTML generated from inside PHP block.
echo "<p>Today’s date is ";
echo date("m/d/Y");
echo "</p>"
?>
</body>
</html>