<?php
namespace Craft;

class TournamentData_IndividualModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'firstname' => AttributeType::String,
			'lastname' 	=> AttributeType::String,
			'isActive' 	=> AttributeType::Bool,
		);
	}
}