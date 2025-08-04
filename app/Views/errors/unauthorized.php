<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unautorized 403</title>
</head>

<body>
    <?php
        $user = session()->get('user');
    ?>
    <h1>Akses Ditolak</h1>
    <p>Anda tidak memiliki hak untuk mengakses halaman ini.</p>
    <p>Status user anda sekarang adalah <?php echo $user->level ?> dan anda tidak dapat mengakses halaman ini</p>
    <a href="<?php echo base_url('/') ?>">Kembali ke Beranda</a>

</body>

</html>