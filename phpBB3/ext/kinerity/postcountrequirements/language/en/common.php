<?php
/**
 *
 * Post Count Requirements extension for the phpBB software package
 *
 * @copyright (c) 2017, kinerity, https://www.acsyste.com
 * @license GNU General Public License, version 2 (GPL-2.0)
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
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'FORUM_POSTCOUNT_POST'			=> 'New Topic/Reply Post Requirement',
	'FORUM_POSTCOUNT_POST_EXPLAIN'	=> 'Number of posts required to post in this forum. Setting this value to 0 disables this requirement.',
	'FORUM_POSTCOUNT_VIEW'			=> 'View Post Requirement',
	'FORUM_POSTCOUNT_VIEW_EXPLAIN'	=> 'Number of posts required to view this forum. Setting this value to 0 disables this requirement.',

	'GROUP_BYPASS_POSTCOUNT'			=> 'Bypass Post Count Requirements',
	'GROUP_BYPASS_POSTCOUNT_EXPLAIN'	=> 'This group and it’s members can view and post in forums even if they do not have the required post count.',

	'NEED_POSTS'	=> array(
		1	=> 'You need %1$d more post.',
		2	=> 'You need %1$d more posts.',
	),

	'POSTCOUNT_NO_POST'	=> array(
		1	=> 'You do not have the required post count to post in this forum. In order to post in this forum, you must have %1$d post.',
		2	=> 'You do not have the required post count to post in this forum. In order to post in this forum, you must have %1$d posts.',
	),
	'POSTCOUNT_NO_VIEW'	=> array(
		1	=> 'You do not have the required post count to view this forum. In order to view this forum, you must have %1$d post.',
		2	=> 'You do not have the required post count to view this forum. In order to view this forum, you must have %1$d posts.',
	),
));
