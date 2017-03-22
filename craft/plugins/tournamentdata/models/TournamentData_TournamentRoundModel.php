<?php
namespace Craft;

class TournamentData_TournamentRoundModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
            'tournamentId' 	=> AttributeType::Number,
			'round' 		=> AttributeType::Number,
			'isActive' 		=> AttributeType::Bool,
		);
	}
}