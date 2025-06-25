<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register | AdminLTE 4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tambahkan CSS sesuai struktur proyekmu -->
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="register-page bg-body-secondary">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url('/') ?>" class="h1"><b>Selamat </b>Datang</a>
            </div>
            <div class="card-body register-card-body">
                <p class="register-box-msg">Belum punya akun? Daftar dulu sini</p>
                <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form action="<?= site_url('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input name="nama" type="text" class="form-control" placeholder="Full Name"
                            value="<?= old('nama') ?>">
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email"
                            value="<?= old('email') ?>">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" required>
                                <label class="form-check-label">I agree to the <a href="#">terms</a></label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3 mb-0 text-center">
                    <a href="<?= base_url('login') ?>" class="text-center">Sudah Punya akun</a>
                </p>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/adminlte.js') ?>"></script>
</body>

</html>