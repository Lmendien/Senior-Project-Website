<?php
namespace Craft;

class TournamentData_IndividualRoundModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'id'				=> AttributeType::Number,
			'individualId' 		=> AttributeType::Number,
            'tournamentRoundId' => AttributeType::Number,
			'isActive' 			=> AttributeType::Bool,
		);
	}
}