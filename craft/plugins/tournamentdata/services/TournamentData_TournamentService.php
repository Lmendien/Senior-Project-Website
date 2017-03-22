<?php
namespace Craft;

class TournamentData_TournamentService extends BaseApplicationComponent
{
    public function saveTournament(TournamentData_TournamentModel $tournament)
    {
        $tournamentRecord = new TournamentData_TournamentRecord();

		$tournamentRecord->name 	= $tournament->name;
		$tournamentRecord->address  = $tournament->address;
        $tournamentRecord->date 	= $tournament->date;
        $tournamentRecord->portion 	= $tournament->portion;
        $tournamentRecord->final 	= $tournament->final;
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


	public function saveTournamentRound(TournamentData_TournamentRoundModel $tournamentRound)
    {
        $tournamentRoundRecord = new TournamentData_TournamentRoundRecord();

		$tournamentRoundRecord->round 		 = $tournamentRound->round;
        $tournamentRoundRecord->tournamentId = $tournamentRound->tournamentId;
		$tournamentRoundRecord->isActive 	 = $tournamentRound->isActive;
		
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


	public function saveTournamentTeam(TournamentData_TournamentTeamModel $tournamentTeamModel)
    {
        $tournamentTeamRecord = new TournamentData_TournamentRoundRecord();

		$tournamentTeamRecord->teamnumber	 	= $tournamentTeamModel->teamnumber;
        $tournamentTeamRecord->tournamentId 	= $tournamentTeamModel->tournamentId;
		$tournamentTeamRecord->isActive 	 	= $tournamentTeamModel->isActive;
		
		if ( $tournamentTeamRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($tournamentTeamRecord->getAttributes());
		}
    }

    public function deleteTournamentTeamById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_tournamentTeam', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteTournamentTeamById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_tournamentTeam', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}