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
                                <form action="<?= base_url('admin/pegawai/edit/' . $pegawai->id_user) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_user" value="<?= $pegawai->id_user ?>">
                                    
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" name="username" value="<?= $pegawai->username ?>" class="form-control" placeholder="Masukkan username" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" name="password" value="<?= $pegawai->password ?>" class="form-control" placeholder="Masukkan password" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Devisi:</label>
                                        <select name="devisi" class="form-control" required>
                                            <option value="">Pilih Devisi</option>
                                            <option value="Inspektur" <?= $pegawai->devisi == 'Inspektur' ? 'selected' : '' ?>>Inspektur</option>
                                            <option value="Sekretariat" <?= $pegawai->devisi == 'Sekretariat' ? 'selected' : '' ?>>Sekretariat</option>
                                            <option value="Administrasi" <?= $pegawai->devisi == 'Administrasi' ? 'selected' : '' ?>>Administrasi</option>
                                            <option value="Irban 1" <?= $pegawai->devisi == 'Irban 1' ? 'selected' : '' ?>>Irban 1</option>
                                            <option value="Irban 2" <?= $pegawai->devisi == 'Irban 2' ? 'selected' : '' ?>>Irban 2</option>
                                            <option value="Irban 3" <?= $pegawai->devisi == 'Irban 3' ? 'selected' : '' ?>>Irban 3</option>
                                            <option value="Irban 4" <?= $pegawai->devisi == 'Irban 4' ? 'selected' : '' ?>>Irban 4</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Nama Lengkap:</label>
                                        <input type="text" name="nm_pengguna" value="<?= $pegawai->nm_pengguna ?>" class="form-control" placeholder="Masukkan nama lengkap" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Jenis Kelamin:</label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Pria" <?= $pegawai->jenis_kelamin == 'Pria' ? 'selected' : '' ?>>Pria</option>
                                            <option value="Wanita" <?= $pegawai->jenis_kelamin == 'Wanita' ? 'selected' : '' ?>>Wanita</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Nomor HP:</label>
                                        <input type="number" name="no_hp" value="<?= $pegawai->no_hp ?>" class="form-control" placeholder="Masukkan nomor HP" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required><?= $pegawai->alamat ?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Foto:</label><br>
                                        <?php if (!empty($pegawai->foto)): ?>
                                            <img src="<?= base_url('assets/img/user/' . $pegawai->foto) ?>" alt="Foto Profil" class="img-thumbnail mb-2" width="150">
                                        <?php endif; ?>
                                        <input type="file" name="foto" class="form-control">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('admin/pegawai') ?>" class="btn btn-sm btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>