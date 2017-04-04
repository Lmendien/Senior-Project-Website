<?php
namespace Craft;

class TournamentData_TournamentRecord extends BaseRecord
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
		return 'tournamentdata_tournament';
	}

	/**
	 * @inheritDoc BaseRecord::defineIndexes()
	 *
	 * @return array
	 */
	public function defineIndexes()
	{
		return array(
			array('columns' => array('uid')),
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
			'name' 		=> array(AttributeType::String, 'required' => true),
			'address' 	=> array(AttributeType::String, 'required' => false),
			'date' 		=> array(AttributeType::DateTime, 'required' => false),
			'portion' 	=> array(AttributeType::String, 'required' => false),
			'final' 	=> array(AttributeType::Bool, 'required' => true),
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