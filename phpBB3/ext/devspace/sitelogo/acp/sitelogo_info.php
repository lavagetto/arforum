<?php
/**
 *
 * @package Site Logo Extension
 * @copyright (c) 2022 devspace
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace devspace\sitelogo\acp;

class sitelogo_info
{
	public function module()
	{
		return [
			'filename'	=> '\devspace\sitelogo\acp\sitelogo_module',
			'title' 	=> 'SITE_LOGO_MANAGE',
			'modes' 	=> [
				'manage' => ['title' => 'SITE_LOGO_MANAGE', 'auth' => 'ext_devspace/sitelogo && acl_a_board', 'cat' => ['SITE_LOGO']],
			],
		];
	}
}
