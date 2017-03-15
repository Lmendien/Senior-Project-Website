<?php
namespace Craft;

class TournamentData_TournamentRoundService extends BaseApplicationComponent
{
    public function saveTournamentRound(TournamentData_TournamentRoundModel $tournamentRound)
    {
        $tournamentRoundRecord = new TournamentData_TournamentRoundRecord();

		$tournamentRoundRecord->round = $tournamentRound->round;
        $tournamentRoundRecord->tournamentId = $tournamentRound->tournamentId;
		$tournamentRoundRecord->isActive = $tournamentRound->isActive;
		
		if ( $tournamentRoundRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($tournamentRound->getAttributes());
		}
    }

    public function deleteTournamentRoundById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_tournamentRound', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteTournamentRoundById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_tournamentRound', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}