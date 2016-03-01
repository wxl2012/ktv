<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo isset($title) && $title ? $title : ''; ?></title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/third-party/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <script type="text/javascript" src="/assets/third-party/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>



<?php echo $content; ?>



<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
</body>
</html>