<?php
namespace Craft;

class TournamentData_IndividualTournamentRecord extends BaseRecord
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
		return 'tournamentdata_individualtournament';
	}


	/**
	 * @inheritDoc BaseRecord::defineRelations()
	 *
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'individualround' => array(static::BELONGS_TO, "TournamentData_IndividualRoundRecord", 'required' => true, 'onDelete' => static::CASCADE),
			'division' => array(static::BELONGS_TO, "TournamentData_DivisionRecord", 'required' => true, 'onDelete' => static::CASCADE),
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
			array('columns' => array('individualroundId'), 'unique' => true),
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
			'notes' => array(AttributeType::String, 'required' => true),
			'points' => array(AttributeType::Number, 'required' => true),
			'isActive' => array(AttributeType::Bool, 'required' => true),
		);
	}
}
?>