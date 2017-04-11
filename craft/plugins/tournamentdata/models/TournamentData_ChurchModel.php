<?php
namespace Craft;

class TournamentData_ChurchModel extends BaseModel
{
    protected function defineAttributes()
    {
        return array(
            'id'		=> AttributeType::Number,
            'name'      => AttributeType::String,
            'address'   => AttributeType::String,
            'isActive'  => AttributeType::Bool,
        );
    }
}