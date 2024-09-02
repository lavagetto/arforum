<?php
/**
*
* @package favicon
* @copyright (c) 2014 Татьяна5
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace tatiana5\favicon\acp;

class favicon_info
{
	function module()
	{
		return [
			'filename'	=> '\tatiana5\favicon\acp\favicon_module',
			'title'		=> 'ACP_QUICKREPLY',
			'version'	=> '0.0.2',
			'modes'		=> [
				'config_favicon'		=> ['title' => 'ACP_FAVICON_CONFIG', 'auth' => 'acl_a_', 'cat' => ['ACP_FAVICON_CONFIG']],
			],
		];
	}
}
