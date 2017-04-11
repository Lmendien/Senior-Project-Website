<?php
namespace Craft;

require_once __DIR__ . '/../models/TournamentData_TournamentTeamModel.php';
require_once __DIR__ . '/../records/TournamentData_TournamentTeamRecord.php';

/**
 * TournamentTeam Member Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_TournamentTeamService extends BaseApplicationComponent
{
	protected $tournamentTeamRecord;
	/**
	 * Create a new instance of the Individual Tournament Service.
	 * Constructor allows TournamentTeamRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord TournamentTeamRecord The individual tournament record to access the database
	 */
	public function __construct($tournamentTeamRecord = null)
	{
	    $this->tournamentTeamRecord = $tournamentTeamRecord;
		if(is_null($this->tournamentTeamRecord)) {
			$this->tournamentTeamRecord = TournamentData_TournamentTeamRecord::model();
		}
	}

	/**
     * Get a new blank individual tournament
     *
     * @param  array                           $attributes
     * @return TournamentData_TournamentTeamModel
     */
    public function newTournamentTeam($attributes = array())
    {
        $model = new TournamentData_TournamentTeamModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individual tournaments from the database.
     *
     * @return array
     */
    public function getAllTournamentTeams()
    {
        $records = $this->tournamentTeamRecord->findAll(array('order'=>'t.id'));
        return TournamentData_TournamentTeamModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual tournament from the database based on ID. If no individual tournament exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getTournamentTeamById($id)
    {
        if ($record = $this->tournamentTeamRecord->findByPk($id)) {
            return TournamentData_TournamentTeamModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual tournament back to the database.
     *
     * @param  TournamentData_TournamentTeamModel $model
     * @return bool
     */
    public function saveTournamentTeam(TournamentData_TournamentTeamModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->tournamentTeamRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->tournamentTeamRecord->create();
        }
        $record->setAttributes($model->getAttributes());
        if ($record->save()) {
            // update id on model (for new records)
            $model->setAttribute('id', $record->getAttribute('id'));
            return true;
        } else {
            $model->addErrors($record->getErrors());
            return false;
        }
    }

	/**
     * Delete an individual tournament from the database.
     *
     * @param  int $id
     * @return bool
     */
    public function deleteTournamentTeamById($id)
    {
        if(null === ($record = $this->tournamentTeamRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
		}
		else {
			$record->setAttribute('isActive', false);
		}
		if($record->save()) {
			return true;
		}
		else {
			return false;
		}
    }

	/**
	 * Undo a delete on an individual tournament from the database.
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function undoDeleteTournamentTeamById($id)
    {
    	if(null === ($record = $this->tournamentTeamRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
		}
		else {
			$record->setAttribute('isActive', true);
		}
		if($record->save()) {
			return true;
		}
		else {
			return false;
		}
    }
}