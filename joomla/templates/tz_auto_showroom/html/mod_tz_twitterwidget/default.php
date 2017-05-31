<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die;

$modID = $module->id;
$follow = $params->get('follow_us', 1);


$styles = '';
$border = $params->get('border_color', 'transparent');
$styles .= '
    #TzMod' . $mod_ID . ' .latest_tweets a,
    #TzMod' . $mod_ID . ' .tztwd-tweets a {color: ' . $params->get('link_color', '#0084B4') . '}';
$styles .= '#TzMod' . $mod_ID . ' .tztwd-container {background-color: ' . $params->get('bgd_color', 'transparent') . '}';
if ($border != 'transparent') {
    $styles .= '#TzMod' . $mod_ID . ' .tztwd-header {border-bottom-color: ' . $border . '}';
    $styles .= '#TzMod' . $mod_ID . ' .tztwd-container {border-color: ' . $border . '}';
    $styles .= '#TzMod' . $mod_ID . ' .tztwd-copyright {border-top-color: ' . $border . '}';
    $styles .= '#TzMod' . $mod_ID . ' .tztwd-tweet-container {border-bottom-color: ' . $border . '}';
} else {
    $styles .= ' .tztwd-header, .tztwd-container, .tztwd-copyright,.tztwd-tweet-container{border:none !important;}  ';
}
$styles .= '
    #TzMod' . $mod_ID . ' .latest_tweets,
    #TzMod' . $mod_ID . ' .tztwd {color: ' . $params->get('text_color', '#333') . '}';
$styles .= '
    #TzMod' . $mod_ID . ' a .tztwd-display-name {color: ' . $params->get('header_link_color', '#333') . '}';
$styles .= '
    #TzMod' . $mod_ID . ' a .tztwd-screen-name {color: ' . $params->get('header_sub_color', '#666') . '}';
$styles .= '
    #TzMod' . $mod_ID . ' a:hover .tztwd-screen-name {color: ' . $params->get('header_sub_hover_color', '#999') . '}';
$styles .= '
    #TzMod' . $mod_ID . ' .tztwd-header,
    #TzMod' . $mod_ID . ' .tztwd-header a {
    color: ' . $params->get('search_title_color', '#333')
    . '}';
if ($params->get('width', '')) {
    $styles .= '#TzMod' . $mod_ID . ' .tztwd-container {width: ' . intval($params->get('width', '')) . 'px;}';
}
if ($params->get('height', '')) {
    $styles .= '#TzMod' . $mod_ID . ' .tztwd {height: ' . intval($params->get('height', '')) . 'px; overflow: auto;}';
}

//$doc->addStyleDeclaration($styles);
?>
<div id="TzMod<?php echo $modID; ?>">
    <div class="tztwd-container">
        <?php if ($switch_api) {
            $doc = JFactory::getDocument();
            $doc->addScript(JUri::base(true) . '/modules/mod_tz_twitterwidget/js/tweecool.min.js');
            $doc->addScriptDeclaration('
                jQuery(window).on("load resize",function(){
                    jQuery(\'.latest_tweets\').tweecool({
                        username : \'' . $params->get('username') . '\',
                        limit:' . $params->get('count') . '
                    });
                });

            ');
            echo '<div class="latest_tweets"></div>';

        } elseif ($data) { ?>
            <div class="tztwd">
                <?php if ($params->get('header', 1)) : ?>
                    <div class="tztwd-header">
                        <?php if ($params->get('twitter_icon', 1)) : ?>
                            <div class="tztwd-twitter-icon">
                                <a href="http://twitter.com" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($params->get('type', 1)) : ?>
                            <a href="https://twitter.com/<?php echo $data->tweets[0]->screenName; ?>"
                               target="_blank">
                                <img src="<?php echo $data->tweets[0]->profileImage; ?>" class="tztwd-avatar"/>
                                <span class="tztwd-display-name"><?php echo $data->tweets[0]->displayName; ?></span>
                                <span class='tztwd-screen-name'> @<?php echo $data->tweets[0]->screenName; ?></span>
                            </a>
                            <div style="clear: both;"></div>
                        <?php else: ?>
                            <?php if ($params->get('link_title', 1)) : ?>
                                <a href="https://twitter.com/search/<?php echo $params->get('query', ''); ?>"
                                   target="_blank"><?php echo $params->get('title', '') ?></a>
                            <?php else: ?>
                                <?php echo $params->get('title', ''); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="twitter-feed">
                    <ul>
                        <?php foreach ($data->tweets as $key => $tweet): ?>
                            <li class="">
                            <span class="avata-info">
                                <?php if ($params->get('avatars', 1)): ?>

                                    <a href="https://twitter.com/intent/user?screen_name=<?php echo $tweet->screenName; ?>"
                                       target="_blank">
                                        <img src="<?php echo $tweet->profileImage; ?>" class="tztwd-avatar"
                                             style="width: 35px;"/>
                                    </a>
                                <?php else: ?>
                                    <i class="fa fa-twitter"></i>
                                <?php endif; ?>
                            </span>
                                <span class="tz-content_tweet">
                                <span class="tztwd-tweet">
                                    <?php if ($params->get('display_name', 1)): ?>
                                        <a href="https://twitter.com/intent/user?screen_name=<?php echo $tweet->screenName; ?>"
                                           target="_blank"><?php echo $tweet->screenName; ?></a>
                                    <?php endif; ?>
                                    <?php echo $tweet->text; ?>
                                </span>
                                <span class="tztwd-tweet-data">
                                    <?php if ($params->get('timestamps', 1)): ?>
                                        <a href="https://twitter.com/<?php echo $tweet->screenName; ?>/statuses/<?php echo $tweet->id; ?>"
                                           target="_blank"><?php echo $tweet->time; ?></a>
                                        <?php if ($params->get('reply', 1) || $params->get('retweet', 1) || $params->get('favorite', 1)): ?>
                                            &bull;
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($params->get('reply', 1)): ?>
                                        <a href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id; ?>"
                                           target="_blank"><?php echo JText::_('TZ_TWEET_REPLY'); ?></a>
                                        <?php if ($params->get('retweet', 1) || $params->get('favorite', 1)): ?>
                                            &bull;
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($params->get('retweet', 1)): ?>
                                        <a href="https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet->id; ?>"
                                           target="_blank"><?php echo JText::_('TZ_RETWEET'); ?></a>
                                        <?php if ($params->get('favorite', 1)): ?>
                                            &bull;
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($params->get('favorite', 1)): ?>
                                        <a href="https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id; ?>"
                                           target="_blank"><?php echo JText::_('TZ_TWEET_FAVORITE'); ?></a>
                                    <?php endif; ?>
                                </span>
                            </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php if ($follow == 1) { ?>
                    <div class="twitter-flow">
                        <div class="flow-content">
                            <a href="https://twitter.com/intent/user?screen_name=<?php echo $tweet->screenName; ?>"
                               class="twitter-follow" data-show-count="false"
                               data-lang="en"><?php echo JText::_('TZ_TWEET_FOLLOW'); ?></a>

                            <script>!function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (!d.getElementById(id)) {
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = "//platform.twitter.com/widgets.js";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }
                                }(document, "script", "twitter-wjs");</script>
                        </div>
                    </div>
                <?php } ?>

            </div>
        <?php } else {
            require JModuleHelper::getLayoutPath('mod_tz_twitterwidget', $params->get('layout', 'default') . '_error');
        } ?>
    </div>
</div>
