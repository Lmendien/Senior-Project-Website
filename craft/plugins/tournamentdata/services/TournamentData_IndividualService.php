<?php
namespace Craft;
require_once __DIR__ . '/../models/TournamentData_IndividualModel.php';
require_once __DIR__ . '/../records/TournamentData_IndividualRecord.php';
/**
 * Individual Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_IndividualService extends BaseApplicationComponent
{
	protected $individualRecord;
	/**
	 * Create a new instance of the Individual Service.
	 * Constructor allows IndividualRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord IndividualRecord The individual record to access the database
	 */
	public function __construct($individualRecord = null)
	{
	    $this->individualRecord = $individualRecord;
		if(is_null($this->individualRecord)) {
			$this->individualRecord = TournamentData_IndividualRecord::model();
		}
	}

	/**
     * Get a new blank individual
     *
     * @param  array                           $attributes
     * @return TournamentData_IndividualModel
     */
    public function newIndividual($attributes = array())
    {
        $model = new TournamentData_IndividualModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individuals from the database.
     *
     * @return array
     */
    public function getAllIndividuals()
    {
        $records = $this->individualRecord->findAll(array('order'=>'t.name'));
        return TournamentData_IndividualModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual from the database based on ID. If no individual exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getIndividualById($id)
    {
        if ($record = $this->individualRecord->findByPk($id)) {
            return TournamentData_IndividualModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual back to the database.
     *
     * @param  TournamentData_IndividualModel $model
     * @return bool
     */
    public function saveIndividual(TournamentData_IndividualModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->individualRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->individualRecord->create();
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
     * Delete an individual from the database.
     *
     * @param  int $id
     * @return bool
     */
    public function deleteIndividualById($id)
    {
        if(null === ($record = $this->individualRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find individual with ID "{id}"', array('id' => $id)));
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
	 * Undo a delete on an individual from the database.
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function undoDeleteIndividualById($id)
    {
    	if(null === ($record = $this->individualRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find individual with ID "{id}"', array('id' => $id)));
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