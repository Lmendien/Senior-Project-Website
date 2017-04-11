<?php
namespace Craft;
require_once __DIR__ . '/../models/TournamentData_IndividualRoundModel.php';
require_once __DIR__ . '/../records/TournamentData_IndividualRoundRecord.php';
/**
 * Individual Service
 * 
 * Provides a consistent API for the plugin to access the database
 */
class TournamentData_IndividualRoundService extends BaseApplicationComponent
{
	protected $individualRoundRecord;
	/**
	 * Create a new instance of the Individual Round Service.
	 * Constructor allows IndividualRecord dependency to be injected to assist with unit testing.
	 *
	 * @param @individualRecord IndividualRecord The individual record to access the database
	 */
	public function __construct($individualRoundRecord = null)
	{
	    $this->individualRoundRecord = $individualRoundRecord;
		if(is_null($this->individualRoundRecord)) {
			$this->individualRoundRecord = TournamentData_IndividualRoundRecord::model();
		}
	}

	/**
     * Get a new blank individual round
     *
     * @param  array                           $attributes
     * @return TournamentData_IndividualRoundModel
     */
    public function newIndividualRound($attributes = array())
    {
        $model = new TournamentData_IndividualRoundModel();
        $model->setAttributes($attributes);
        return $model;
    }

	/**
     * Get all individual rounds from the database.
     *
     * @return array
     */
    public function getAllIndividualRounds()
    {
        $records = $this->individualRoundRecord->findAll(array('order'=>'t.id'));
        return TournamentData_IndividualRoundModel::populateModels($records, 'id');
    }

	/**
     * Get a specific individual round from the database based on ID. If no individual exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getIndividualRoundById($id)
    {
        if ($record = $this->individualRoundRecord->findByPk($id)) {
            return TournamentData_IndividualRoundModel::populateModel($record);
        }
    }

	/**
     * Save a new or existing individual round back to the database.
     *
     * @param  TournamentData_IndividualRoundModel $model
     * @return bool
     */
    public function saveIndividualRound(TournamentData_IndividualRoundModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->individualRoundRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find individual with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->individualRoundRecord->create();
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
     * Delete an individual round from the database.
     *
     * @param  int $id
     * @return bool
     */
    public function deleteIndividualRoundById($id)
    {
        if(null === ($record = $this->individualRoundRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find individual round with ID "{id}"', array('id' => $id)));
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
	 * Undo a delete on an individual round from the database.
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function undoDeleteIndividualRoundById($id)
    {
    	if(null === ($record = $this->individualRoundRecord->findByPk($id))) {
			throw new Exception(Craft::t('Can\'t find individual round with ID "{id}"', array('id' => $id)));
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