<?php
namespace Craft;

class TournamentData_DivisionService extends BaseApplicationComponent
{
    public function saveDivision(TournamentData_DivisionModel $division)
    {
        $divisionRecord = new TournamentData_DivisionRecord();

		$divisionRecord->name = $division->name;
		$divisionRecord->isActive = $division->isActive;
		
		if ( $divisionRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($division->getAttributes());
		}
    }

    public function deleteDivisionById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_division', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteDivisionById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_division', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}