<?php
namespace Craft;
require_once __DIR__ . '/../models/TournamentData_DivisionModel.php';
require_once __DIR__ . '/../records/TournamentData_DivisionRecord.php';

/**
 * Individual Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_DivisionService extends BaseApplicationComponent
{
	protected $divisionRecord;
	
	/**
	 * Create a new instance of the Division Service.
	 * Constructor allows DivisionRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @divisionRecord DivisionRecord The division record to access the database
	 */
	public function __construct($divisionRecord = null)
	{
	    $this->divisionRecord = $divisionRecord;
		if(is_null($this->divisionRecord)) {
			$this->divisionRecord = TournamentData_DivisionRecord::model();
		}
	}

    /**
     * Get a new blank division
     *
     * @param  array                           $attributes
     * @return TournamentData_DivisionModel
     */
    public function newDivision($attributes = array())
    {
        $model = new TournamentData_DivisionModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all divisions from the database.
     *
     * @return array
     */
    public function getAllDivisions()
    {
        $records = $this->divisionRecord->findAll(array('order'=>'t.name'));
        return TournamentData_DivisionModel::populateModels($records, 'id');
    }

	/**
     * Get a specific division from the database based on ID. If no division exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getDivisionById($id)
    {
        if ($record = $this->divisionRecord->findByPk($id)) {
            return TournamentData_DivisionModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing division back to the database.
     *
     * @param  TournamentData_DivisionModel $model
     * @return bool
     */
    public function saveDivision(TournamentData_DivisionModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->divisionRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find division with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->divisionRecord->create();
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
     * Delete an division from the database.
     *
     * @param  int $id
     * @return bool
     */
    public function deleteDivisionById($id)
    {
        if(null === ($record = $this->divisionRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find division with ID "{id}"', array('id' => $id)));
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
	 * Undo a delete on an division from the database.
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function undoDeleteDivisionById($id)
    {
    	if(null === ($record = $this->divisionRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find division with ID "{id}"', array('id' => $id)));
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