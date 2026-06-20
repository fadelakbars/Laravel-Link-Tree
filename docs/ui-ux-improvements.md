# Panduan Perbaikan UI/UX - Link Tree

Dokumen ini berisi hasil audit UI/UX serta rekomendasi perbaikan untuk mencapai tema **Clean, Modern, Minimalis, dan Light Mode**.

## 1. Hasil Audit Keseluruhan

### Dashboard (User Panel)
- **Terlalu Padat (Cluttered):** Halaman dashboard saat ini menggabungkan Edit Profil, Preview Profil, Form Tambah Link, dan Daftar Link dalam satu tampilan grid yang sangat ramai.
- **Hierarki Visual:** Informasi "Status Tahap Ini" di sidebar lebih bersifat catatan developer dan kurang relevan bagi pengguna akhir.
- **Interaksi Link:** Penggunaan elemen `<details>` untuk manajemen link cukup fungsional tapi terasa kurang premium untuk skala projek modern.
- **Form Statis:** Form "Tambah Link" yang selalu terbuka memakan ruang vertikal yang besar, terutama di perangkat mobile.

### Landing Page & Public Profile
- **Sudah Cukup Baik:** Desain dasar sudah menggunakan rounded corners yang konsisten (`2xl` ke atas) dan shadow yang lembut.
- **Kontras:** Beberapa teks pada background `slate-50` mungkin perlu diperkuat sedikit kontrasnya untuk aksesibilitas.

### Konsistensi Visual
- **Shadow & Border:** Terlalu banyak penggunaan border dan shadow pada setiap elemen kecil membuat tampilan terasa "berat" (boxy).
- **Warna:** Palet warna brand (`oklch`) sudah sangat modern dan perlu dipertahankan.

---

## 2. Strategi Perbaikan (Roadmap)

### Fase A: Pembersihan Dashboard (Prio Tinggi)
- **Navigasi Tab/Sidebar:** Memisahkan "Links" dan "Pengaturan Profil" ke dalam halaman atau tab yang berbeda.
- **Modalkan Form Tambah Link:** Menggunakan Modal atau Drawer untuk menambah link baru agar halaman utama tetap bersih.
- **Pembersihan Sidebar:** Menghapus info "Status Tahap" dan menggantinya dengan statistik ringkas atau Tips penggunaan.

### Fase B: Peningkatan Komponen Link
- **Compact List:** Membuat daftar link yang lebih ramping dengan aksi cepat (Toggle Aktif, Edit, Hapus) tanpa harus membuka dropdown besar.
- **Drag & Drop (Optional):** Implementasi pengurutan dengan drag & drop (menggunakan library ringan seperti SortableJS) daripada tombol "Naik/Turun" manual.
- **Preview Live:** Membuat preview profil publik di dashboard benar-benar menyerupai tampilan aslinya (miniature view).

### Fase C: Refinement Desain (Minimalisme)
- **Soft UI:** Mengurangi penggunaan border hitam tipis, beralih ke subtle shadows atau perbedaan warna background yang sangat halus.
- **Typography:** Memaksimalkan penggunaan font 'Instrument Sans' dengan variasi weight yang tepat untuk membedakan level informasi tanpa perlu banyak dekorasi.
- **Empty States:** Mempercantik tampilan saat belum ada link dengan ilustrasi minimalis atau instruksi yang lebih user-friendly.

---

## 3. Contoh Implementasi Teknis (Rekomendasi)

### Struktur Navigasi Dashboard
Alih-alih grid besar, gunakan layout sidebar:
```blade
<div class="flex flex-col md:flex-row">
    <aside class="w-full md:w-64"> <!-- Navigasi --> </aside>
    <main class="flex-1"> <!-- Konten Aktif --> </main>
</div>
```

### Pembersihan Class Tailwind
Kurangi redundansi class pada komponen berulang dengan memindahkannya ke `@layer components` atau menggunakan `@apply` di CSS jika komponen tersebut sangat sering digunakan.

---

## 4. Checklist Perbaikan
- [ ] Implementasi Sidebar/Topnav yang konsisten di Dashboard.
- [ ] Memindahkan form "Tambah Link" ke dalam Modal/Slide-over.
- [ ] Refactor Daftar Link menjadi list yang lebih compact.
- [ ] Hapus informasi teknis/developer dari UI Dashboard.
- [ ] Standarisasi radius (misal: semua card utama `3xl`, tombol `xl`).
- [ ] Tingkatkan kontras teks pada elemen status/badge.
