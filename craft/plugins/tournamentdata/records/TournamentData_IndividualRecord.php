<?php
namespace Craft;

class TournamentData_IndividualRecord extends BaseRecord
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
		return 'tournamentdata_individual';
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
			'id'		=> array(AttributeType::Number, 'required' => false),
			'firstname' => array(AttributeType::String, 'required' => true),
			'lastname' 	=> array(AttributeType::String, 'required' => true),
			'isActive'	=> array(AttributeType::Bool, 'required' => true),
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