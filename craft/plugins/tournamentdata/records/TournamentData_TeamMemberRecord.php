<?php
namespace Craft;

class TournamentData_TeamMemberRecord extends BaseRecord
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
		return 'tournamentdata_teammember';
	}


	/**
	 * @inheritDoc BaseRecord::defineRelations()
	 *
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'churchteam' => array(static::BELONGS_TO, "TournamentData_ChurchTeamRecord", 'required' => true, 'onDelete' => static::CASCADE),
			'individual' => array(static::BELONGS_TO, "TournamentData_IndividualRecord", 'required' => true, 'onDelete' => static::CASCADE),
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
			array('columns' => array('churchteamId, individualId'), 'unique' => true),
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