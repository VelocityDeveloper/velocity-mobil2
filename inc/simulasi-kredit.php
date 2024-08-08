<?php function velocity_simulasi(){ ?>
    <div class="form-simulasikredit">
    <?php
    $args = array(
    	'posts_per_page'   => -1,
    	'orderby'          => 'date',
    	'order'            => 'DESC',
    	'post_type'        => 'produk',
    );
    $posts = get_posts( $args );
    ?>
    <div class="row">
        <div class="col-md-6">
            <?php echo velocitytheme_option('pesan_simulasi');?>
            <div class="hasilhitung mt-3">
                
            </div>
        </div>
        <div class="col-md-6">
            <form>
                <select id="mobil" class="form-control mb-2" required>
                    <?php
                        echo '<option value="">-Pilih Mobil-</option>';
                        foreach($posts as $post){
                            echo '<option value="'.$post->ID.'">'.$post->post_title.'</option>';
                        }
                    ?>
                </select>
                <select id="tipe" class="form-control mb-2" required>
                    <?php
                    echo '<option value="">-Pilih Tipe-</option>';
                        foreach($posts as $post){
                            $hargas = get_post_meta($post->ID, 'opsiharga',true);
                            foreach($hargas as $harga){
                                echo '<option class="'.$post->ID.'" value="'.preg_replace("/[^0-9]/", "", explode('=', $harga)[1]).'">'.explode('=', $harga)[0].' - Rp '.number_format(preg_replace("/[^0-9]/", "", explode('=', $harga)[1]),'2',',','.').'-</option>';
                            }
                        }
                    ?>
                </select>
                <input type="number" class="form-control mb-2" id="dp" placeholder="DP - Contoh: 80.000.000" required>
                <select id="tenor" class="form-control mb-2" required>
                    <?php
                        for ($k = 1 ; $k < 7; $k++){
                            echo '<option value="'.$k.'">Tenor '.$k.' Tahun</option>';
                        }
                    ?>
                </select>
                <div class="form-group">
                    <input type="number" class="form-control" id="bunga" placeholder="Suku Bunga /tahun (%) - Contoh: 10" required>
                </div>
                
                <?php echo velocitytoko_display_recaptcha();?>
                
                <div class="form-simulasikredit-alert"></div>
                
                <button id="hitungsimulasi" type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php
}