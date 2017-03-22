<?php
namespace Craft;

class TournamentData_TeamService extends BaseApplicationComponent
{
    public function saveTeam(TournamentData_TeamModel $team)
    {
        $teamRecord = new TournamentData_TeamRecord();

		$teamRecord->churchId          = $team->churchId;
        $teamRecord->tournamentteamId  = $team->tournamentteamId;
		$teamRecord->isActive          = $team->isActive;
		
		if ( $teamRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($team->getAttributes());
		}
    }

    public function deleteTeamById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_team', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteTeamById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_team', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }


    public function saveTeamMember(TournamentData_TeamMemberModel $teamMember)
    {
        $teamRecord = new TournamentData_TeamMemberRecord();

		$teamMemberRecord->churchteamId = $teamMember->churchteamId;
        $teamMemberRecord->individualId = $teamMember->individualId;
		$teamMemberRecord->isActive     = $teamMember->isActive;
		
		if ( $teamRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($team->getAttributes());
		}
    }

    public function deleteTeamMemberById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_teammember', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteTeamMemberById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_teammember', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function saveTeamTournament(TournamentData_TeamTournamentModel $teamTournamentModel)
    {
        $teamTournamentRecord = new TournamentData_TeamTournamentRecord();

		$teamTournamentRecord->teamId       = $teamTournamentModel->churchteamId;
        $teamTournamentRecord->divisionId   = $teamTournamentModel->divisionId;
        $teamTournamentRecord->wins         = $teamTournamentModel->wins;
        $teamTournamentRecord->losses       = $teamTournamentModel->losses;
        $teamTournamentRecord->points       = $teamTournamentModel->points;
		$teamTournamentRecord->isActive     = $teamTournamentModel->isActive;

		if ( $teamTournamentRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($teamTournamentRecord->getAttributes());
		}
    }

    public function deleteTeamTournamentById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_teamtournament', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteTeamTournamentById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_teamtournament', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}