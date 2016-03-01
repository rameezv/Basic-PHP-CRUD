<html>
<head>
<title>TakeItToThe.Top</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
<h1>
<a href="index.php">
<?php
    if (isset($title)) {
        echo $title;
    } else {
        echo "TakeItToThe.Top";
    }
?>
</a>
</h1>
</div>
<div id="wrapper">