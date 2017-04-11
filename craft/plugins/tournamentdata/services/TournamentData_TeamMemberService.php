<?php
namespace Craft;

require_once __DIR__ . '/../models/TournamentData_TeamMemberModel.php';
require_once __DIR__ . '/../records/TournamentData_TeamMemberRecord.php';

/**
 * Team Member Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_TeamMemberService extends BaseApplicationComponent
{
	protected $teamMemberRecord;
	/**
	 * Create a new instance of the Individual Tournament Service.
	 * Constructor allows TeamMemberRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord TeamMemberRecord The individual tournament record to access the database
	 */
	public function __construct($teamMemberRecord = null)
	{
	    $this->teamMemberRecord = $teamMemberRecord;
		if(is_null($this->teamMemberRecord)) {
			$this->teamMemberRecord = TournamentData_TeamMemberRecord::model();
		}
	}

	/**
     * Get a new blank individual tournament
     *
     * @param  array                           $attributes
     * @return TournamentData_TeamMemberModel
     */
    public function newTeamMember($attributes = array())
    {
        $model = new TournamentData_TeamMemberModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individual tournaments from the database.
     *
     * @return array
     */
    public function getAllTeamMembers()
    {
        $records = $this->teamMemberRecord->findAll(array('order'=>'t.id'));
        return TournamentData_TeamMemberModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual tournament from the database based on ID. If no individual tournament exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getTeamMemberById($id)
    {
        if ($record = $this->teamMemberRecord->findByPk($id)) {
            return TournamentData_TeamMemberModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual tournament back to the database.
     *
     * @param  TournamentData_TeamMemberModel $model
     * @return bool
     */
    public function saveTeamMember(TournamentData_TeamMemberModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->teamMemberRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->teamMemberRecord->create();
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
    public function deleteTeamMemberById($id)
    {
        if(null === ($record = $this->teamMemberRecord->findByPk($id))) {
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
    public function undoDeleteTeamMemberById($id)
    {
    	if(null === ($record = $this->teamMemberRecord->findByPk($id))) {
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