# PRD Link Tree Sederhana

## 1. Ringkasan Produk

Proyek ini adalah aplikasi **link tree sederhana** yang memungkinkan satu pengguna membuat satu halaman profil publik berisi kumpulan tautan penting. Halaman ini ditujukan untuk dipakai sebagai pusat trafik dari media sosial, bio profil, portofolio, atau kontak bisnis.

Target awal proyek adalah membangun **MVP yang cepat dipakai**, mudah dikelola, dan cukup fleksibel untuk dikembangkan ke fitur yang lebih lengkap di fase berikutnya.

## 2. Tujuan Produk

### Tujuan Utama

- Memberikan satu URL publik yang merangkum semua tautan penting pengguna.
- Memudahkan pengguna mengatur urutan dan visibilitas tautan tanpa perlu edit kode.
- Menyediakan fondasi Laravel yang rapi untuk pengembangan fitur lanjutan.

### Indikator Keberhasilan MVP

- Pengguna dapat login ke dashboard admin sederhana.
- Pengguna dapat membuat, mengubah, menghapus, mengaktifkan, dan mengurutkan link.
- Pengguna memiliki satu halaman publik yang bisa diakses tanpa login.
- Pengunjung dapat membuka link dari halaman publik dengan tampilan yang rapi di mobile dan desktop.

## 3. Masalah yang Ingin Diselesaikan

Pengguna sering memiliki banyak link penting, tetapi platform seperti Instagram, TikTok, atau X biasanya hanya memberi satu kolom tautan. Akibatnya, pengguna membutuhkan satu halaman sederhana yang:

- mudah dibagikan,
- mudah diperbarui,
- tidak bergantung pada edit manual,
- tetap terlihat profesional.

## 4. Target Pengguna

### Pengguna Admin

Pemilik halaman link tree yang ingin mengelola profil dan daftar link sendiri.

### Pengunjung Publik

Orang yang membuka halaman link tree untuk mencari tautan tertentu, seperti WhatsApp, toko, portofolio, CV, atau sosial media.

## 5. Ruang Lingkup MVP

### Fitur Dalam Scope

- Halaman publik link tree.
- Identitas dasar profil:
  - nama tampilan,
  - username atau slug URL,
  - foto profil atau avatar,
  - bio singkat.
- Manajemen link pada dashboard:
  - tambah link,
  - edit link,
  - hapus link,
  - ubah status aktif/nonaktif,
  - atur urutan tampil.
- Data link minimal:
  - judul link,
  - URL tujuan,
  - icon atau label opsional,
  - status aktif,
  - nomor urut.
- Validasi URL.
- Halaman 404 bila slug tidak ditemukan.

### Fitur Di Luar Scope MVP

- Multi-user kompleks dengan banyak role.
- Analytics detail per link.
- Tema kustom per pengguna.
- Short link.
- Penjadwalan link tayang.
- Drag and drop canggih bila belum diperlukan.
- Integrasi pihak ketiga seperti Meta Pixel, Google Analytics, atau payment link builder.

## 6. User Story

### Sebagai Admin

- Saya ingin login agar bisa mengelola halaman saya.
- Saya ingin memperbarui nama, bio, dan avatar agar halaman terlihat sesuai identitas saya.
- Saya ingin menambah link agar pengunjung bisa menuju channel yang saya inginkan.
- Saya ingin menonaktifkan link sementara tanpa menghapusnya.
- Saya ingin mengatur urutan link agar CTA utama muncul paling atas.

### Sebagai Pengunjung

- Saya ingin membuka satu halaman ringkas berisi semua link penting.
- Saya ingin tampilan cepat dimuat di perangkat mobile.
- Saya ingin langsung menuju link tujuan saat tombol ditekan.

## 7. Alur Pengguna

### Alur Admin

1. Admin login.
2. Admin membuka dashboard.
3. Admin mengisi data profil dasar.
4. Admin menambahkan satu atau lebih link.
5. Admin mengatur urutan dan status aktif link.
6. Admin membuka preview atau halaman publik.

### Alur Pengunjung

1. Pengunjung membuka URL publik.
2. Pengunjung melihat profil singkat dan daftar link aktif.
3. Pengunjung menekan salah satu tombol link.
4. Sistem mengarahkan pengunjung ke URL tujuan.

## 8. Kebutuhan Fungsional

### Halaman Publik

- Sistem menampilkan profil publik berdasarkan slug.
- Sistem hanya menampilkan link yang aktif.
- Sistem menampilkan link sesuai urutan yang diatur admin.
- Tombol link harus jelas dan mudah disentuh di mobile.

### Dashboard Admin

- Admin dapat mengubah informasi profil.
- Admin dapat melakukan CRUD link.
- Admin dapat mengubah posisi urutan link.
- Admin dapat mengubah status aktif/nonaktif link.
- Admin dapat melihat URL publik miliknya.

### Validasi

- URL link harus valid.
- Judul link wajib diisi.
- Slug harus unik.

## 9. Kebutuhan Non-Fungsional

- Antarmuka mobile-first.
- Implementasi UI menggunakan Tailwind CSS v4.
- Waktu muat halaman publik ringan.
- Struktur kode mengikuti pola Laravel standar.
- Halaman publik dapat di-render dengan baik tanpa ketergantungan yang berlebihan.
- Validasi dan sanitasi input dasar harus diterapkan.

## 10. Arah Tema dan Visual

Tema produk harus mengikuti arah berikut:

- `clean`: layout rapi, fokus pada konten utama, dan minim elemen dekoratif yang tidak perlu.
- `modern`: memakai spacing lega, tipografi jelas, radius halus, shadow ringan, dan hirarki visual yang tegas.
- `light mode`: tampilan utama menggunakan latar terang, kontras teks yang nyaman dibaca, dan tidak mengandalkan dark mode sebagai mode utama.
- `tailwind-based`: seluruh styling utama diimplementasikan menggunakan Tailwind CSS agar konsisten, cepat dikembangkan, dan mudah dirawat.

### Prinsip UI

- Mobile-first karena mayoritas akses halaman link tree berasal dari perangkat mobile.
- Halaman publik harus terasa ringan, cepat dibaca, dan langsung mengarahkan perhatian ke tombol link.
- Dashboard admin cukup sederhana, fungsional, dan konsisten dengan tema publik.
- Hindari tampilan terlalu ramai, warna berlebihan, atau ornamen yang mengganggu CTA utama.

### Arah Komponen Visual

- Background: terang, bersih, dengan nuansa netral atau soft accent yang tipis.
- Card atau container: rounded modern, shadow halus, dan padding lega.
- Tombol link: tinggi klik nyaman, lebar penuh di mobile, state hover/focus jelas.
- Tipografi: sans-serif modern, mudah dibaca, dengan penekanan kuat pada nama profil dan judul link.
- Warna: dominan putih, abu terang, teks gelap, dan satu warna aksen utama untuk CTA.

### Batasan Tema MVP

- Belum perlu theme switcher.
- Belum perlu dark mode sebagai fitur utama.
- Belum perlu kustomisasi tema per user.
- Fokus pada satu default theme yang polished dan konsisten.

## 11. Rancangan Data Awal

### Entitas `users`

- Menyimpan akun admin.

### Entitas `profiles`

- `user_id`
- `display_name`
- `slug`
- `bio`
- `avatar_path`

### Entitas `links`

- `profile_id`
- `title`
- `url`
- `icon`
- `is_active`
- `sort_order`

Catatan:
Untuk versi paling sederhana, data profil juga bisa ditempatkan langsung di tabel `users`. Namun, penggunaan tabel `profiles` lebih rapi bila proyek akan dikembangkan.

## 12. Rancangan Halaman

### Halaman Publik

- Avatar
- Nama tampilan
- Bio singkat
- Daftar tombol link
- Layout terpusat dengan lebar konten yang nyaman dibaca
- Visual bersih, light mode, dan fokus ke CTA

### Dashboard

- Form profil
- Tabel atau daftar link
- Tombol tambah link
- Aksi edit, hapus, aktif/nonaktif, dan ubah urutan
- Styling konsisten dengan tema clean modern berbasis Tailwind

## 13. Prioritas Implementasi

### Fase 1 - Fondasi

- Setup auth sederhana.
- Buat struktur database profil dan link.
- Buat route dashboard dan route publik berbasis slug.

### Fase 2 - MVP Berjalan

- CRUD profil.
- CRUD link.
- Tampilkan halaman publik.
- Validasi dan styling dasar.

### Fase 3 - Penyempurnaan

- Preview halaman publik dari dashboard.
- Perbaikan UX pengurutan link.
- Tracking klik sederhana jika dibutuhkan.

## 14. Acceptance Criteria MVP

- Admin dapat login dan logout.
- Admin dapat menyimpan data profil tanpa error.
- Admin dapat menambah minimal 1 link aktif.
- Admin dapat mengedit dan menghapus link.
- Admin dapat mengubah urutan link dan hasilnya tercermin di halaman publik.
- Pengunjung dapat membuka halaman publik melalui slug.
- Hanya link aktif yang tampil di halaman publik.
- Jika slug tidak ada, sistem menampilkan 404.
- Halaman publik tampil rapi dalam tema clean, modern, light mode.
- Styling utama halaman publik dan dashboard menggunakan Tailwind CSS.

## 15. Risiko dan Catatan

- Jika autentikasi belum diputuskan, implementasi dashboard bisa tertunda.
- Jika upload avatar dipakai sejak awal, perlu keputusan penyimpanan file.
- Jika proyek ingin mendukung banyak halaman per user, struktur data perlu disiapkan berbeda dari MVP sederhana ini.

## 16. Pertanyaan Terbuka

- Apakah sistem hanya untuk satu admin atau banyak user?
- Apakah slug publik dibuat otomatis dari nama atau diisi manual?
- Apakah avatar wajib atau opsional?
- Apakah butuh statistik klik sejak fase awal?
- Apakah dashboard cukup server-rendered Blade atau akan memakai frontend yang lebih interaktif?

## 17. Rekomendasi Implementasi untuk Repo Ini

Melihat struktur proyek saat ini yang masih sangat dasar, pendekatan paling efisien adalah:

- memakai Blade untuk halaman publik dan dashboard awal,
- memakai auth bawaan Laravel yang sederhana,
- membuat model `Profile` dan `Link`,
- memakai route publik berbasis slug seperti `/{slug}`,
- memakai Tailwind CSS v4 sebagai basis seluruh styling MVP,
- menetapkan satu theme default yang clean, modern, dan light mode sejak awal,
- menjaga MVP tetap kecil sampai alur utama stabil.
