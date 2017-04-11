<?php
namespace Craft;

require_once __DIR__ . '/../models/TournamentData_TournamentRoundModel.php';
require_once __DIR__ . '/../records/TournamentData_TournamentRoundRecord.php';

/**
 * TournamentRound Member Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_TournamentRoundService extends BaseApplicationComponent
{
	protected $tournamentRoundRecord;
	/**
	 * Create a new instance of the Individual Tournament Service.
	 * Constructor allows TournamentRoundRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord TournamentRoundRecord The individual tournament record to access the database
	 */
	public function __construct($tournamentRoundRecord = null)
	{
	    $this->tournamentRoundRecord = $tournamentRoundRecord;
		if(is_null($this->tournamentRoundRecord)) {
			$this->tournamentRoundRecord = TournamentData_TournamentRoundRecord::model();
		}
	}

	/**
     * Get a new blank individual tournament
     *
     * @param  array                           $attributes
     * @return TournamentData_TournamentRoundModel
     */
    public function newTournamentRound($attributes = array())
    {
        $model = new TournamentData_TournamentRoundModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individual tournaments from the database.
     *
     * @return array
     */
    public function getAllTournamentRounds()
    {
        $records = $this->tournamentRoundRecord->findAll(array('order'=>'t.id'));
        return TournamentData_TournamentRoundModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual tournament from the database based on ID. If no individual tournament exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getTournamentRoundById($id)
    {
        if ($record = $this->tournamentRoundRecord->findByPk($id)) {
            return TournamentData_TournamentRoundModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual tournament back to the database.
     *
     * @param  TournamentData_TournamentRoundModel $model
     * @return bool
     */
    public function saveTournamentRound(TournamentData_TournamentRoundModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->tournamentRoundRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->tournamentRoundRecord->create();
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
    public function deleteTournamentRoundById($id)
    {
        if(null === ($record = $this->tournamentRoundRecord->findByPk($id))) {
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
    public function undoDeleteTournamentRoundById($id)
    {
    	if(null === ($record = $this->tournamentRoundRecord->findByPk($id))) {
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