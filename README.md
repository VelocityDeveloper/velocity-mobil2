Velocity Child Mobil2
====================
[url] https://mobil2.velocitydeveloper.com/

Child Theme for the Velocity System WordPress theme.

### Usage
Simply download the zip and upload the zip (velocity-mobil2.zip) under your WordPress dashboard at Appearance > Themes. Or extract and upload via FTP at wp-content/themes/.


### Renaming
You can of course rename the zip file so it isn't called velocity-mobil2.zip (you should do this so it makes more sense) and also change the "Theme Name" at the top of the style.css file.

### Customizer
Tanpa plugin Kirki. Pengaturan ada di Appearance > Customize:

- Velocity Theme > Site Identity: judul, tagline, ikon situs.
- Velocity Theme > Header: Header Image (banner di atas menu).
- Velocity Theme > Color & Background: Primary Color dan latar website (warna, gambar, repeat, posisi, ukuran, attachment).
- Setting Mobil > Slider Home: gambar slider halaman depan (slot kosong dilewati).
- Setting Mobil > Kategori Home: kategori artikel di halaman depan.
- Setting Mobil > Data Dealer: foto, nama, telepon, WhatsApp sales, dan pesan simulasi kredit.
- Setting Mobil > Simulasi Kredit: tampilkan simulasi di halaman depan dan di halaman produk.

Nama pengaturan sama dengan versi Kirki (`color_theme`, `background_themewebsite`, `slider_repeat`, `category_home`, `foto_sales`, `nama_sales`, `notelp`, `nowa`, `pesan_simulasi`, `home_simulasi`, `single_simulasi`), jadi situs yang update dari 1.0.x tidak kehilangan pengaturan.

### Detail Produk
Tanpa plugin Meta Box (sejak 1.2.0). Kotak **Detail Produk** di editor produk berisi daftar `Tipe = Harga` (satu per baris, tombol **+ Tambah Tipe**). Data disimpan di meta `opsiharga` sebagai array, sama dengan versi Meta Box, jadi harga produk lama tetap terbaca.
