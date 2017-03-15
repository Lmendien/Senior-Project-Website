<?php
namespace Craft;

class TournamentData_TournamentTeamModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
            'tournamentId' => AttributeType::Number,
			'teamnumber' => AttributeType::Number,
			'isActive' => AttributeType::Bool,
		);
	}
}



			