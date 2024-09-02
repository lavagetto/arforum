<?php
/**
*
* @package favicon
* @copyright (c) 2014 - 2022 Татьяна5
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace tatiana5\favicon\migrations\v0xx;

class v_0_0_2 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['favicon_version']) && version_compare($this->config['favicon_version'], '0.0.2', '>=');
	}

	static public function depends_on()
	{
			return ['\phpbb\db\migration\data\v310\dev'];
	}

	public function update_data()
	{
		return [
			// Add configs
			['config.add', ['favicon_ext', 'ico']],

			// Current version
			['config.add', ['favicon_version', '0.0.2']],

			// Add ACP modules
			['module.add', ['acp', 'ACP_CAT_DOT_MODS', 'ACP_FAVICON']],
			['module.add', ['acp', 'ACP_FAVICON', [
					'module_basename'	=> '\tatiana5\favicon\acp\favicon_module',
					'module_langname'	=> 'ACP_FAVICON_EXPLAIN',
					'module_mode'		=> 'config_favicon',
					'module_auth'		=> 'ext_tatiana5/favicon && acl_a_',
			]]],
		];
	}
}
