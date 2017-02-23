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
			'firstname' => array(AttributeType::String, 'required' => true),
			'lastname' => array(AttributeType::String, 'required' => true),
			'isActive' => array(AttributeType::Bool, 'required' => true),
		);
	}

}
?>