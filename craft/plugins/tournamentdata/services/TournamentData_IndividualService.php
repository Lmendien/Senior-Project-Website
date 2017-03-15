<?php
namespace Craft;

class TournamentData_IndividualService extends BaseApplicationComponent
{
    public function saveIndividual(TournamentData_IndividualModel $individual)
    {
        $individualRecord = new TournamentData_IndividualRecord();

		$individualRecord->firstname = $individual->firstname;
        $individualRecord->lastname  = $individual->lastname;
		$individualRecord->isActive = $individual->isActive;
		
		if ( $individualRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($individual->getAttributes());
		}
    }

    public function deleteIndividualById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_individual', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteIndividualById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_individual', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}