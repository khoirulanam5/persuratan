<!DOCTYPE html>
<html lang="en">

<body class="  ">
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <div class="wrapper">
        <div class="content-page rtl-page">
            <?= $this->session->flashdata('pesan') ?>
		<div class="container-fluid">
			<div class="card">
				<h5 class="card-header"><?= $title ?></h5>
					<div class="card-body">
						<?php foreach ($arsip as $val) : ?>
							<div class="row">
								<div class="col-md-12">
									<table class="table">
										<tr>
											<td>ID Arsip</td>
											<td><strong>: <?php echo $val->id_arsip ?></strong></td>
										</tr>
										<tr>
											<td>ID Surat</td>
											<td><strong>: <?php echo $val->id_surat ?></strong></td>
										</tr>
										<tr>
											<td>Tanggal Kirim</td>
											<td><strong>: <?php echo do_formal_date($val->tgl_kirim) ?></strong></td>
										</tr>
										<tr>
											<td>Jenis Surat</td>
											<td><strong>: <?php echo $val->jenis_surat ?></strong></td>
										</tr>
										<?php if(empty($val->file)): ?>
										<tr>
											<td>Isi Surat</td>
											<td><strong>: <?php echo $val->isi_surat ?></strong></td>
										</tr>
										<?php endif; ?>
										<tr>
											<td>Lokasi Pengarsipan</td>
											<td><strong>: <?php echo $val->lokasi_arsip ?></strong></td>
										</tr>
										<tr>
											<td>Tanggal Pengarsipan</td>
											<td><strong>: <?php echo do_formal_date($val->tgl_arsip) ?></strong></td>
										</tr>
										<?php if(empty($val->isi_surat)): ?>
										<tr>
											<td>File Isi Surat</td>
											<td><a href="<?= base_url('assets/img/surat_masuk/' . $val->file) ?>" target="_blank" class="badge badge-success"><strong><?php echo $val->file ?></strong></a></td>
										</tr>
										<?php endif; ?>
									</table>
									<div align="left">
										<a class="btn btn-sm btn-primary" href="<?= base_url('admin/arsip/') ?>">Kembali</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
          	</div>
        </div>
	</div>