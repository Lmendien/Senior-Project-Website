<?php
namespace Craft;

class TournamentData_ChurchService extends BaseApplicationComponent
{
    public function saveChurch(TournamentData_ChurchModel $church)
    {
        $churchRecord = new TournamentData_ChurchRecord();

		$churchRecord->name = $church->name;
		$churchRecord->address = $church->address;
		$churchRecord->isActive = $church->isActive;
		
		if ( $churchRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($church->getAttributes());
		}
    }

    public function deleteChurchById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_church', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteChurchById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_church', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}