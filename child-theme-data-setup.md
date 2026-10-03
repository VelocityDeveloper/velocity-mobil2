# Alur Isi Data Child Theme Mobil2

## Plugin

- Wajib aktif: **Meta Box** (field harga produk) dan **Velocity Addons**.
- Plugin **Kirki tidak diperlukan** sejak versi 1.1.0.

## Customize

1. Set halaman **Home** mengambil template **"Home Template"**, lalu jadikan halaman depan (Settings › Reading › A static page).
   - Tampilan beranda sama dengan pilihan "Your latest posts" seperti di demo; keduanya membaca pengaturan Customize di bawah.
2. Isi **Velocity Theme**:
   1. **Site Identity**: site title, tagline, site icon.
      - Tema ini tidak memakai logo terpisah; logo tampil lewat Header Image.
   2. **Header**: **Header Image** = banner di atas menu, ukuran **1000 x 150 px**, berisi logo klien di sisi kiri.
   3. **Color & Background**: **Primary Color** (warna menu, tombol, harga, footer; sesuaikan dengan warna logo klien) dan **Website Background** (warna/gambar latar di luar konten, demo memakai **#333333**).
3. Isi **Setting Mobil**:
   1. **Slider Home**: gambar slider beranda ukuran **1000 x 375 px**, **minimal 3 gambar**.
      - Apabila tidak ada gambar slider dari client, buatkan banner mobil yang sesuai dengan dealer/merek client.
   2. **Kategori Home**: pilih kategori artikel yang tampil di beranda (3 artikel terbaru), mis. kategori **News**.
      - Pastikan kategori itu berisi minimal 3 artikel.
   3. **Data Dealer**: foto sales (**500 x 500 px**), nama sales, no telephone, no WhatsApp (format 08xxx), dan **Pesan Simulasi Kredit** (teks/HTML di atas form simulasi, mis. foto marketing + nomor WA).
      - Apabila tidak ada data dari client, ambil dari form isian website.
   4. **Simulasi Kredit**: centang **Halaman Depan** dan **Single Page** (aktif secara bawaan).
4. **Menus**: buat menu di lokasi **Primary Menu**: Home, Profile, Produk, Pricelist, Gallery, News, Kontak.

## Produk

- Isi produk di menu **Produk** (post type `produk`): judul = nama mobil, gambar unggulan, deskripsi, dan **Kategori Produk** (mis. merek).
- Pada kotak **Detail Produk › Type = Harga**, isi satu baris per tipe dengan format `Tipe = Harga`, contoh: `INNOVA 2.0 G M/T = 309.300.000`.
  - Isian ini dipakai untuk harga "Mulai dari", tabel harga di halaman produk, halaman Pricelist, dan pilihan tipe di Simulasi Kredit.
  - Setiap produk **minimal 1 tipe harga**; produk tanpa harga tidak punya pilihan tipe di Simulasi Kredit.
- Minimal **6 produk** agar beranda (9 produk terbaru) dan widget sidebar terlihat penuh.

## Halaman

- **Pricelist**: halaman dengan template **"Pricelist"** (otomatis menampilkan harga semua produk).
- **Profile**, **Kontak**: halaman biasa berisi profil dealer dan kontak sales.
- **Gallery**: lihat bagian Gallery di bawah.

## Widgets

- Pada **Main Sidebar**:
  1. **Widget Post** (bawaan tema): judul "Mobil Populer", style **List**, kategori produk yang ada, urutkan **Terpopuler**, jumlah **6**.
  2. Widget **Text** berjudul "Kunjungan" berisi shortcode `[statistik_kunjungan]`.
- **Footer Widget 1–4** boleh dikosongkan (footer tetap menampilkan copyright).

## Gallery

- Aktifkan fitur **Gallery Post Type** di Velocity Addon.
- Gunakan shortcode **VD Gallery** (`[vdgallery id="..."]`) untuk tampilan halaman Gallery.

## Logo Header

- Logo klien ditempatkan **di dalam Header Image 1000 x 150 px** (bukan Site Logo).
- Apabila warna logo tidak kontras dengan latar banner, berikan **background putih** di belakang logo.
