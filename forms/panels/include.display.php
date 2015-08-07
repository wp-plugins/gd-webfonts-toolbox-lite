<?php 

require_once(GDWFT_PATH.'grids/include-fonts.php');

$_grid = new gdwft_grid_include();
$_grid->prepare_items();

$_grid->display();

$urls = array();
$kits = array();
$load_fonts = array('google' => array(), 'adobe' => array(), 'typekit' => array(), 'fontface' => array());

foreach ($_grid->fonts as $key => $fonts) {
    $load_fonts[$key] = array_keys($fonts);

    if ($key == 'typekit') {
        foreach ($fonts as $f) {
            if (!in_array($f->_kit, $kits)) {
                $kits[] = $f->_kit;
            }
        }
    }

    if ($key == 'fontface') {
        foreach ($fonts as $font => $f) {
            $urls[$font] = $f->get_url();
        }
    }
}

foreach ($kits as $kit) {
    echo '<script src="//use.typekit.net/'.$kit.'.js"></script>'.D4P_EOL;
}

echo '<script>try{Typekit.load();}catch(e){}</script>'.D4P_EOL;

?>
<script type="text/javascript">
jQuery(document).ready(function() {
    gdwft_editor.tmp.urls = <?php echo json_encode($urls); ?>;

    gdwft_editor.fonts.init(<?php echo json_encode($load_fonts); ?>);
});
</script>