<?php
namespace Craft;

class TournamentData_IndividualModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'id'		=> AttributeType::Number,
			'firstname' => AttributeType::String,
			'lastname' 	=> AttributeType::String,
			'isActive' 	=> AttributeType::Bool,
		);
	}
}