<?php
namespace Craft;

class TournamentData_TournamentModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'churchId' => AttributeType::Number,
			'tournamentteamId' => AttributeType::Number,
			'isActive' => AttributeType::Bool,
		);
	}
}