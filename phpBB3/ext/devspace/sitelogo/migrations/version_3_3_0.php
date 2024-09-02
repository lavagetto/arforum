<?php
/**
 *
 * @package Site Logo Extension
 * @copyright (c) 2022 devspace
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace devspace\sitelogo\migrations;

use phpbb\db\migration\migration;

class version_3_3_0 extends migration
{
	/**
	 * {@inheritdoc
	 */
	public function effectively_installed(): bool
	{
		$sql = 'SELECT module_id
				FROM ' . $this->table_prefix . "modules
				WHERE module_class = 'acp'
					AND module_langname = 'SITE_LOGO'";
		$result 	= $this->db->sql_query($sql);
		$module_id	= (bool) $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return $module_id !== false;
	}

	/**
	 * {@inheritdoc
	 */
	public function update_data()
	{
		return [
			['config.add', ['site_logo_background_image', 'styles/prosilver/theme/images/bg_header.gif']],
			['config.add', ['site_logo_background_repeat', 0]],
			['config.add', ['site_logo_banner_height', 100]],
			['config.add', ['site_logo_banner_radius', 10]],
			['config.add', ['site_logo_banner_url', '']],
			['config.add', ['site_logo_header', 0]],
			['config.add', ['site_logo_header_colour', '#12A3EB']],
			['config.add', ['site_logo_header_solid', 0]],
			['config.add', ['site_logo_height', '']],
			['config.add', ['site_logo_image', '']],
			['config.add', ['site_logo_left', 0]],
			['config.add', ['site_logo_logo_url', '']],
			['config.add', ['site_logo_move_search', 0]],
			['config.add', ['site_logo_override_colour', '#000000']],
			['config.add', ['site_logo_pixels', 7]],
			['config.add', ['site_logo_position', 0]],
			['config.add', ['site_logo_remove', 0]],
			['config.add', ['site_logo_remove_header', 0]],
			['config.add', ['site_logo_responsive', 1]],
			['config.add', ['site_logo_right', 0]],
			['config.add', ['site_logo_site_name_below', 0]],
			['config.add', ['site_logo_use_background', 0]],
			['config.add', ['site_logo_use_banner', 0]],
			['config.add', ['site_logo_use_extended_desc', 0]],
			['config.add', ['site_logo_use_override_colour', 0]],
			['config.add', ['site_logo_width', '']],
			['config.add', ['site_name_supress', 0]],
			['config.add', ['site_search_remove', '']],

			['config_text.add', ['site_logo_extended_site_description', '']],

			// Add the ACP module
			['module.add', ['acp', 'ACP_CAT_DOT_MODS', 'SITE_LOGO']],

			['module.add', [
				'acp', 'SITE_LOGO', [
					'module_basename'	=> '\devspace\sitelogo\acp\sitelogo_module',
					'modes' 			=> ['manage'],
				],
			]],
		];
	}
}
