<?php
namespace Craft;

class TournamentData_TeamTournamentRecord extends BaseRecord
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
		return 'tournamentdata_teamtournament';
	}


	/**
	 * @inheritDoc BaseRecord::defineRelations()
	 *
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'team' => array(static::BELONGS_TO, "TournamentData_TeamRecord", 'required' => true, 'onDelete' => static::CASCADE),
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
			array('columns' => array('teamId'), 'unique' => true),
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
			'wins' 		=> array(AttributeType::Number, 'required' => true),
			'losses' 	=> array(AttributeType::Number, 'required' => true),
			'points' 	=> array(AttributeType::Number, 'required' => true),
			'isActive' 	=> array(AttributeType::Bool, 'required' => true),
		);
	}

	/**
	 * Create a new instance of the current class. This allows us to 
	 * properly unit test our service layer.
	 *
	 * @return BaseRecord
	 */
	public function create()
	{
		$class = get_class($this);
		$record = new $class();

		return $record;
	}
}
?>