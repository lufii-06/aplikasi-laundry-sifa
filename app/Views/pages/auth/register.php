<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dita Laundry | Register</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?php echo base_url() ?>/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

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
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/plugins.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/kaiadmin.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/demo.css">
    <style>
    body {
        font-family: 'Public Sans', sans-serif;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    }

    .login-container {
        background: rgba(30, 30, 46, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }

    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
    }

    .logo-container {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    .form-control {
        border: 2px solid #404040;
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #2a2a3e;
        color: #ffffff;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: #343447;
        color: #ffffff;
    }

    .form-control::placeholder {
        color: #888;
    }

    .input-group-text {
        background: transparent;
        border: none;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        color: #888;
    }

    .btn-login {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 12px;
        padding: 15px;
        font-weight: 600;
        font-size: 1rem;
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.5);
        color: white;
        background: linear-gradient(135deg, #7c8bf0, #8a5fb8);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .forgot-password {
        color: #667eea;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #8a5fb8;
        text-decoration: underline;
    }

    .divider {
        position: relative;
        color: #888;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #404040;
    }

    .divider span {
        background: rgba(30, 30, 46, 0.95);
        padding: 0 15px;
        font-size: 0.9rem;
    }

    .form-loading {
        pointer-events: none;
        opacity: 0.6;
    }

    .form-loading .btn-login::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .toggle-password {
        cursor: pointer;
    }

    .toggle-password:hover {
        color: #667eea;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center p-4 bg-danger">
    <div class="login-container px-5 py-3 ">
        <div class="text-center mb-4">
            <div class="logo-container mx-auto mb-3 d-flex align-items-center justify-content-center">
                <i class="fas fa-camera fs-1 text-white"></i>
            </div>
            <h1 class="text-white fw-semibold mb-2">Studio Foto</h1>
            <p class="text-light mb-0" style="opacity: 0.8;">Register sebelum login</p>
        </div>
        <form id="loginForm" method="POST" action="/register">
            <div class="row">
                <!-- Username -->
                <div class="mb-3 col-12 ">
                    <label for="username" class="form-label fw-medium text-white">Username</label>
                    <div class="input-group position-relative">
                        <input type="text" class="form-control
                            <?php echo session('errors.username') ? 'is-invalid' : '' ?>" id="username" name="username"
                            placeholder="Masukkan Username" required value="<?php echo old('username') ?>">
                        <?php if (session('errors.username')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.username')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3 col-12 ">
                    <label for="password" class="form-label fw-medium text-white">Password</label>
                    <div class="input-group position-relative">
                        <input type="password" class="form-control
                            <?php echo session('errors.password') ? 'is-invalid' : '' ?>" id="password" name="password"
                            placeholder="Masukkan Password" required value="<?php echo old('password') ?>">
                        <span class="input-group-text toggle-password">
                            <i class="fas fa-eye"></i>
                        </span>
                        <?php if (session('errors.password')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.password')) ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
                <!-- Nama -->
                <div class="mb-3 col-12 ">
                    <label for="name" class="form-label fw-medium text-white">Nama</label>
                    <div class="input-group position-relative">
                        <input type="text" class="form-control
                        <?php echo session('errors.name') ? 'is-invalid' : '' ?>" id="name" name="name" required
                            placeholder="Masukkan Nama" value="<?php echo old('name') ?>">
                        <?php if (session('errors.name')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.name')) ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- No HP -->
                <div class="mb-3 col-12 ">
                    <label for="nohp" class="form-label fw-medium text-white">No HP</label>
                    <div class="input-group position-relative">
                        <input type="text" class="form-control
                        <?php echo session('errors.nohp') ? 'is-invalid' : '' ?>" id="nohp" name="nohp" required
                            placeholder="Contoh : 081234567890 " value="<?php echo old('nohp') ?>">
                        <?php if (session('errors.nohp')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.nohp')) ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
                <!-- Alamat -->
                <div class="mb-3 col-12">
                    <label for="address" class="form-label fw-medium text-white">Alamat</label>
                    <div class="input-group position-relative">
                        <input type="text" class="form-control
                        <?php echo session('errors.address') ? 'is-invalid' : '' ?>" id="address" name="address"
                            required placeholder="Masukkan address" value="<?php echo old('address') ?>">
                        <?php if (session('errors.address')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.address')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center mb-4">
                <div class="text-white">
                    Sudah punya akun? <a href="/login" class="forgot-password">Login</a>
                </div>
            </div>

            <!-- Tombol daftar -->
            <button type="submit" class="btn btn-login w-100 mb-3">
                <span class="btn-text">Daftar</span>
            </button>
        </form>


        <div class="text-center">
            <p class="text-light mb-0 small" style="opacity: 0.7;">&copy; 2025 Anisya Studios. All rights reserved.</p>
        </div>
    </div>

    <script src="<?php echo base_url() ?>/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/core/popper.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Moment JS -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/moment/moment.min.js"></script>

    <!-- Chart JS -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="<?php echo base_url() ?>/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="<?php echo base_url() ?>/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="<?php echo base_url() ?>/assets/js/setting-demo2.js"></script>

    <?php if (session()->getFlashdata('errors')): ?>
    <script>
    swal({
        title: "Gagal Register Periksa kembali inputan anda",
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
    <script>
    $(document).ready(function() {
        // Toggle password visibility
        $('.toggle-password').on('click', function() {
            const passwordField = $('#password');
            const icon = $(this).find('i');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        // Enhanced form interactions
        $('.form-control').on('focus', function() {
            $(this).closest('.input-group').addClass('focused');
        });

        $('.form-control').on('blur', function() {
            if (!$(this).val()) {
                $(this).closest('.input-group').removeClass('focused');
            }
        });
    });
    </script>
</body>

</html>