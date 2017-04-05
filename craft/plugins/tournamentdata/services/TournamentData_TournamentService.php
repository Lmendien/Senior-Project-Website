<?php
namespace Craft;

require_once __DIR__ . '/../models/TournamentData_TournamentModel.php';
require_once __DIR__ . '/../records/TournamentData_TournamentRecord.php';

/**
 * Tournament Member Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_TournamentService extends BaseApplicationComponent
{
	protected $tournamentRecord;
	/**
	 * Create a new instance of the Individual Tournament Service.
	 * Constructor allows TournamentRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord TournamentRecord The individual tournament record to access the database
	 */
	public function __construct($tournamentRecord = null)
	{
	    $this->tournamentRecord = $tournamentRecord;
		if(is_null($this->tournamentRecord)) {
			$this->tournamentRecord = TournamentData_TournamentRecord::model();
		}
	}

	/**
     * Get a new blank individual tournament
     *
     * @param  array                           $attributes
     * @return TournamentData_TournamentModel
     */
    public function newTournament($attributes = array())
    {
        $model = new TournamentData_TournamentModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individual tournaments from the database.
     *
     * @return array
     */
    public function getAllTournaments()
    {
        $records = $this->tournamentRecord->findAll(array('order'=>'t.id'));
        return TournamentData_TournamentModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual tournament from the database based on ID. If no individual tournament exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getTournamentById($id)
    {
        if ($record = $this->tournamentRecord->findByPk($id)) {
            return TournamentData_TournamentModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual tournament back to the database.
     *
     * @param  TournamentData_TournamentModel $model
     * @return bool
     */
    public function saveTournament(TournamentData_TournamentModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->tournamentRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->tournamentRecord->create();
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
    public function deleteTournamentById($id)
    {
        if(null === ($record = $this->tournamentRecord->findByPk($id))) {
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
    public function undoDeleteTournamentById($id)
    {
    	if(null === ($record = $this->tournamentRecord->findByPk($id))) {
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