<!-- Sidebar -->
<div class="iq-sidebar rtl-iq-sidebar sidebar-default">
        <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
            <a href="<?= base_url('dashboard') ?>" class="header-logo">
                <img src="<?= base_url('assets/images/loading.png') ?>" class="img-fluid rounded-normal light-logo" alt="logo">
                <img src="<?= base_url('assets/images/loading.png') ?>" class="img-fluid rounded-normal darkmode-logo" alt="logo">
            </a>
            <div class="ml-3 logo-text">
                <p class="mt-2 mb-0 font-weight-bold">Inspektorat</p>
                <p class="text-muted small">Kabupaten Kudus</p>
            </div>
            <div class="iq-menu-bt-sidebar">
                <i class="las la-bars wrapper-menu"></i>
            </div>
        </div>
        <div class="data-scrollbar" data-scroll="1">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="<?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard') ?>"><i class="las la-home"></i><span>Dashboard</span></a>
                    </li>

                    <?php if ($this->session->userdata('level') == 'ADMIN'): ?>
                        <li class="<?= $this->uri->segment(2) == 'suratmasuk' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/suratmasuk') ?>"><i class="las la-envelope-open-text"></i><span>Surat Masuk</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'prosessurat' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/prosessurat') ?>"><i class="las la-tasks"></i><span>Proses Surat</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'arsip' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/arsip') ?>"><i class="las la-archive"></i><span>Arsip Surat</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'user' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/user') ?>"><i class="las la-user"></i><span>Data User</span></a>
                        </li>
                    <?php endif; ?>

                    <?php if ($this->session->userdata('level') == 'PEGAWAI'): ?>
                        <li class="<?= $this->uri->segment(2) == 'suratmasuk' ? 'active' : '' ?>">
                            <a href="<?= base_url('pegawai/suratmasuk') ?>"><i class="las la-envelope-open-text"></i><span>Surat Masuk</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'suratkeluar' ? 'active' : '' ?>">
                            <a href="<?= base_url('pegawai/suratkeluar') ?>"><i class="fas fa-envelope-open"></i><span>Proses Surat Keluar</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'arsip' ? 'active' : '' ?>">
                            <a href="<?= base_url('pegawai/arsip') ?>"><i class="las la-archive"></i><span>Arsip Surat</span></a>
                        </li>
                    <?php endif; ?>

                    <?php if ($this->session->userdata('level') == 'TAMU'): ?>
                        <li class="<?= $this->uri->segment(2) == 'kirimsurat' ? 'active' : '' ?>">
                            <a href="<?= base_url('tamu/kirimsurat') ?>"><i class="las la-paper-plane"></i><span>Kirim Surat</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'suratterima' ? 'active' : '' ?>">
                            <a href="<?= base_url('tamu/suratterima') ?>"><i class="las la-envelope-open-text"></i><span>Surat Masuk</span></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>