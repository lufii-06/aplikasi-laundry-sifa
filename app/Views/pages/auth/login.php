<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dita Laoundry || Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?php echo base_url() ?>assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script>
    <script>
    WebFont.load({
        google: {
            "families": ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ['https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/plugins.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/kaiadmin.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo.css">
    <style>
    body {
        background-image: url("<?php echo base_url() ?>assets/img/login-background.webp");
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        background: #334155;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
    }

    .form-control {
        background-color: #f8fafc;
    }

    .btn-login {
        background-color: #22c55e;
        color: white;
        font-weight: bold;
    }

    .btn-login:hover {
        background-color: #16a34a;
    }

    .forgot-password {
        color: #38bdf8;
        text-decoration: none;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body bac>
    <div class="login-box">
        <form method="post" action="/login">
            <h4 class="text-white text-center mb-4">Login Laundry</h4>

            <div class="mb-3">
                <label for="username" class="form-label text-white">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" required
                        autocomplete="username" placeholder="Masukkan Username" value="<?php echo old('username') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-white">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required
                        autocomplete="current-password" placeholder="Masukkan Password">
                    <span class="input-group-text toggle-password"><i class="fas fa-eye"></i></span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label text-white" for="remember">Ingat saya</label>
                </div>
                <a href="/" class="forgot-password">Halaman Utama</a>
            </div>
            <button type="submit" class="btn btn-login w-100">Masuk</button>
        </form>
    </div>

    <script src="<?php echo base_url() ?>assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?php echo base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Moment JS -->
    <script src="<?php echo base_url() ?>assets/js/plugin/moment/moment.min.js"></script>

    <!-- Chart JS -->
    <script src="<?php echo base_url() ?>assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?php echo base_url() ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?php echo base_url() ?>assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="<?php echo base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?php echo base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?php echo base_url() ?>assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="<?php echo base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="<?php echo base_url() ?>assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="<?php echo base_url() ?>assets/js/setting-demo2.js"></script>
    <?php if (session()->getFlashdata('error')): ?>
    <script>
    swal({
        title: "<?php echo session()->getFlashdata('error') ?>",
        icon: 'error',
        buttons: {
            confirm: {
                text: "mengerti!",
                className: "btn btn-info",
            },
        },
    });
    </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
    <script>
    swal({
        title: "<?php echo session()->getFlashdata('success') ?>",
        icon: 'success',
        buttons: {
            confirm: {
                text: "ok!",
                className: "btn btn-info",
            },
        },
    });
    </script>
    <?php endif; ?>

    <script>
    document.querySelector('.toggle-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
    </script>
</body>

</html>