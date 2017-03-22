<?php
namespace Craft;

class TournamentData_ChurchService extends BaseApplicationComponent
{
    public function saveChurch(TournamentData_ChurchModel $church)
    {
        $churchRecord = new TournamentData_ChurchRecord();

		$churchRecord->name 	= $church->name;
		$churchRecord->address 	= $church->address;
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



	public function saveChurchTeam(TournamentData_ChurchTeamModel $churchTeam)
    {
        $churchTeamRecord = new TournamentData_ChurchTeamRecord();

		$churchTeamRecord->churchId 		= $churchTeam->churchId;
		$churchTeamRecord->tournamentteamId = $churchTeam->tournamentteamId;
		$churchTeamRecord->isActive 		= $churchTeam->isActive;
		
		if ( $churchTeamRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($churchTeam->getAttributes());
		}
    }

    public function deleteChurchTeamById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_churchteam', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteChurchTeamById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_churchteam', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}