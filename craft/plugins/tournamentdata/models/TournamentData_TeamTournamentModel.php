<?php
namespace Craft;

class TournamentData_TeamTournamentModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'id'			=> AttributeType::Number,
			'teamId' 		=> AttributeType::Number,
            'divisionId' 	=> AttributeType::Number,
            'wins' 			=> AttributeType::Number,
            'losses'		=> AttributeType::Number,
            'points' 		=> AttributeType::Number,
			'isActive' 		=> AttributeType::Bool,
		);
	}
}