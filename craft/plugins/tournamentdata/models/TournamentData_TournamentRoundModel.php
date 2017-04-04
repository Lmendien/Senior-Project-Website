<?php
namespace Craft;

class TournamentData_TournamentRoundModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'id'			=> AttributeType::Number,
            'tournamentId' 	=> AttributeType::Number,
			'round' 		=> AttributeType::Number,
			'isActive' 		=> AttributeType::Bool,
		);
	}
}