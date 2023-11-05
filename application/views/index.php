<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Aplikasi Sewa Kamar Kos Per Bulan</title>

    <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

    body {
        background: #c0c0c0;
        font-family: Raleway, sans-serif;
        color: #666;
    }

    .login {
        margin: 20px auto;
        padding: 40px 50px;
        max-width: 300px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 1px 1px 1px #666;
    }

    .login input {
        width: 100%;
        display: block;
        box-sizing: border-box;
        margin: 10px 0;
        padding: 14px 12px;
        font-size: 16px;
        border-radius: 2px;
        font-family: Raleway, sans-serif;
    }

    .login input[type=text],
    .login input[type=password] {
        border: 1px solid #c0c0c0;
        transition: .2s;
    }

    .login input[type=text]:hover {
        border-color: #F44336;
        outline: none;
        transition: all .2s ease-in-out;
    }

    .login input[type=submit] {
        border: none;
        background: #EF5350;
        color: white;
        font-weight: bold;
        transition: 0.2s;
        margin: 20px 0px;
    }

    .login input[type=submit]:hover {
        background: #F44336;
    }

    .login h2 {
        margin: 20px 0 0;
        color: #EF5350;
        font-size: 20px;
    }

    .login p {
        margin-bottom: 40px;
    }

    .links {
        display: table;
        width: 100%;
        box-sizing: border-box;
        border-top: 1px solid #c0c0c0;
        margin-bottom: 10px;
    }

    .links a {
        display: table-cell;
        padding-top: 10px;
    }

    .links a:first-child {
        text-align: left;
    }

    .links a:last-child {
        text-align: right;
    }

    .login h2,
    .login p,
    .login a {
        text-align: center;
    }

    .login a {
        text-decoration: none;
        font-size: .8em;
    }

    .login a:visited {
        color: inherit;
    }

    .login a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <form class="login">
        <h2>Selamat Datang Di</h2>
        <p>Aplikasi Sederhana Sewa Kamar Kos Per Bulan </p>
        <form action="<?php echo site_url('C_login/login') ?>" method="post">
            <input type="text" placeholder="User Name" />
            <input type="password" placeholder="Password" />
            <input type="submit" value="Masuk" />
        </form>

</body>

</html>