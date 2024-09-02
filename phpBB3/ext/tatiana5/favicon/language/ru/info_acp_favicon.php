<?php
/**
*
* favicon [Russian]
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
	'ACP_FAVICON_EXPLAIN'			=> 'Иконка конференции',

	'ACP_FAVICON_EXT'				=> 'Выбрать расширение файла иконки конференции',
	'ACP_FAVICON_EXT_EXPLAIN'		=> '<strong>favicon.ico</strong> или <strong>favicon.png</strong>, размер 16х16 или 32х32 px',
	'ACP_FAVICON_SVG'				=> 'Включить иконку в формате svg',
	'ACP_FAVICON_SVG_EXPLAIN'		=> '<strong>favicon.svg</strong>',
	'ACP_FAVICON_APPLE'				=> 'Включить иконку для apple',
	'ACP_FAVICON_APPLE_EXPLAIN'		=> '<strong>apple_touch_icon.png</strong>, размер 180x180 px',
	'ACP_FAVICON_ANDROID'			=> 'Включить иконки для android',
	'ACP_FAVICON_ANDROID_EXPLAIN'	=> '<strong>icon-192.png</strong> и <strong>icon-512.png</strong>, оба файла, размеры в названиях',
	'ACP_FAVICON_BUBBLE'			=> 'Отображать счётчик уведомлений на фавиконе',

	'ACP_FAVICON_NOT_FOUND'			=> 'Favicon не найден',
]);
