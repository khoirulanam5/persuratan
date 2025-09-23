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
                                <form action="<?= base_url('pegawai/user/edit/' . $user->id_user) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                    
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" name="username" value="<?= $user->username ?>" class="form-control" placeholder="Masukkan username" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" name="password" value="<?= $user->password ?>" class="form-control" placeholder="Masukkan password" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Jabatan:</label>
                                        <select name="level" class="form-control" required>
                                            <option value="">-- Pilih Level --</option>
                                            <option value="ADMIN" <?= $user->level == 'ADMIN' ? 'selected' : '' ?>>Admin</option>
                                            <option value="PEGAWAI" <?= $user->level == 'PEGAWAI' ? 'selected' : '' ?>>Pegawai</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Devisi:</label>
                                        <select name="devisi" class="form-control" required>
                                            <option value="">Pilih Devisi</option>
                                            <option value="Inspektur" <?= $user->devisi == 'Inspektur' ? 'selected' : '' ?>>Inspektur</option>
                                            <option value="Sekretariat" <?= $user->devisi == 'Sekretariat' ? 'selected' : '' ?>>Sekretariat</option>
                                            <option value="Administrasi" <?= $user->devisi == 'Administrasi' ? 'selected' : '' ?>>Administrasi</option>
                                            <option value="Irban 1" <?= $user->devisi == 'Irban 1' ? 'selected' : '' ?>>Irban 1</option>
                                            <option value="Irban 2" <?= $user->devisi == 'Irban 2' ? 'selected' : '' ?>>Irban 2</option>
                                            <option value="Irban 3" <?= $user->devisi == 'Irban 3' ? 'selected' : '' ?>>Irban 3</option>
                                            <option value="Irban 4" <?= $user->devisi == 'Irban 4' ? 'selected' : '' ?>>Irban 4</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Nama Lengkap:</label>
                                        <input type="text" name="nm_pengguna" value="<?= $user->nm_pengguna ?>" class="form-control" placeholder="Masukkan nama lengkap" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Jenis Kelamin:</label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Pria" <?= $user->jenis_kelamin == 'Pria' ? 'selected' : '' ?>>Pria</option>
                                            <option value="Wanita" <?= $user->jenis_kelamin == 'Wanita' ? 'selected' : '' ?>>Wanita</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Nomor HP:</label>
                                        <input type="number" name="no_hp" value="<?= $user->no_hp ?>" class="form-control" placeholder="Masukkan nomor HP" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required><?= $user->alamat ?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Foto:</label><br>
                                        <?php if (!empty($user->foto)): ?>
                                            <img src="<?= base_url('assets/img/user/' . $user->foto) ?>" alt="Foto Profil" class="img-thumbnail mb-2" width="150">
                                        <?php endif; ?>
                                        <input type="file" name="foto" class="form-control">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('pegawai/user') ?>" class="btn btn-sm btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>