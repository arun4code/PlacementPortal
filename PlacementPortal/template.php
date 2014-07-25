<html>
<head>
<title>TEMPLATE</title>
<?php

include('master_head.in');
?>
</head>
<body>
<?php
session_start();
$currently_at='Home';
$vertical_menu='';
$content='';
include('master_body.in');
?>
</body>
</html>