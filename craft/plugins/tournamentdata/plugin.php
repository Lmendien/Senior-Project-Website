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
		return '0.1';
	}

	function getDeveloper()
	{
		return 'Chris, Ben, Aaron, and Zach';
	}

	function getSchemaVersion()
	{
		return '0.1';
	}

	protected function defineSettings()
	{
		return array(
			'tournamentCategories' => array(AttributeType::Mixed, 'default' => array('Sours', 'Fizzes', 'Juleps')),
		);
	}

	public function hasCpSection()
	{
		return true;
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('tournamentCategories/settings', array('settings' => $this->getSettings()
		));
	}

	public function registerCpRoutes()
    {
        return array();
    }
}
?>