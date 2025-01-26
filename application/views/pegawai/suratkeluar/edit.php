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
                                    <h4 class="card-title">Edit Surat</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <form action="<?= base_url('pegawai/suratkeluar/edit/' . $id_surat_keluar) ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Perihal:</label>
                                    <input type="text" name="perihal" class="form-control" value="<?= $surat->perihal ?>" placeholder="Masukan perihal surat" required>
                                </div>
                                <div class="form-group">
                                    <label>Isi Surat:</label>
                                    <textarea name="isi_surat" class="form-control" placeholder="Masukan isi surat" rows="3" required><?= $surat->isi_surat ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tujuan:</label>
                                    <select class="form-control" name="tujuan" required>
                                        <option value="">Pilih Tujuan Surat</option>
                                        <?php foreach($tujuan as $val): ?>
                                            <option value="<?= $val->nm_pengguna ?>" <?= $val->nm_pengguna == $surat->tujuan ? 'selected' : '' ?>>
                                                <?= $val->nm_pengguna ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                <a href="<?= base_url('pegawai/suratkeluar') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
