<?php
/**
 *
 * Post Count Requirements extension for the phpBB software package
 *
 * @copyright (c) 2017, kinerity, https://www.acsyste.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kinerity\postcountrequirements\migrations\v10x;

class release_0_0_1 extends \phpbb\db\migration\container_aware_migration
{
	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'forums'	=> array(
					'forum_postcount_post'	=> array('UINT', 0),
					'forum_postcount_view'	=> array('UINT', 0),
				),
				$this->table_prefix . 'groups'	=> array(
					'group_bypass_postcount'	=> array('BOOL', 0),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'forums'	=> array(
					'forum_postcount_post',
					'forum_postcount_view',
				),
				$this->table_prefix . 'groups'	=> array(
					'group_bypass_postcount',
				),
			),
		);
	}
}
