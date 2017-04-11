<?php
namespace Craft;

class TournamentData_IndividualTournamentModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'id'				=> AttributeType::Number,
			'individualroundId' => AttributeType::Number,
            'divisionId' 		=> AttributeType::Number,
            'notes' 			=> AttributeType::String,
            'points' 			=> AttributeType::Number,
			'isActive' 			=> AttributeType::Bool,
		);
	}
}