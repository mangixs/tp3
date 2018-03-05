<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="renderer" content="webkit">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<title>登陆</title>
<link href="/Public/css/style_log.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/Public/bootstrap/css/bootstrap.min.css">
</head>

<body class="login" mycollectionplug="bind">
<div class="login_m">
<div class="login_logo"><img src="/Public/images/logo.png" width="196" height="46"></div>
<div class="login_boder">

<div class="login_padding" id="login_model">

  <h2>USERNAME</h2>
  <label>
    <input type="text" name="username" class="txt_input txt_input2" placeholder="username">
  </label>
  <h2>PASSWORD</h2>
  <label>
    <input type="password" name="pwd" id="userpwd" class="txt_input" placeholder="password" >
  </label>
  <div class="rem_sub">
    <button type="button" class="btn btn-default">login</button>
</div>
<script type="text/javascript" src="/Public/js/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="/Public/js/jq_notice.js"></script>
<script type="text/javascript" src="/Public/js/login.js"></script>
</body>
</html>