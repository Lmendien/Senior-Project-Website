<?php
namespace Craft;

class TournamentData_IndividualService extends BaseApplicationComponent
{
    public function saveIndividual(TournamentData_IndividualModel $individual)
    {
        $individualRecord = new TournamentData_IndividualRecord();

		$individualRecord->firstname = $individual->firstname;
        $individualRecord->lastname  = $individual->lastname;
		$individualRecord->isActive  = $individual->isActive;
		
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


	public function saveIndividualRound(TournamentData_IndividualRoundModel $individual)
    {
        $individualRecord = new TournamentData_IndividualRoundRecord();

		$individualRecord->firstname = $individual->firstname;
        $individualRecord->lastname  = $individual->lastname;
		$individualRecord->isActive  = $individual->isActive;
		
		if ( $individualRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($individualRound->getAttributes());
		}
    }

    public function deleteIndividualRoundById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_individualround', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteIndividualRoundById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_individualround', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

	public function saveIndividualTournament(TournamentData_IndividualTournamentModel $individualTournamentModel)
    {
        $individualTournamentRecord = new TournamentData_IndividualTournamentRecord();

		$individualTournamentRecord->individualRoundId = $individualTournamentModel->individualroundId;
		$individualTournamentRecord->divisionId = $individualTournamentModel->divisionId;
		$individualTournamentRecord->notes = $individualTournamentModel->notes;
        $individualTournamentRecord->points  = $individualTournamentModel->points;
		$individualTournamentRecord->isActive  = $individualTournamentModel->isActive;
		
		if ( $individualTournamentRecord->save() )
		{
		    error_log('SUCCESS');
		}
		else
		{
			error_log($individualTournamentRound->getAttributes());
		}
    }

    public function deleteIndividualTournamentById($id)
    {
        return craft()->db->createCommand()
        	->update('tournamentdata_individualtournament', array(
        			'isActive' => false,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }

    public function undoDeleteIndividualTournamentById($id)
    {
    	return craft()->db->createCommand()
        	->update('tournamentdata_individualtournament', array(
        			'isActive' => true,
        		), 'id=:id', array(':id' => $id))
        	->execute();
    }
}