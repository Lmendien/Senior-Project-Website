<?php
namespace Craft;

/**
 * TournamentTeam Record
 *
 * Provides a definition of the database tables required by our plugin,
 * and methods for updating the database. This class should only be called
 * by our service layer, to ensure a consistent API for the rest of the
 * application to use.
 */
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