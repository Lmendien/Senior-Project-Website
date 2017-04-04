<?php
namespace Craft;
/**
 * Individual Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_IndividualService extends BaseApplicationComponent
{
	protected $individualRecord;
	/**
	 * Create a new instance of the Individual Tournament Service.
	 * Constructor allows IndividualTournamentRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord IndividualTournamentRecord The individual tournament record to access the database
	 */
	public function __construct($individualTournamentRecord = null)
	{
	    $this->individualTournamentRecord = $individualTournamentRecord;
		if(is_null($this->individualTournamentRecord)) {
			$this->individualTournamentRecord = TournamentData_IndividualTournamentRecord::model();
		}
	}

	/**
     * Get a new blank individual tournament
     *
     * @param  array                           $attributes
     * @return TournamentData_IndividualTournamentModel
     */
    public function newIndividualTournament($attributes = array())
    {
        $model = new TournamentData_IndividualTournamentModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individual tournaments from the database.
     *
     * @return array
     */
    public function getAllIndividualTournaments()
    {
        $records = $this->individualTournamentRecord->findAll(array('order'=>'t.name'));
        return TournamentData_IndividualTournamentModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual tournament from the database based on ID. If no individual tournament exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getIndividualTournamentById($id)
    {
        if ($record = $this->individualTournamentRecord->findByPk($id)) {
            return TournamentData_IndividualTournamentModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual tournament back to the database.
     *
     * @param  TournamentData_IndividualTournamentModel $model
     * @return bool
     */
    public function saveIndividualTournament(TournamentData_IndividualTournamentModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->individualTournamentRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual tournament with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->individualTournamentRecord->create();
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
    public function deleteIndividualTournamentById($id)
    {
        if(null === ($record = $this->individualTournamentRecord->findByPk($id))) {
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
    public function undoDeleteIndividualTournamentById($id)
    {
    	if(null === ($record = $this->individualTournamentRecord->findByPk($id))) {
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