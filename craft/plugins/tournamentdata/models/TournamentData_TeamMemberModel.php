<?php
namespace Craft;

class TournamentData_TeamMemberModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'churchteamId' => AttributeType::Number,
            'individualId' => AttributeType::Number,
			'isActive' => AttributeType::Bool,
		);
	}
}