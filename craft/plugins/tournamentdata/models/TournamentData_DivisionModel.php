<?php
namespace Craft;

class TournamentData_DivisionModel extends BaseModel
{
    protected function defineAttributes()
	{
		return array(
			'name' 		=> AttributeType::String,
			'isActive' 	=> AttributeType::Bool,
		);
	}
}