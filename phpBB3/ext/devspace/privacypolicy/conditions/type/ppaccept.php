<?php
/**
 *
 * @package Privacy Policy Extension
 * @copyright (c) 2022 devspace
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace devspace\privacypolicy\conditions\type;

use phpbb\autogroups\conditions\type\base;

/**
 * Auto Groups Privacy Policy Accept class
 */
class ppaccept extends base
{
	/**
	 * Get condition type
	 *
	 * @return string Condition type
	 * @access public
	 */
	public function get_condition_type()
	{
		return 'devspace.privacypolicy.autogroups.type.ppaccept';
	}

	/**
	 * Get condition field (this is the field to check)
	 *
	 * @return string Condition field name
	 * @access public
	 */
	public function get_condition_field()
	{
		return 'user_accept_date';
	}

	/**
	 * Get condition type name
	 *
	 * @return string Condition type name
	 * @access public
	 */
	public function get_condition_type_name()
	{
		return $this->language->lang('AUTOGROUPS_TYPE_PPACCPT');
	}

	/**
	 * Get users to apply to this condition
	 * Privacy Policy Accept is called by events when sessions are checked
	 * By default, get users that have between the min/max
	 * values assigned to this type and any users currently in groups
	 * assigned to this type, otherwise use the user_id(s) supplied in
	 * the $options arg.
	 *
	 * @param array $options Array of optional data
	 * @return array Array of users ids as keys and their condition data as values
	 * @access public
	 */
	public function get_users_for_condition($options = [])
	{
		// The user data this condition needs to check
		$condition_data = [
			$this->get_condition_field(),
		];

		// Merge default options, empty user array as the default
		$options = array_merge([
			'users' => [],
		], $options);

		$sql_array = [
			'SELECT' => 'u.user_id, u.' . implode(', u.', $condition_data),
			'FROM' => [
				USERS_TABLE => 'u',
			],
			'LEFT_JOIN' => [
				[
					'FROM' => [USER_GROUP_TABLE => 'ug'],
					'ON' => 'u.user_id = ug.user_id',
				],
			],
			'WHERE' => $this->sql_where_clause($options) . '
                AND ' . $this->db->sql_in_set('u.user_type', [USER_INACTIVE, USER_IGNORE], true),
			'GROUP_BY' => 'u.user_id',
		];

		$sql    = $this->db->sql_build_query('SELECT_DISTINCT', $sql_array);
		$result = $this->db->sql_query($sql);

		$user_data = [];

		while ($row = $this->db->sql_fetchrow($result))
		{
			$user_data[$row['user_id']] = $row;
		}
		$this->db->sql_freeresult($result);

		return $user_data;
	}

	/**
	 * Helper to generate the needed sql where clause. If user ids were
	 * supplied, use them. Otherwise find all qualified users to check.
	 *
	 * @param array $options Array of optional data
	 * @return string SQL where clause
	 * @access protected
	 */
	protected function sql_where_clause($options)
	{
		// If we have user id data, return a sql_in_set of user_ids
		if (!empty($options['users']))
		{
			return $this->db->sql_in_set('u.user_id', $this->helper->prepare_users_for_query($options['users']));
		}

		$sql_where = $group_ids = [];
		$extremes  = ['min' => '>=', 'max' => '<='];

		// Get auto group rule data for this type
		$group_rules = $this->get_group_rules($this->get_condition_type());

		foreach ($group_rules as $group_rule)
		{
			$where = [];
			foreach ($extremes as $end => $sign)
			{
				if (!empty($group_rule['autogroups_' . $end . '_value']))
				{
					$where[] = "u.user_accept_date $sign " . $group_rule['autogroups_' . $end . '_value'];
				}
			}

			$sql_where[] = '(' . implode(' AND ', $where) . ')';
			$group_ids[] = $group_rule['autogroups_group_id'];
		}

		return '(' . ((sizeof($sql_where)) ? implode(' OR ', $sql_where) . ' OR ' : '') . $this->db->sql_in_set('ug.group_id', $group_ids, false, true) . ')';
	}
}
