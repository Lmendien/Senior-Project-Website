<?php
namespace Craft;

class TournamentData_TeamModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'id'				=> AttributeType::Number,
			'churchId' 			=> AttributeType::Number,
            'tournamentteamId' 	=> AttributeType::Number,
			'isActive' 			=> AttributeType::Bool,
		);
	}
}