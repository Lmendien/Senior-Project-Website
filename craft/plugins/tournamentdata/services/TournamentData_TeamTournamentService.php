<?php
namespace Craft;

require_once __DIR__ . '/../models/TournamentData_TeamTournamentModel.php';
require_once __DIR__ . '/../records/TournamentData_TeamTournamentRecord.php';

/**
 * TeamTournament Member Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_TeamTournamentService extends BaseApplicationComponent
{
	protected $teamTournamentRecord;
	/**
	 * Create a new instance of the Individual Tournament Service.
	 * Constructor allows TeamTournamentRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord TeamTournamentRecord The individual tournament record to access the database
	 */
	public function __construct($teamTournamentRecord = null)
	{
	    $this->teamTournamentRecord = $teamTournamentRecord;
		if(is_null($this->teamTournamentRecord)) {
			$this->teamTournamentRecord = TournamentData_TeamTournamentRecord::model();
		}
	}

	/**
     * Get a new blank individual tournament
     *
     * @param  array                           $attributes
     * @return TournamentData_TeamTournamentModel
     */
    public function newTeamTournament($attributes = array())
    {
        $model = new TournamentData_TeamTournamentModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individual tournaments from the database.
     *
     * @return array
     */
    public function getAllTeamTournaments()
    {
        $records = $this->teamTournamentRecord->findAll(array('order'=>'t.id'));
        return TournamentData_TeamTournamentModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual tournament from the database based on ID. If no individual tournament exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getTeamTournamentById($id)
    {
        if ($record = $this->teamTournamentRecord->findByPk($id)) {
            return TournamentData_TeamTournamentModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual tournament back to the database.
     *
     * @param  TournamentData_TeamTournamentModel $model
     * @return bool
     */
    public function saveTeamTournament(TournamentData_TeamTournamentModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->teamTournamentRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->teamTournamentRecord->create();
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
    public function deleteTeamTournamentById($id)
    {
        if(null === ($record = $this->teamTournamentRecord->findByPk($id))) {
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
    public function undoDeleteTeamTournamentById($id)
    {
    	if(null === ($record = $this->teamTournamentRecord->findByPk($id))) {
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