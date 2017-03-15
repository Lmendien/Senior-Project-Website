<?php
namespace Craft;

class TournamentData_TournamentService extends BaseApplicationComponent
{
    public function saveTournament(TournamentData_TournamentModel $tournament)
    {
        $tournamentRecord = new TournamentData_TournamentRecord();

		$tournamentRecord->name = $tournament->name;
		$tournamentRecord->address = $tournament->address;
        $tournamentRecord->date = $tournament->date;
        $tournamentRecord->portion = $tournament->portion;
        $tournamentRecord->final = $tournament->final;
		$tournamentRecord->isActive = $tournament->isActive;
		
		if ( $tournamentRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($tournament->getAttributes());
		}
    }

    public function deleteTournamentById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_tournament', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteTournamentById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_tournament', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}