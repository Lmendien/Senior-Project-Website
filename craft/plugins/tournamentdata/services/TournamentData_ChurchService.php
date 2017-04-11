<?php
namespace Craft;
require_once __DIR__ . '/../models/TournamentData_ChurchModel.php';
require_once __DIR__ . '/../records/TournamentData_ChurchRecord.php';
/**
 * Individual Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_ChurchService extends BaseApplicationComponent
{
	protected $churchRecord;
	
	/**
	 * Create a new instance of the Church Service.
	 * Constructor allows ChurchRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @churchRecord ChurchRecord The church record to access the database
	 */
	public function __construct($churchRecord = null)
	{
	    $this->churchRecord = $churchRecord;
		if(is_null($this->churchRecord)) {
			$this->churchRecord = TournamentData_ChurchRecord::model();
		}
	}

    /**
     * Get a new blank church
     *
     * @param  array                           $attributes
     * @return TournamentData_ChurchModel
     */
    public function newChurch($attributes = array())
    {
        $model = new TournamentData_ChurchModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all churches from the database.
     *
     * @return array
     */
    public function getAllChurches()
    {
        $records = $this->churchRecord->findAll(array('order'=>'t.name'));
        return TournamentData_ChurchModel::populateModels($records, 'id');
    }

	/**
     * Get a specific church from the database based on ID. If no church exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getChurchById($id)
    {
        if ($record = $this->churchRecord->findByPk($id)) {
            return TournamentData_ChurchModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing church back to the database.
     *
     * @param  TournamentData_ChurchModel $model
     * @return bool
     */
    public function saveChurch(TournamentData_ChurchModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->churchRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find church with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->churchRecord->create();
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
     * Delete an church from the database.
     *
     * @param  int $id
     * @return bool
     */
    public function deleteChurchById($id)
    {
        if(null === ($record = $this->churchRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find church with ID "{id}"', array('id' => $id)));
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
	 * Undo a delete on an church from the database.
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function undoDeleteChurchById($id)
    {
    	if(null === ($record = $this->churchRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find church with ID "{id}"', array('id' => $id)));
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