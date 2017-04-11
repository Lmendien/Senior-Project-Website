<?php
namespace Craft;

class TournamentDataPlugin extends BasePlugin
{
	function getName()
	{
		return Craft::t('Tournament Data');
	}

	function getVersion()
	{
		return '1.3';
	}
	
	function getSchemaVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Chris, Ben, Aaron, and Zach';
	}

	function getDeveloperUrl()
	{
		return 'https://github.com/Lmendien/Senior-Project-Website';
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('tournamentdata/settings', array(
           'settings' => $this->getSettings()
       ));
	}

	//Protected functions
	protected function defineSettings()
	{
		return array(
			'examples' => array(AttributeType::Mixed, 'default' => array('Example1', 'Example2', 'Example3')),
		);
	}
}
?>