<!DOCTYPE html>
<html>

<head>
    <title>Aplikasi Penyewaan Kamar Kos</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-login.css'); ?>">
</head>

<body>
    <div class="login">

        <h2 class="login-header">Selamat Datang Di Aplikasi Penyewaan Kamar Kos</h2>
        <form method="post" action="<?php echo site_url('login/sign_in'); ?>" class="login-container">
            <p>
                <input type="text" name="username" placeholder="Username">
            </p>
            <p>
                <input type="password" name="password" placeholder="Password">
            </p>
            <p>
                <input type="submit" value="Masuk">
            </p>
            <p>Message:
                <?php echo $this->session->flashdata('msg_info'); ?>
            </p>
        </form>
    </div>
</body>

</html>