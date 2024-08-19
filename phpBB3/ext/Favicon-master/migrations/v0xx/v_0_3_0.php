<?php
/**
*
* @package favicon
* @copyright (c) 2014 - 2022 Татьяна5
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace tatiana5\favicon\migrations\v0xx;

class v_0_3_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['favicon_version']) && version_compare($this->config['favicon_version'], '0.3.0', '>=');
	}

	static public function depends_on()
	{
		return ['\tatiana5\favicon\migrations\v0xx\v_0_2_0'];
	}

	public function update_data()
	{
		return [
			// Add configs
			['config.add', ['favicon_svg', '0']],
			['config.add', ['favicon_android', '0']],

			// Current version
			['config.update', ['favicon_version', '0.3.0']],
		];
	}
}
