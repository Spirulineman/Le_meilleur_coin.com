<?php

require "lessphp/lessc.inc.php";

$less = new lessc;

// echo $less->compileFile("test.less");

$less->checkedCompile("test.less", "test.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet/less" type="text/css" href="test.less" />
    <!-- <link rel="stylesheet" type="text/css" href="test.less" /> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/less" ></script> -->
    <script src="JsDelivr.js" ></script>
<!--     <script src="lessphp/lessc.inc.php" ></script> -->    
    <title>Mon_TEST__LESS</title>

</head>
<body>
    <p>

    what's up ...
    </p>
</body>
</html>

