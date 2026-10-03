<?php
/**
 * Pengaturan Mobil 2 di Customizer bawaan WordPress (tanpa Kirki).
 *
 * Nama theme mod sama dengan versi Kirki (color_theme, background_themewebsite,
 * slider_repeat, category_home, foto_sales, nama_sales, notelp, nowa,
 * pesan_simulasi, home_simulasi, single_simulasi) supaya nilai yang sudah
 * tersimpan tetap terbaca. background_themewebsite dan slider_repeat tetap
 * satu array; tiap kontrol menyimpan satu kuncinya.
 *
 * @package justg
 */

defined('ABSPATH') || exit;

const VELOCITY_MOBIL2_WARNA = '#00a091';
const VELOCITY_MOBIL2_SLIDER_MIN = 6;

/**
 * Nilai bawaan latar website (sama dengan default Kirki dulu).
 */
function velocity_mobil2_latar_bawaan()
{
    return [
        'background-color'      => '#F5F5F5',
        'background-image'      => '',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
    ];
}

/**
 * Warna hex, atau rgb()/rgba() yang dulu bisa disimpan Kirki.
 */
function velocity_mobil2_sanitize_warna($warna)
{
    $warna = trim((string) $warna);
    if (preg_match('/^rgba?\(\s*[\d.\s,%]+\)$/i', $warna)) {
        return $warna;
    }
    return sanitize_hex_color($warna) ?: '';
}

/**
 * URL gambar slider beranda yang terisi, urut sesuai Customizer.
 */
function velocity_mobil2_slider()
{
    $baris = get_theme_mod('slider_repeat', []);
    $hasil = [];
    foreach (is_array($baris) ? $baris : [] as $slide) {
        $gambar = is_array($slide) && isset($slide['imgslider']) ? $slide['imgslider'] : '';
        // Kirki bisa menyimpan id lampiran, bukan URL.
        if (is_numeric($gambar)) {
            $gambar = wp_get_attachment_url((int) $gambar);
        }
        if ($gambar) {
            $hasil[] = $gambar;
        }
    }
    return $hasil;
}

/**
 * Status sakelar Simulasi Kredit. Bawaan aktif, seperti default Kirki dulu;
 * nilai lama 'on'/'off' juga dikenali.
 */
function velocity_mobil2_simulasi_aktif($mod)
{
    $nilai = get_theme_mod($mod, true);
    return 'off' !== $nilai && (bool) $nilai;
}

add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_panel('panel_velocity', [
        'priority' => 10,
        'title'    => __('Velocity Theme', 'justg'),
    ]);

    // Header (Header Image bawaan WordPress dipindah ke sini di bawah)
    $wp_customize->add_section('section_headervelocity', [
        'panel'    => 'panel_velocity',
        'title'    => __('Header', 'justg'),
        'priority' => 20,
    ]);

    // Warna & latar
    $wp_customize->add_section('section_colorvelocity', [
        'panel'    => 'panel_velocity',
        'title'    => __('Color & Background', 'justg'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('color_theme', [
        'default'           => VELOCITY_MOBIL2_WARNA,
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_theme', [
        'label'       => __('Primary Color', 'justg'),
        'description' => __('Warna utama tema (--color-theme & --bs-primary): menu, tombol, harga, dan footer.', 'justg'),
        'section'     => 'section_colorvelocity',
    ]));

    $bawaan = velocity_mobil2_latar_bawaan();
    $wp_customize->add_setting('background_themewebsite[background-color]', [
        'default'           => $bawaan['background-color'],
        'sanitize_callback' => 'velocity_mobil2_sanitize_warna',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_themewebsite[background-color]', [
        'label'   => __('Website Background Color', 'justg'),
        'section' => 'section_colorvelocity',
    ]));
    $wp_customize->add_setting('background_themewebsite[background-image]', [
        'default'           => $bawaan['background-image'],
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'background_themewebsite[background-image]', [
        'label'   => __('Website Background Image', 'justg'),
        'section' => 'section_colorvelocity',
    ]));

    $pilihan = [
        'background-repeat'     => [__('Background Repeat', 'justg'), [
            'repeat'    => __('Repeat', 'justg'),
            'no-repeat' => __('No Repeat', 'justg'),
            'repeat-x'  => __('Repeat Horizontally', 'justg'),
            'repeat-y'  => __('Repeat Vertically', 'justg'),
        ]],
        'background-position'   => [__('Background Position', 'justg'), [
            'left top'      => __('Left Top', 'justg'),
            'left center'   => __('Left Center', 'justg'),
            'left bottom'   => __('Left Bottom', 'justg'),
            'center top'    => __('Center Top', 'justg'),
            'center center' => __('Center Center', 'justg'),
            'center bottom' => __('Center Bottom', 'justg'),
            'right top'     => __('Right Top', 'justg'),
            'right center'  => __('Right Center', 'justg'),
            'right bottom'  => __('Right Bottom', 'justg'),
        ]],
        'background-size'       => [__('Background Size', 'justg'), [
            'cover'   => __('Cover', 'justg'),
            'contain' => __('Contain', 'justg'),
            'auto'    => __('Auto', 'justg'),
        ]],
        'background-attachment' => [__('Background Attachment', 'justg'), [
            'scroll' => __('Scroll', 'justg'),
            'fixed'  => __('Fixed', 'justg'),
        ]],
    ];
    foreach ($pilihan as $kunci => [$label, $choices]) {
        $id = "background_themewebsite[$kunci]";
        $wp_customize->add_setting($id, [
            'default'           => $bawaan[$kunci],
            'sanitize_callback' => function ($nilai) use ($choices, $bawaan, $kunci) {
                return isset($choices[$nilai]) ? $nilai : $bawaan[$kunci];
            },
        ]);
        $wp_customize->add_control($id, [
            'type'    => 'select',
            'label'   => $label,
            'section' => 'section_colorvelocity',
            'choices' => $choices,
        ]);
    }

    // Setting Mobil
    $wp_customize->add_panel('panel_mobil', [
        'priority' => 11,
        'title'    => __('Setting Mobil', 'justg'),
    ]);

    // Slider beranda: slot gambar tetap, minimal 6 (lebih bila data lama lebih banyak).
    $wp_customize->add_section('section_slider', [
        'panel'       => 'panel_mobil',
        'title'       => __('Slider Home', 'justg'),
        'description' => __('Gambar slider di halaman depan, tampil berurutan. Slot kosong dilewati.', 'justg'),
        'priority'    => 10,
    ]);
    $slider = get_theme_mod('slider_repeat', []);
    $jumlah = max(VELOCITY_MOBIL2_SLIDER_MIN, is_array($slider) ? count($slider) : 0);
    for ($i = 0; $i < $jumlah; $i++) {
        $id = "slider_repeat[$i][imgslider]";
        $wp_customize->add_setting($id, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $id, [
            /* translators: %d: nomor slide */
            'label'   => sprintf(__('Slider %d', 'justg'), $i + 1),
            'section' => 'section_slider',
        ]));
    }

    // Kategori artikel di beranda
    $wp_customize->add_section('section_category', [
        'panel'    => 'panel_mobil',
        'title'    => __('Kategori Home', 'justg'),
        'priority' => 20,
    ]);
    $kategori = ['' => __('— Pilih Kategori —', 'justg')];
    foreach (get_categories(['hide_empty' => false]) as $term) {
        $kategori[$term->term_id] = $term->name;
    }
    $wp_customize->add_setting('category_home', [
        'default'           => '',
        'sanitize_callback' => function ($nilai) {
            return absint($nilai) ? (string) absint($nilai) : '';
        },
    ]);
    $wp_customize->add_control('category_home', [
        'type'        => 'select',
        'label'       => __('Kategori Post Home', 'justg'),
        'description' => __('Tiga artikel terbaru kategori ini tampil di halaman depan.', 'justg'),
        'section'     => 'section_category',
        'choices'     => $kategori,
    ]);

    // Data dealer
    $wp_customize->add_section('section_dealer', [
        'panel'    => 'panel_mobil',
        'title'    => __('Data Dealer', 'justg'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('foto_sales', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'foto_sales', [
        'label'       => __('Foto Sales', 'justg'),
        'description' => __('Upload gambar ukuran 500x500.', 'justg'),
        'section'     => 'section_dealer',
        'mime_type'   => 'image',
    ]));
    $teks = [
        'nama_sales' => [__('Nama Sales', 'justg'), ''],
        'notelp'     => [__('No Telephone', 'justg'), __('Contoh. 085123456789', 'justg')],
        'nowa'       => [__('No Whatsapp', 'justg'), __('Contoh. 085123456789', 'justg')],
    ];
    foreach ($teks as $id => [$label, $keterangan]) {
        $wp_customize->add_setting($id, [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control($id, [
            'type'        => 'text',
            'label'       => $label,
            'description' => $keterangan,
            'section'     => 'section_dealer',
        ]);
    }
    $wp_customize->add_setting('pesan_simulasi', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('pesan_simulasi', [
        'type'        => 'textarea',
        'label'       => __('Pesan Simulasi Kredit', 'justg'),
        'description' => __('Tampil di atas form simulasi kredit. Boleh berisi HTML (gambar, tautan, cetak tebal).', 'justg'),
        'section'     => 'section_dealer',
    ]);

    // Simulasi kredit
    $wp_customize->add_section('section_simulasi', [
        'panel'    => 'panel_mobil',
        'title'    => __('Simulasi Kredit', 'justg'),
        'priority' => 40,
    ]);
    $sakelar = [
        'home_simulasi'   => [__('Halaman Depan', 'justg'), __('Aktifkan Simulasi Kredit di Halaman Depan.', 'justg')],
        'single_simulasi' => [__('Single Page', 'justg'), __('Aktifkan Simulasi Kredit di Single Deskripsi Produk.', 'justg')],
    ];
    foreach ($sakelar as $id => [$label, $keterangan]) {
        $wp_customize->add_setting($id, [
            'default'           => true,
            'sanitize_callback' => function ($nilai) {
                return 'off' !== $nilai && (bool) $nilai;
            },
        ]);
        $wp_customize->add_control($id, [
            'type'        => 'checkbox',
            'label'       => $label,
            'description' => $keterangan,
            'section'     => 'section_simulasi',
        ]);
    }
});

// Penyesuaian bagian bawaan WordPress & tema induk. Prioritas akhir supaya berjalan
// sesudah bagian itu terdaftar, termasuk panel Kirki tema induk lama bila Kirki masih aktif.
add_action('customize_register', function ($wp_customize) {
    // Identitas situs masuk panel; logo tidak dipakai (header memakai Header Image).
    $identitas = $wp_customize->get_section('title_tagline');
    if ($identitas) {
        $identitas->panel = 'panel_velocity';
        $identitas->priority = 10;
    }
    $wp_customize->remove_control('custom_logo');
    $wp_customize->remove_control('display_header_text');

    // Header Image bawaan WordPress (banner di atas menu) pindah ke bagian Header.
    $header_image = $wp_customize->get_control('header_image');
    if ($header_image) {
        $header_image->section = 'section_headervelocity';
        $header_image->priority = 5;
        $wp_customize->remove_section('header_image');
    }

    // Digantikan Primary Color & Website Background di atas.
    $wp_customize->remove_control('primary_color');
    $wp_customize->remove_section('velocity_section_background');
    foreach (['global_panel', 'panel_header', 'panel_footer', 'panel_antispam'] as $panel) {
        $wp_customize->remove_panel($panel);
    }
}, 1000);

/**
 * CSS dari pengaturan di atas. Dicetak di akhir <head> seperti Kirki dulu, supaya
 * menang atas CSS tema induk.
 */
add_action('wp_head', function () {
    $warna = sanitize_hex_color(get_theme_mod('color_theme', VELOCITY_MOBIL2_WARNA)) ?: VELOCITY_MOBIL2_WARNA;
    $rgb = implode(',', array_map('hexdec', str_split(ltrim(strlen($warna) === 4 ? preg_replace('/([0-9a-f])/i', '$1$1', $warna) : $warna, '#'), 2)));
    $css = ':root{--color-theme:' . $warna . ';--bs-primary:' . $warna . ';--bs-primary-rgb:' . $rgb . ';--primary:' . $warna . ';}'
        . '.text-colortheme,.text-colortheme i,.page-link{color:' . $warna . ';}'
        . '.bg-colortheme,.page-item.active .page-link{background-color:' . $warna . ';border-color:' . $warna . ';}'
        . '.border-color-theme{--bs-border-color:' . $warna . ';}';

    $latar = get_theme_mod('background_themewebsite', []);
    $latar = array_merge(velocity_mobil2_latar_bawaan(), is_array($latar) ? $latar : []);
    $aturan = [];
    foreach ($latar as $prop => $nilai) {
        if (!array_key_exists($prop, velocity_mobil2_latar_bawaan())) {
            continue;
        }
        // Kirki bisa menyimpan id lampiran, bukan URL.
        if ($prop === 'background-image' && is_numeric($nilai)) {
            $nilai = wp_get_attachment_url((int) $nilai);
        }
        $nilai = trim((string) $nilai);
        if ($nilai === '') {
            continue;
        }
        if ($prop === 'background-color') {
            $nilai = velocity_mobil2_sanitize_warna($nilai);
        } elseif ($prop === 'background-image') {
            $nilai = 'url("' . esc_url($nilai) . '")';
        } else {
            $nilai = esc_attr($nilai);
        }
        if ($nilai !== '') {
            $aturan[] = $prop . ':' . $nilai;
        }
    }
    if ($aturan) {
        $css .= ':root[data-bs-theme=light] body,body{' . implode(';', $aturan) . ';}';
    }
    echo '<style id="velocity-mobil2-customizer">' . wp_strip_all_tags($css) . '</style>' . "\n";
}, 100);
