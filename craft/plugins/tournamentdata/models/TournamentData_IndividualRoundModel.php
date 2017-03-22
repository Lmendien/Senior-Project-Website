<?php
namespace Craft;

class TournamentData_IndividualRoundModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'individualId' 		=> AttributeType::Number,
            'tournamentRoundId' => AttributeType::Number,
			'isActive' 			=> AttributeType::Bool,
		);
	}
}