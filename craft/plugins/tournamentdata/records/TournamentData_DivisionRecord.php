<?php
namespace Craft;

class TournamentData_DivisionRecord extends BaseRecord
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
		return 'tournamentdata_division';
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
			'isActive' 	=> array(AttributeType::Bool, 'required' => true),
		);
	}
}
?>