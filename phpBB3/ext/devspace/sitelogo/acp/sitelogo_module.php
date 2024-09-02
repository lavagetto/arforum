<?php
/**
 *
 * @package Site Logo Extension
 * @copyright (c) 2022 devspace
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace devspace\sitelogo\acp;

class sitelogo_module
{
	public $u_action;

	public function main($id, $mode)
	{
		global $phpbb_container;

		$this->tpl_name   = 'sitelogo_manage';
		$this->page_title = $phpbb_container->get('language')->lang('SITE_LOGO');

		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('devspace.sitelogo.admin.controller');

		$admin_controller->display_options();
	}
}
