<?php
namespace Craft;

class TournamentData_ChurchRecord extends BaseRecord
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
		return 'tournamentdata_church';
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
			'name'		=> array(AttributeType::String, 'required' => true),
			'address' 	=> array(AttributeType::String, 'required' => false),
			'isActive' 	=> array(AttributeType::Bool, 'required' => true),
		);
	}

}
?>