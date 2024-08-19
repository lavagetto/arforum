<?php
/**
 *
 * Post Count Requirements extension for the phpBB software package
 *
 * @copyright (c) 2017, kinerity, https://www.acsyste.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kinerity\postcountrequirements\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Post Count Requirements Event listener.
 */
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface  $db         Database object
	 * @param \phpbb\language\language           $lang       Language object
	 * @param \phpbb\request\request             $request    Request object
	 * @param \phpbb\template\template           $template   Template object
	 * @param \phpbb\user                        $user       User object
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\language\language $lang, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->db = $db;
		$this->lang = $lang;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.acp_manage_forums_display_form'		=> 'acp_manage_forums_display_form',
			'core.acp_manage_forums_initialise_data'	=> 'acp_manage_forums_initialise_data',
			'core.acp_manage_forums_request_data'		=> 'acp_manage_forums_request_data',

			'core.acp_manage_group_request_data'		=> 'acp_manage_group_request_data',
			'core.acp_manage_group_initialise_data'		=> 'acp_manage_group_initialise_data',
			'core.acp_manage_group_display_form'		=> 'acp_manage_group_display_form',

			'core.modify_posting_parameters'	=> 'modify_posting_parameters',

			'core.search_modify_param_before'	=> 'search_modify_param_before',

			'core.user_setup'	=> 'user_setup',

			'core.viewforum_get_topic_data'	=> 'viewforum_viewtopic_get_data',
			'core.viewtopic_get_post_data'	=> 'viewforum_viewtopic_get_data'
		);
	}

	public function acp_manage_forums_display_form($event)
	{
		$template_data = $event['template_data'];
		$template_data['FORUM_POSTCOUNT_POST'] = $event['forum_data']['forum_postcount_post'];
		$template_data['FORUM_POSTCOUNT_VIEW'] = $event['forum_data']['forum_postcount_view'];
		$event['template_data'] = $template_data;
	}

	public function acp_manage_forums_initialise_data($event)
	{
		if ($event['action'] == 'add')
		{
			$forum_data = $event['forum_data'];
			$forum_data = array_merge($forum_data, array(
				'forum_postcount_post'	=> 0,
				'forum_postcount_view'	=> 0,
			));
			$event['forum_data'] = $forum_data;
		}
	}

	public function acp_manage_forums_request_data($event)
	{
		$forum_data = $event['forum_data'];
		$forum_data['forum_postcount_post'] = $this->request->variable('forum_postcount_post', 0);
		$forum_data['forum_postcount_view'] = $this->request->variable('forum_postcount_view', 0);
		$event['forum_data'] = $forum_data;
	}

	public function acp_manage_group_request_data($event)
	{
		$submit_ary = $event['submit_ary'];
		$submit_ary['bypass_postcount'] = $this->request->variable('group_bypass_postcount', 0);
		$event['submit_ary'] = $submit_ary;
	}

	public function acp_manage_group_initialise_data($event)
	{
		$test_variables = $event['test_variables'];
		$test_variables['bypass_postcount'] = 'int';
		$event['test_variables'] = $test_variables;
	}

	public function acp_manage_group_display_form($event)
	{
		$group_row = $event['group_row'];

		$this->template->assign_vars(array(
			'GROUP_BYPASS_POSTCOUNT' => (isset($group_row['group_bypass_postcount']) && $group_row['group_bypass_postcount']) ? ' checked="checked"' : '',
		));
	}

	public function modify_posting_parameters($event)
	{
		$forum_id = $event['forum_id'];

		$group_bypass = $this->query_bypass_groups();

		if (!$group_bypass)
		{
			$sql = 'SELECT forum_postcount_post
				FROM ' . FORUMS_TABLE . '
				WHERE forum_id = ' . (int) $forum_id;
			$result = $this->db->sql_query($sql);
			$forum_data = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ((int) $this->user->data['user_posts'] < (int) $forum_data['forum_postcount_post'])
			{
				$need_posts = (int) $forum_data['forum_postcount_post'] - (int) $this->user->data['user_posts'];
				$this->lang->add_lang('common', 'kinerity/postcountrequirements');
				trigger_error($this->lang->lang('POSTCOUNT_NO_POST', (int) $forum_data['forum_postcount_post']) . ' ' . $this->lang->lang('NEED_POSTS', (int) $need_posts));
			}
		}
	}

	public function search_modify_param_before($event)
	{
		$ex_fid_ary = $event['ex_fid_ary'];

		$group_bypass = $this->query_bypass_groups();

		if (!$group_bypass)
		{
			$sql = 'SELECT forum_postcount_view, forum_id
				FROM ' . FORUMS_TABLE . '
				WHERE forum_postcount_view > ' . (int) $this->user->data['user_posts'];
			$result = $this->db->sql_query($sql);
			while ($row = $this->db->sql_fetchrow($result))
			{
				$ex_fid_ary[] = $row['forum_id'];
			}
			$this->db->sql_freeresult($result);
		}

		$event['ex_fid_ary'] = $ex_fid_ary;
	}

	public function user_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name'	=> 'kinerity/postcountrequirements',
			'lang_set'	=> 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function viewforum_viewtopic_get_data($event)
	{
		$forum_id = $event['forum_id'];

		$group_bypass = $this->query_bypass_groups();

		if (!$group_bypass)
		{
			$sql = 'SELECT forum_postcount_view
				FROM ' . FORUMS_TABLE . '
				WHERE forum_id = ' . (int) $forum_id;
			$result = $this->db->sql_query($sql);
			$forum_data = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ((int) $this->user->data['user_posts'] < (int) $forum_data['forum_postcount_view'])
			{
				$need_posts = (int) $forum_data['forum_postcount_view'] - (int) $this->user->data['user_posts'];
				trigger_error($this->lang->lang('POSTCOUNT_NO_VIEW', (int) $forum_data['forum_postcount_view']) . ' ' . $this->lang->lang('NEED_POSTS', (int) $need_posts));
			}
		}
	}

	private function query_bypass_groups()
	{
		$sql = 'SELECT COUNT(g.group_bypass_postcount) as group_bypass
			FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
			WHERE g.group_bypass_postcount = 1
				AND ug.group_id = g.group_id
				AND ug.user_id = ' . (int) $this->user->data['user_id'];
		$result = $this->db->sql_query($sql);
		$group_bypass = (int) $this->db->sql_fetchfield('group_bypass');
		$this->db->sql_freeresult($result);

		return $group_bypass;
	}
}
