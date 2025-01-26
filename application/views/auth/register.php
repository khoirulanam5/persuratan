<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inspektorat Daerah</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/') ?>images/loading.png" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/backend-plugin.min.css?v=2.0.0">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/backend.css?v=2.0.0">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/@icon/dripicons/dripicons.css">
    <link rel='stylesheet' href='<?= base_url('assets/') ?>vendor/fullcalendar/core/main.css' />
    <link rel='stylesheet' href='<?= base_url('assets/') ?>vendor/fullcalendar/daygrid/main.css' />
    <link rel='stylesheet' href='<?= base_url('assets/') ?>vendor/fullcalendar/timegrid/main.css' />
    <link rel='stylesheet' href='<?= base_url('assets/') ?>vendor/fullcalendar/list/main.css' />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/mapbox/mapbox-gl.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-lg-6 ">
                                <h2 class="mb-2">Pendaftaran</h2>
                                <p>Silahkan lengkapi form pendaftaran dibawah ini</p>
                                <form action="<?= base_url('auth/register') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="text" name="username" required>
                                                <label>Username</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="password" name="password" required>
                                                <label>Password</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="text" name="nm_pengguna" required>
                                                <label>Nama Lengkap</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <select type="text" name="jenis_kelamin" class="floating-input form-control" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="Pria">Pria</option>
                                                    <option value="Wanita">Wanita</option>
                                                </select>
                                                <label>Jenis Kelamin</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="number" name="no_hp" required>
                                                <label>Nomor Hp</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="text" name="alamat" required>
                                                <label>Alamat Lengkap</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                    <p class="mt-3">
                                        Sudah punya akun? <a href="<?= base_url('auth') ?>" class="text-primary">Login Disini</a>
                                    </p>
                                </form>
                            </div>
                            <div class="col-lg-6 mb-lg-0 mb-4 mt-lg-0 mt-4">
                                <img src="<?= base_url('assets/') ?>images/login/img1.jpeg" class="img-fluid w-80" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="custom-control-inline change-rtl">

        <a href="#" class="switch-rtl" data-active="true" for="rtl-mode" data-mode="rtl">RTL</a>
    </div>





    <!-- Backend Bundle JavaScript -->
    <script src="<?= base_url('assets/') ?>js/backend-bundle.min.js"></script>

    <!-- Flextree Javascript-->
    <script src="<?= base_url('assets/') ?>js/flex-tree.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/tree.js"></script>

    <!-- Table Treeview JavaScript -->
    <script src="<?= base_url('assets/') ?>js/table-treeview.js"></script>

    <!-- Masonary Gallery Javascript -->
    <script src="<?= base_url('assets/') ?>js/masonry.pkgd.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/imagesloaded.pkgd.min.js"></script>

    <!-- Mapbox Javascript -->
    <script src="<?= base_url('assets/') ?>js/mapbox-gl.js"></script>
    <script src="<?= base_url('assets/') ?>js/mapbox.js"></script>

    <!-- Fullcalender Javascript -->
    <script src='<?= base_url('assets/') ?>vendor/fullcalendar/core/main.js'></script>
    <script src='<?= base_url('assets/') ?>vendor/fullcalendar/daygrid/main.js'></script>
    <script src='<?= base_url('assets/') ?>vendor/fullcalendar/timegrid/main.js'></script>
    <script src='<?= base_url('assets/') ?>vendor/fullcalendar/list/main.js'></script>

    <!-- SweetAlert JavaScript -->
    <script src="<?= base_url('assets/') ?>js/sweetalert.js"></script>

    <!-- Vectoe Map JavaScript -->
    <script src="<?= base_url('assets/') ?>js/vector-map-custom.js"></script>

    <!-- Chart Custom JavaScript -->
    <script src="<?= base_url('assets/') ?>js/customizer.js"></script>
    <script src="<?= base_url('assets/') ?>js/rtl.js"></script>

    <!-- Chart Custom JavaScript -->
    <script src="<?= base_url('assets/') ?>js/chart-custom.js"></script>

    <!-- slider JavaScript -->
    <script src="<?= base_url('assets/') ?>js/slider.js"></script>

    <!-- app JavaScript -->
    <script src="<?= base_url('assets/') ?>js/app.js"></script>
</body>

</html>