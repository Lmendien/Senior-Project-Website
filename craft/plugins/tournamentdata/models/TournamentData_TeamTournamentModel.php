<?php
namespace Craft;

class TournamentData_TeamModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'teamId' 		=> AttributeType::Number,
            'divisionId' 	=> AttributeType::Number,
            'wins' 			=> AttributeType::Number,
            'losses'		=> AttributeType::Number,
            'points' 		=> AttributeType::Number,
			'isActive' 		=> AttributeType::Bool,
		);
	}
}