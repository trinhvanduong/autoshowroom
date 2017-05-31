<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    TuanNATemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/


// No direct access
defined('_JEXEC') or die();

$doc = JFactory::getDocument();
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/plusgallery.js');
$doc->addStyleSheet('modules/mod_tz_plus_gallery_pro/css/plusgallery.css');
$width = 100 / $tz_columns;

$doc->addStyleDeclaration('
    body #plusgallery' . $module->id . ' .pgthumb,
    body #plusgallery' . $module->id . ' .pgalbumthumb {
        width: ' . $width . '%;
        margin: 0;
        padding: ' . $tz_padding . ';
        max-width: none;
        height: auto;
    }
     body #plusgallery' . $module->id . ' #pgthumbs {
          margin:' . $margin_box_parent . ';
    }
');
?>

<?php if ($tz_show_title_album) {
    echo '<h3 class="tz_title_album">' . $title_album . '</h3>';
}
if ($tz_show_desc_album) {
    echo '<div class="tz_desc_album">' . $album_desc . '</div>';
}
?>

<?php
if ($tztype == 'gplus') { ?>
    <div id="plusgallery<?php echo $module->id; ?>" class="plusgallery"
         data-userid="<?php echo $google_plus_id; ?>"
        <?php if ($gl_type_album == 'single') { ?>
            data-album-id="<?php echo $gl_album_id; ?>"
            data-limit="<?php echo $gl_photo_limit; ?>"
        <?php } ?>
        <?php if ($gl_type_album == 'multi') { ?>
            data-include="<?php echo $gl_in_album_id; ?>"
            data-exclude="<?php echo $gl_ex_album_id; ?>"
            data-album-limit="<?php echo $gl_album_limit; ?>"
            data-album-title="true"
            data-limit="<?php echo $gl_photo_limit; ?>"
        <?php } ?>

        <?php if ($gl_type_album == 'all') { ?>
            data-limit="<?php echo $gl_photo_limit; ?>"
        <?php } ?>
         data-type="google">

    </div>
<?php } ?>

<?php
if ($tztype == 'instagram') {
    ?>
    <div id="plusgallery<?php echo $module->id; ?>" class="plusgallery"
         data-userid="<?php echo $instagram_id; ?>"
         data-limit="<?php echo $it_photo_limit; ?>"
         data-access-token="35163631.3a5ca5d.be9b66ad0f964d17b996d2a899bc8cd3"
         data-type="instagram">

    </div>
<?php } ?>

<?php
if ($tztype == 'flick') {
    ?>
    <div id="plusgallery<?php echo $module->id; ?>" class="plusgallery"
         data-userid="<?php echo $flickr_id; ?>"
        <?php if ($fk_type_album == 'single') { ?>
            data-album-id="<?php echo $fk_album_id; ?>"
            data-limit="<?php echo $fk_photo_limit; ?>"

        <?php } ?>
        <?php if ($fk_type_album == 'multi') { ?>
            data-include="<?php echo $fk_in_album_id; ?>"
            data-exclude="<?php echo $fk_ex_album_id; ?>"
            data-album-limit="<?php echo $fk_album_limit; ?>"
            data-album-title="true"
            data-limit="<?php echo $fk_photo_limit; ?>"
        <?php } ?>
        <?php if ($fk_type_album == 'all') { ?>
            data-limit="<?php echo $fk_photo_limit; ?>"
        <?php } ?>
         data-api-key="<?php echo $params->get('flickr_api_key');?>"

         data-type="flickr">

    </div>
<?php } ?>

<?php
if ($tztype == 'fb') { ?>
    <div id="plusgallery<?php echo $module->id; ?>" class="plusgallery"
         data-userid="<?php echo $facebook_id; ?>"
        <?php if ($fb_type_album == 'single') { ?>
            data-album-id="<?php echo $fb_album_id; ?>"
            data-limit="<?php echo $fb_photo_limit; ?>"
        <?php } ?>
        <?php if ($fb_type_album == 'multi') { ?>
            data-include="<?php echo $fb_in_album_id; ?>"
            data-exclude="<?php echo $fb_ex_album_id; ?>"
            data-album-limit="<?php echo $fb_album_limit; ?>"
            data-album-title="true"
            data-limit="<?php echo $fb_photo_limit; ?>"
        <?php } ?>
        <?php if ($fb_type_album == 'all') { ?>
            data-limit="<?php echo $fb_photo_limit; ?>"
        <?php } ?>
         data-access-token="<?php echo $access_token_fb?>"
         data-type="facebook">

    </div>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var ipath = '<?php echo JUri::base().'/modules/mod_tz_plus_gallery_pro/' ?>';
        jQuery('#plusgallery<?php echo $module->id;?>').plusGallery('', ipath);
    })
</script>