<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonTweet extends SppagebuilderAddons
{

    public function render()
    {

        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
        $heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

        //Options
        $autoplay = (isset($this->addon->settings->autoplay) && $this->addon->settings->autoplay) ? ' data-sppb-ride="sppb-carousel"' : '';
        $username = (isset($this->addon->settings->username) && $this->addon->settings->username) ? $this->addon->settings->username : 'joomshaper';
        $consumerkey = (isset($this->addon->settings->consumerkey) && $this->addon->settings->consumerkey) ? $this->addon->settings->consumerkey : '';
        $consumersecret = (isset($this->addon->settings->consumersecret) && $this->addon->settings->consumersecret) ? $this->addon->settings->consumersecret : '';
        $accesstoken = (isset($this->addon->settings->accesstoken) && $this->addon->settings->accesstoken) ? $this->addon->settings->accesstoken : '';
        $accesstokensecret = (isset($this->addon->settings->accesstokensecret) && $this->addon->settings->accesstokensecret) ? $this->addon->settings->accesstokensecret : '';
        $include_rts = (isset($this->addon->settings->include_rts) && $this->addon->settings->include_rts) ? $this->addon->settings->include_rts : '';
        $ignore_replies = (isset($this->addon->settings->ignore_replies) && $this->addon->settings->ignore_replies) ? $this->addon->settings->ignore_replies : '';
        $show_username = (isset($this->addon->settings->show_username) && $this->addon->settings->show_username) ? $this->addon->settings->show_username : '';
        $show_avatar = (isset($this->addon->settings->show_avatar) && $this->addon->settings->show_avatar) ? $this->addon->settings->show_avatar : '';
        $count = (isset($this->addon->settings->count) && $this->addon->settings->count) ? $this->addon->settings->count : '';
        $layout_style = $this->addon->settings->layout_style;

        //Warning
        if ($consumerkey == '') return '<div class="sppb-alert sppb-alert-danger"><strong>Error</strong><br>Insert consumer key for twitter feed slider addon</div>';
        if ($consumersecret == '') return '<div class="sppb-alert sppb-alert-danger"><strong>Error</strong><br>Insert consumer secrete key for twitter feed slider addon</div>';
        if ($accesstoken == '') return '<div class="sppb-alert sppb-alert-danger"><strong>Error</strong><br>Insert access token for twitter feed slider addon</div>';
        if ($accesstokensecret == '') return '<div class="sppb-alert sppb-alert-danger"><strong>Error</strong><br>Insert access token secrete key for twitter feed slider addon</div>';

        //include tweet helper
        $tweet_helper = JPATH_ROOT . '/templates/' . JFactory::getApplication()->getTemplate() . '/sppagebuilder/addons/tweet/helper.php';


        if (!file_exists($tweet_helper)) {

            $output = '<p class="alert alert-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_TWEET_HELPER_FILE_MISSING') . '</p>';

            return $output;
        } else {

            require_once $tweet_helper;
        }

        //Get Tweets
        $tweets = sppbAddonHelperTweet::getTweets($username, $consumerkey, $consumersecret, $accesstoken, $accesstokensecret, $count, $ignore_replies, $include_rts);

        //Output
//        var_dump($tweets->errors);die();

        if (!isset($tweets->errors) && count($tweets) > 0) {

            $output = '<div class="sppb-addon sppb-addon-tweet  ' . $class . '">';
            $output .= ($title) ? '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>' : '';
            $output .= ($show_avatar) ? '<a class="sppb-text-center" target="_blank" href="http://twitter.com/' . $tweets[0]->user->screen_name . '"><img class="sppb-img-circle sppb-tweet-avatar" src="' . $tweets[0]->user->profile_image_url . '" alt="' . $tweets[0]->user->name . '"></a>' : '';
            $output .= ($show_username) ? '<span class="sppb-tweet-username"><a target="_blank" href="http://twitter.com/' . $tweets[0]->user->screen_name . '">' . $tweets[0]->user->name . '</a></span>' : '';
            $output .= '<div class="twitter-feed">';
            if ($layout_style == 'slide') {
                $output .= '<div id="sppb-carousel-' . $this->addon->id . '" class="sppb-carousel sppb-tweet-slider sppb-slide sppb-text-center" ' . $autoplay . '>';
                $output .= '<div class="sppb-carousel-inner">';

                foreach ($tweets as $key => $tweet) {
                    $output .= '<div class="sppb-item' . (($key == 0) ? ' active' : '') . '">';
                    $tweet->text = preg_replace("/((http)+(s)?:\/\/[^<>\s]+)/i", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $tweet->text);
                    $tweet->text = preg_replace("/[@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\">\\0</a>", $tweet->text);
                    $tweet->text = preg_replace("/[#]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">\\0</a>", $tweet->text);
                    $output .= '<small class="sppb-tweet-created">' . sppbAddonHelperTweet::timeago($tweet->created_at) . '</small>';
                    $output .= '<div class="sppb-tweet-text">' . $tweet->text . '</div>';
                    $output .= '</div>';
                }

                $output .= '</div>';
                $output .= '<a href="#sppb-carousel-' . $this->addon->id . '" class="left sppb-carousel-control" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
                $output .= '<a href="#sppb-carousel-' . $this->addon->id . '" class="right sppb-carousel-control" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>';

                $output .= '</div>';
            } else {
                $output .= '<ul>';
                foreach ($tweets as $key => $tweet) {
                    $output .= '<li class="sppb-item' . (($key == 0) ? ' active' : '') . '">';
                    $tweet->text = preg_replace("/((http)+(s)?:\/\/[^<>\s]+)/i", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $tweet->text);
                    $tweet->text = preg_replace("/[@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\">\\0</a>", $tweet->text);
                    $tweet->text = preg_replace("/[#]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">\\0</a>", $tweet->text);
                    $output .= '<span class="block__icon avata-info"><i class="fa fa-twitter"></i></span>';
                    $output .= '<span class="block__content tz-content_tweet">';
                    $output .= '<span class="sppb-tweet-text">' . $tweet->text . '</span>';
                    $output .= '<a class="sppb-tweet-created tztwd-tweet-data">' . sppbAddonHelperTweet::timeago($tweet->created_at) . '</a>';
                    $output .= '</span>';
                    $output .= '</li>';
                }
                $output .= '</ul>';
            }
            $output .= '</div>';
            $output .= '</div>';

            return $output;
        }

        return;

    }
}
