<!DOCTYPE html>
<html lang="en">

<body>
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <div class="wrapper">
        <div class="content-page rtl-page">
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
                                <form action="<?= base_url('tamu/kirimsurat/edit/' . $surat->id_surat_masuk) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_surat_masuk" value="<?= $surat->id_surat_masuk ?>">

                                    <div class="form-group">
                                        <label>Perihal:</label>
                                        <input type="text" name="perihal" value="<?= $surat->perihal ?>" class="form-control" placeholder="Masukkan perihal surat" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Isi Surat:</label>
                                        <textarea name="isi_surat" class="form-control" placeholder="Masukkan isi surat" required><?= $surat->isi_surat ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>File Surat:</label><br>
                                        <?php if (!empty($surat->file)): ?>
                                            <a href="<?= base_url('assets/img/surat_masuk/' . $surat->file) ?>" target="_blank" class="badge badge-primary">
                                                Lihat File
                                            </a>
                                        <?php endif; ?>
                                        <input type="file" name="file" class="form-control">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('tamu/kirimsurat') ?>" class="btn btn-sm btn-secondary">Batal</a>
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
