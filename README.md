# Dukunify - Sistem Manajemen Booking Jasa Sewa Dukun

Sistem manajemen berbasis web yang dirancang untuk mengelola pemesanan (booking) dan penyelesaian jasa spiritual/supranatural.

---

## Detail Proyek

* **Nama Kelompok:**
    * Rilga Lingga Wisesa    
    * Raden Daffa Firasyan Adikusumah
* **Nama Team:** Dukunify
* **Nama Project:** Dukunify - Sistem Sewa Jasa Dukun

---

## Daftar Fitur

Sistem ini memiliki dua peran utama: **Admin** dan **User (Anggota/Klien)**.

### Fitur Umum
* Setiap pengguna (Admin/User) harus melakukan **Login** untuk dapat mengakses *web*.
* User harus terdaftar sebagai anggota untuk dapat mem-booking jasa.
* Satu user hanya dapat memiliki satu profil.

### Fitur User (Anggota/Klien)
* Dapat mengubah data profilnya masing-masing.
* Dapat melihat katalog jasa yang tersedia.
* Dapat melakukan pencarian jasa berdasarkan nama jasa.
* Hanya dapat mem-booking **maksimal 2 jasa** yang statusnya masih aktif ('dipesan').
* Hanya dapat melihat daftar jasa yang sedang di-booking olehnya.

### Fitur Admin
* Dapat melakukan **CRUD** (Create, Read, Update, Delete) untuk data **Jasa/Layanan**.
* Dapat melakukan **CRUD** (Create, Read, Update, Delete) untuk data **Kategori Jasa**.
* Dapat melakukan **CRUD** (Create, Read, Update, Delete) untuk data **User (Anggota)**.
* Hanya Admin yang dapat memproses **Penyelesaian Jasa** (mengubah status booking menjadi 'selesai').
* Admin dapat melihat daftar semua jasa yang sedang di-booking oleh semua *user*.
* Admin dapat melihat dan **mencetak riwayat** booking jasa dari semua *user*.

### Aturan Bisnis
* **Jasa:** `nama_jasa` boleh sama, namun `kode_jasa` harus unik.
* **Kategori:** Setiap jasa dapat memiliki lebih dari satu kategori (Many-to-Many).
* **Booking:** Aturan "maksimal 5 hari" dan "denda" diubah menjadi proses konfirmasi oleh Admin. Klien harus menghubungi admin untuk konfirmasi jadwal dan penyelesaian.
* **Validasi:** Setiap *field input* yang wajib diisi (seperti nama, email, kode jasa) memiliki validasi `required`.

---

## Skema Database (ERD)

![Skema Database Dukunify]([GANTI_DENGAN_PATH_GAMBAR_ERD_ANDA.png])

---

## Demo Website

[Tonton Video Demo Penjelasan Website di Sini]([LINK_VIDEO_DEMO_ANDA])
