<?php
/**
 *
 * @package Privacy Policy Extension
 * @copyright (c) 2022 devspace
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace devspace\privacypolicy\acp;

class privacypolicy_module
{
	public function main($id, $mode)
	{
		global $phpbb_container;

		$this->page_title = $phpbb_container->get('language')->lang('PRIVACY_POLICY');

		switch ($mode)
		{
			case 'manage':
				$this->tpl_name = 'privacy_policy_manage';

				// Get an instance of the admin controller
				$admin_controller = $phpbb_container->get('devspace.privacypolicy.acp.manage.controller');
				$admin_controller->display_options();
				break;

			case 'edit':
				$this->tpl_name = 'privacy_policy_edit';

				// Get an instance of the admin controller
				$admin_controller = $phpbb_container->get('devspace.privacypolicy.acp.edit.controller');
				$admin_controller->edit();
				break;
		}
	}
}
