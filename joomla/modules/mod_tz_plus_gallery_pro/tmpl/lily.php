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
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/resizeimage.js');
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/plusgallery_resize.js');
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/masonry.pkgd.js');
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/imagesloaded.pkgd.js');
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/masonry.js');
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/plusgallery_lily.js');
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/modernizr.custom.js');
$doc->addScript('modules/mod_tz_plus_gallery_pro/js/AnimOnScroll.js');
$doc->addStyleSheet('modules/mod_tz_plus_gallery_pro/css/lily.css');
$doc->addStyleSheet('modules/mod_tz_plus_gallery_pro/css/style.css');
$width = 100 / $tz_columns;

$width_album = 100 / $params->get('tz_columns_album');
$width_album_small = 100 / $params->get('tz_columns_small_desktop');
$width_album_tablet = 100 / $params->get('tz_columns_tablet');
$width_album_mobile = 100 / $params->get('tz_columns_mobile');
if (isset($height_item)) {
    $bool_resize = 1;

} else {
    $bool_resize = 0;
}
$style = '';


$album_responsive = '';
if ($width_album) {
    $album_responsive .= '
        body #plusgallery' . $module->id . ' .pgalbumthumb{
            width: ' . $width_album . '%;
            max-width:none;
            margin: 0;

        }
         body #plusgallery' . $module->id . ' .pgalbumthumb a{
            margin: ' . $tz_padding . ';
         }
    ';
}
if ($width_album_small) {
    $album_responsive .= '
        @media(max-width: 1200px) and (min-width:992px){
            body #plusgallery' . $module->id . ' .pgalbumthumb{
                width: ' . $width_album_small . '%;
            }
        }
    ';

}
if ($width_album_tablet) {
    $album_responsive .= '
        @media(max-width: 991px) and (min-width:768px){
            body #plusgallery' . $module->id . ' .pgalbumthumb{
                width: ' . $width_album_tablet . '%;
            }
        }
    ';

}
if ($width_album_mobile) {
    $album_responsive .= '
        @media(max-width: 767px) {
            body #plusgallery' . $module->id . ' .pgalbumthumb{
                width: ' . $width_album_mobile . '%;
            }
        }
    ';

}

$doc->addStyleDeclaration('
html { overflow-y: scroll; }

    body #plusgallery' . $module->id . ' .pgthumb{
        width: ' . $width . '%;
        margin: 0;
        max-width: none;
    }
 body #plusgallery' . $module->id . ' .pgthumb .effect-lily{
          margin: ' . $tz_padding . ';
    }
    body #plusgallery' . $module->id . ' #pgthumbs {
          margin:' . $margin_box_parent . ';
    }
' . $style  . $album_responsive);
?>

<?php if ($tz_show_title_album) {
    echo '<h3 class="tz_title_album">' . $title_album . '</h3>';
}
if ($tz_show_desc_album) {
    echo '<div class="tz_desc_album">' . $album_desc . '</div>';
}

?>
<?php if ($tztype == 'gplus') { ?>
    <div id="plusgallery<?php echo $module->id; ?>" class="plusgallery nav_hide"
         data-userid="<?php echo $google_plus_id; ?>"
        <?php if ($type_album == 'single') { ?>
            data-album-id="<?php echo $single_album_id; ?>"
            data-limit="<?php echo $photo_limit; ?>"
        <?php } ?>
        <?php if ($type_album == 'multi') { ?>
            data-include="<?php echo $in_album_id; ?>"
            data-exclude="<?php echo $ex_album_id; ?>"
            data-album-limit="<?php echo $album_limit; ?>"
            data-album-title="true"
            data-limit="<?php echo $photo_limit; ?>"
        <?php } ?>

        <?php if ($type_album == 'all') { ?>
            data-limit="<?php echo $photo_limit; ?>"
        <?php } ?>
         data-type="google">

    </div>
<?php } ?>

<?php if ($tztype == 'instagram') { ?>
    <div id="plusgallery<?php echo $module->id; ?>" class="plusgallery <?php echo $nav_hide ?>"
         data-userid="<?php echo $instagram_id; ?>"
         data-limit="<?php echo $photo_limit; ?>"
         data-access-token="<?php echo $instagram_data_access_token ?>"
         data-type="instagram">

    </div>
<?php } ?>

<?php if ($tztype == 'flick') { ?>
    <div id="plusgallery<?php echo $module->id; ?>" class="plusgallery nav_hide"
         data-userid="<?php echo $flickr_id; ?>"
        <?php if ($type_album == 'single') { ?>
            data-album-id="<?php echo $single_album_id; ?>"
            data-limit="<?php echo $photo_limit; ?>"

        <?php } ?>
        <?php if ($type_album == 'multi') { ?>
            data-include="<?php echo $in_album_id; ?>"
            data-exclude="<?php echo $ex_album_id; ?>"
            data-album-limit="<?php echo $album_limit; ?>"
            data-album-title="true"
            data-limit="<?php echo $photo_limit; ?>"
        <?php } ?>
        <?php if ($type_album == 'all') { ?>
            data-limit="<?php echo $photo_limit; ?>"
        <?php } ?>
         data-api-key="<?php echo $params->get('flickr_api_key');?>"

         data-type="flickr">

    </div>
<?php } ?>

<?php if ($tztype == 'fb') { ?>
    <div id="plusgallery<?php echo $module->id; ?>" class="plusgallery <?php echo $nav_hide ?>"
         data-userid="<?php echo $facebook_id; ?>"
        <?php if ($type_album == 'single') { ?>
            data-album-id="<?php echo $single_album_id; ?>"
            data-limit="<?php echo $photo_limit; ?>"
        <?php } ?>
        <?php if ($type_album == 'multi') { ?>
            data-include="<?php echo $in_album_id; ?>"
            data-exclude="<?php echo $ex_album_id; ?>"
            data-album-limit="<?php echo $album_limit; ?>"
            data-album-title="true"
            data-limit="<?php echo $photo_limit; ?>"
        <?php } ?>
        <?php if ($type_album == 'all') { ?>
            data-limit="<?php echo $photo_limit; ?>"
            data-album-limit="<?php echo $album_limit; ?>"
        <?php } ?>
         data-access-token="<?php echo $access_token_fb?>"
         data-type="facebook">

    </div>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        <?php
       	$link = JUri::base(true).'/modules/mod_tz_plus_gallery_pro/images/plusgallery';
        $params_plus = '{
			imagePath: "'.$link.'",
            responsive:{
                desktop:'.$tz_columns.',
                smallDesktop:'.$tz_columns_small_desktop.',
                tablet:'.$tz_columns_tablet.',
                mobile:'.$tz_columns_mobile.'
            },
            heightItem:'.$bool_resize.'
        }'?>
        jQuery('#plusgallery<?php echo $module->id?>').plusGallery(<?php echo $params_plus;?>);
    });

</script>
