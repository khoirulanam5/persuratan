<!DOCTYPE html>
<html lang="en">

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page rtl-page">
            <!-- Halaman content -->
            <?= $this->session->flashdata('pesan') ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('admin/pegawai/add') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" name="username" class="form-control" placeholder="Masukan username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" name="password" class="form-control" placeholder="Masukan password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lengkap:</label>
                                        <input type="text" name="nm_pengguna" class="form-control" placeholder="Masukan nama lengkap" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin:</label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Devisi:</label>
                                        <select name="devisi" class="form-control" required>
                                            <option value="">Pilih Devisi</option>
                                            <option value="Inspektur">Inspektur</option>
                                            <option value="Sekretariat">Sekretariat</option>
                                            <option value="Administrasi">Administrasi</option>
                                            <option value="Irban 1">Irban 1</option>
                                            <option value="Irban 2">Irban 2</option>
                                            <option value="Irban 3">Irban 3</option>
                                            <option value="Irban 4">Irban 4</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <textarea name="alamat" class="form-control" placeholder="Masukan alamat lengkap" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor HP:</label>
                                        <input type="number" name="no_hp" class="form-control" placeholder="Masukan nomor HP" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto:</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('admin/pegawai') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
