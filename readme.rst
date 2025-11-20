# 📄 Sistem Informasi Surat Masuk & Surat Keluar Kedinasan  
### 📨 Manajemen Arsip Surat Berbasis Web

Sistem ini dibuat untuk mempermudah instansi dalam mengelola **surat masuk** dan **surat keluar** secara digital. Dengan fitur pencatatan, pengarsipan, disposisi, hingga pelacakan status surat, sistem ini membantu proses administrasi menjadi lebih cepat, tertata, dan akurat.

---

## 🚀 Fitur Utama

### 🔐 Role & Hak Akses

#### 👤 **Admin**
- Mengelola pengguna & role
- Input surat masuk
- Input surat keluar
- Mengelola disposisi
- Mengelola klasifikasi surat
- Melihat dan cetak laporan lengkap

#### 👥 **Pegawai**
- Melihat surat masuk
- Melihat surat keluar
- Menerima disposisi
- Mengupdate status tindak lanjut
- Mengunggah berkas surat (opsional)

---

## 📥 Surat Masuk
- Input data surat masuk
- Upload file (PDF/JPG)
- Pencatatan asal surat, nomor surat, tanggal terima
- Pendisposisian ke pegawai terkait
- Tracking status surat

## 📤 Surat Keluar
- Input data surat keluar
- Upload file surat
- Pencatatan tujuan, nomor surat, tanggal kirim
- Riwayat surat keluar

---

## 🖥️ Teknologi yang Digunakan

| Komponen     | Teknologi |
|--------------|-----------|
| Backend      | CodeIgniter 3 |
| Database     | MySQL |
| Frontend     | HTML, CSS, JavaScript, Bootstrap |
| Arsitektur   | MVC |

---

## 📦 Modul Sistem

### 📁 Data Master
- Data user
- Data pegawai
- Klasifikasi surat

### 📨 Surat Masuk
- Input & upload dokumen
- Disposisi surat
- Tracking status
- Riwayat tindakan

### 📤 Surat Keluar
- Input & upload dokumen
- Nomor surat otomatis/manual
- Riwayat pengiriman

### 📊 Laporan
- Laporan surat masuk
- Laporan surat keluar
- Filter berdasarkan tanggal, pegawai, klasifikasi
- Export PDF (opsional)

---

## 🛠️ Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/repo.git
