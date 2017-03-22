<?php
namespace Craft;

class TournamentData_TournamentModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'name' 		=> AttributeType::String,
			'address' 	=> AttributeType::String,
			'date' 		=> AttributeType::DateTime,
			'portion' 	=> AttributeType::String,
			'final' 	=> AttributeType::Bool,
			'isActive' 	=> AttributeType::Bool,
		);
	}
}