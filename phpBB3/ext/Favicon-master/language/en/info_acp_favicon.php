<?php
/**
*
* favicon [English]
*
* @package language favicon
* @copyright (c) 2014 - 2022 Татьяна5
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_FAVICON'					=> 'Favicon',
	'ACP_FAVICON_EXPLAIN'			=> 'Board favicon',

	'ACP_FAVICON_EXT'				=> 'Select the file extension of board favicon',
	'ACP_FAVICON_EXT_EXPLAIN'		=> '<strong>favicon.ico</strong> or <strong>favicon.png</strong>, size 16x16 or 32x32 px',
	'ACP_FAVICON_SVG'				=> 'Enable .svg favicon',
	'ACP_FAVICON_SVG_EXPLAIN'		=> '<strong>favicon.svg</strong>',
	'ACP_FAVICON_APPLE'				=> 'Enable favicon for apple',
	'ACP_FAVICON_APPLE_EXPLAIN'		=> '<strong>apple_touch_icon.png</strong>, size 180x180 px',
	'ACP_FAVICON_ANDROID'			=> 'Enable favicon for android',
	'ACP_FAVICON_ANDROID_EXPLAIN'	=> '<strong>icon-192.png</strong> and <strong>icon-512.png</strong>, both files, sizes in filenames',
	'ACP_FAVICON_BUBBLE'			=> 'Dispay bubble with notification count on the favicon',

	'ACP_FAVICON_NOT_FOUND'			=> 'Favicon not found',
]);
