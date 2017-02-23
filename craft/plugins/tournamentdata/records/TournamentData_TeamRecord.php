<?php
namespace Craft;

class TournamentData_TeamRecord extends BaseRecord
{
	// Public Methods
	// =========================================================================

	/**
	 * @inheritDoc BaseRecord::getTableName()
	 *
	 * @return string
	 */
	public function getTableName()
	{
		return 'tournamentdata_team';
	}


	/**
	 * @inheritDoc BaseRecord::defineRelations()
	 *
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'church' => array(static::BELONGS_TO, "TournamentData_ChurchRecord", 'required' => true, 'onDelete' => static::CASCADE),
			'tournamentteam' => array(static::BELONGS_TO, "TournamentData_TournamentTeamRecord", 'required' => true, 'onDelete' => static::CASCADE),
		);
	}


	/**
	 * @inheritDoc BaseRecord::defineIndexes()
	 *
	 * @return array
	 */
	public function defineIndexes()
	{
		return array(
			array('columns' => array('churchId', 'tournamentteamId'), 'unique' => true),
		);
	}

	// Protected Methods
	// =========================================================================

	/**
	 * @inheritDoc BaseRecord::defineAttributes()
	 *
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array(
			'isActive' => array(AttributeType::Bool, 'required' => true),
		);
	}
}
?>