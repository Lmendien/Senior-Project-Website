<?php
namespace Craft;
use \Mockery as m;
class TournamentData_ChurchServiceTest extends BaseTest
{
	protected $config;
	/**
	 * @Note
	 * 
	 * Getting model properties via $model->property works but...
	 * if you use $model->getAttribute('property') you code becomes more testable
	 */
	public function testSaveChurch()
	{}