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
                                <form action="<?= base_url('admin/prosessurat/balas_surat/' . $id_surat_masuk) ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Perihal:</label>
                                        <input type="text" name="perihal" class="form-control" placeholder="Masukan perihal surat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Isi Surat:</label>
                                        <textarea name="isi_surat" class="form-control" placeholder="Masukan isi surat" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tujuan:</label>
                                        <input type="text" name="tujuan" class="form-control" value="<?= isset($tujuan_surat) ? $tujuan_surat : '' ?>" placeholder="Masukan tujuan surat" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                                    <a href="<?= base_url('admin/prosessurat') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
