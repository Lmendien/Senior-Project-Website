<?php
namespace Craft;
require_once __DIR__ . '/../models/TournamentData_ChurchTeamModel.php';
require_once __DIR__ . '/../records/TournamentData_ChurchTeamRecord.php';

/**
 * Individual Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_ChurchTeamService extends BaseApplicationComponent
{
	protected $churchTeamRecord;
	
	/**
	 * Create a new instance of the ChurchTeam Service.
	 * Constructor allows ChurchTeamRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @churchTeamRecord ChurchTeamRecord The churchTeam record to access the database
	 */
	public function __construct($churchTeamRecord = null)
	{
	    $this->churchTeamRecord = $churchTeamRecord;
		if(is_null($this->churchTeamRecord)) {
			$this->churchTeamRecord = TournamentData_ChurchTeamRecord::model();
		}
	}

    /**
     * Get a new blank churchTeam
     *
     * @param  array                           $attributes
     * @return TournamentData_ChurchTeamModel
     */
    public function newChurchTeam($attributes = array())
    {
        $model = new TournamentData_ChurchTeamModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all churchTeams from the database.
     *
     * @return array
     */
    public function getAllChurchTeams()
    {
        $records = $this->churchTeamRecord->findAll(array('order'=>'t.id'));
        return TournamentData_ChurchTeamModel::populateModels($records, 'id');
    }

	/**
     * Get a specific churchTeam from the database based on ID. If no churchTeam exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getChurchTeamById($id)
    {
        if ($record = $this->churchTeamRecord->findByPk($id)) {
            return TournamentData_ChurchTeamModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing churchTeam back to the database.
     *
     * @param  TournamentData_ChurchTeamModel $model
     * @return bool
     */
    public function saveChurchTeam(TournamentData_ChurchTeamModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->churchTeamRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find churchTeam with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->churchTeamRecord->create();
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
     * Delete an churchTeam from the database.
     *
     * @param  int $id
     * @return bool
     */
    public function deleteChurchTeamById($id)
    {
        if(null === ($record = $this->churchTeamRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find churchTeam with ID "{id}"', array('id' => $id)));
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
	 * Undo a delete on an churchTeam from the database.
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function undoDeleteChurchTeamById($id)
    {
    	if(null === ($record = $this->churchTeamRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find churchTeam with ID "{id}"', array('id' => $id)));
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