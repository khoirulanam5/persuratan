<!DOCTYPE html>
<html lang="en">

<body class="">
    <!-- Loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- Loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page rtl-page">
            <!-- Halaman Content -->
            <?= $this->session->flashdata('pesan') ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-between mb-4">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6 text-right">
                                        <a href="<?= base_url('admin/surat_keluar/add') ?>" class="btn btn-sm btn-primary">Buat Surat</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomer Surat</th>
                                                <th>Kepada</th>
                                                <th>Jenis Surat</th>
                                                <th>Perihal</th>
                                                <th>Tanggal Buat</th>
                                                <th>File</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($surat_keluar as $val): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $val->nomor ?></td>
                                                    <td><?= $val->kepada ?></td>
                                                    <td><?= $val->jenis ?></td>
                                                    <td><?= $val->perihal ?></td>
                                                    <td><?= do_formal_date($val->tgl_buat); ?></td>
                                                    <td>
                                                        <a href="<?= base_url('assets/img/surat_keluar/' . $val->file) ?>" class="badge badge-primary" target="_blank">Lihat File</a>
                                                    </td>
                                                    <td><?= $val->status ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Ubah Status
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="<?= base_url('pegawai/surat_keluar/setuju/') . $val->id_surat_keluar ?>">
                                                                    ✅ Setuju
                                                                </a>
                                                                <a class="dropdown-item text-danger" href="<?= base_url('pegawai/surat_keluar/tolak/') . $val->id_surat_keluar ?>">
                                                                    ❌ Tidak Setuju
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
