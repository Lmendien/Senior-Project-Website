<?php
namespace Craft;

class TournamentData_TournamentTeamRecord extends BaseRecord
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
		return 'tournamentdata_tournamentteam';
	}


	/**
	 * @inheritDoc BaseRecord::defineRelations()
	 *
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'tournament' => array(static::BELONGS_TO, "TournamentData_TournamentRecord", 'required' => true, 'onDelete' => static::CASCADE),
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
			array('columns' => array('tournamentId', 'teamnumber'), 'unique' => true)
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
			'teamnumber' => array(AttributeType::Number, 'required' => true),
			'isActive' => array(AttributeType::Bool, 'required' => true),
		);
	}
}
?>