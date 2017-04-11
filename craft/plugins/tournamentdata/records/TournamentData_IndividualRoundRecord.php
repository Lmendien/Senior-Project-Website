<?php
namespace Craft;

class TournamentData_IndividualRoundRecord extends BaseRecord
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
		return 'tournamentdata_individualround';
	}


	/**
	 * @inheritDoc BaseRecord::defineRelations()
	 *
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'tournamentround' => array(static::BELONGS_TO, "TournamentData_TournamentRoundRecord", 'required' => true, 'onDelete' => static::CASCADE),
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
			array('columns' => array('individualId, tournamentroundId'), 'unique' => true),
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