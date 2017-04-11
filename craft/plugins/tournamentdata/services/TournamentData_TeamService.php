<?php
namespace Craft;

require_once __DIR__ . '/../models/TournamentData_TeamModel.php';
require_once __DIR__ . '/../records/TournamentData_TeamRecord.php';

/**
 * Team Member Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_TeamService extends BaseApplicationComponent
{
	protected $teamRecord;
	/**
	 * Create a new instance of the Individual Tournament Service.
	 * Constructor allows TeamRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord TeamRecord The individual tournament record to access the database
	 */
	public function __construct($teamRecord = null)
	{
	    $this->teamRecord = $teamRecord;
		if(is_null($this->teamRecord)) {
			$this->teamRecord = TournamentData_TeamRecord::model();
		}
	}

	/**
     * Get a new blank individual tournament
     *
     * @param  array                           $attributes
     * @return TournamentData_TeamModel
     */
    public function newTeam($attributes = array())
    {
        $model = new TournamentData_TeamModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individual tournaments from the database.
     *
     * @return array
     */
    public function getAllTeams()
    {
        $records = $this->teamRecord->findAll(array('order'=>'t.id'));
        return TournamentData_TeamModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual tournament from the database based on ID. If no individual tournament exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getTeamById($id)
    {
        if ($record = $this->teamRecord->findByPk($id)) {
            return TournamentData_TeamModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual tournament back to the database.
     *
     * @param  TournamentData_TeamModel $model
     * @return bool
     */
    public function saveTeam(TournamentData_TeamModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->teamRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->teamRecord->create();
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
    public function deleteTeamById($id)
    {
        if(null === ($record = $this->teamRecord->findByPk($id))) {
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
    public function undoDeleteTeamById($id)
    {
    	if(null === ($record = $this->teamRecord->findByPk($id))) {
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