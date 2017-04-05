<?php
namespace Craft;

use \Mockery as m;
use PHPUnit_Framework_TestCase;

//Run tests, changing directory locations as needed, functional command:
//php -c C:\MAMP\bin\php\php5.6.28\php.ini "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\vendor\phpunit-5.7.17.phar" --bootstrap "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\tests\bootstrap.php" --configuration "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\tests\phpunit.xml" "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\plugins\tournamentdata\tests"

//In your php.ini file, make sure the following extensions are enabled:
//php_mbstring.dll
//php_openssl.dll

//Check your ext folder to see if php_pdo_mysql.dll exists, if not go to the following url:
//http://windows.php.net/downloads/releases/archives/
//and download the correct dll folder to match your php version (you can check it in the command line with php -v), and windows system (32 bit or 64 bit)
//If using a mac, there will likely be an equivalent site with those files
//If running it still gives an error, try switching to the non-thread safe version, or thread safe if you started with the NTS version

//Non-functioning commands
//php -c "C:\Program Files (x86)\Ampps\conf\php-5.6.ini" "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\vendor\phpunit-5.7.17.phar" --bootstrap "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\tests\bootstrap.php" --configuration "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\tests\phpunit.xml" "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\plugins\tournamentdata\tests"
//php -c "C:\PHP\php.ini" "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\vendor\phpunit-5.7.17.phar" --bootstrap "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\tests\bootstrap.php" --configuration "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\app\tests\phpunit.xml" "C:\Users\Chris Foss\Documents\GitHub\Senior-Project-Website\craft\plugins\tournamentdata\tests"
class TournamentData_TournamentTeamServiceTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->loadServices();
		$this->tournamentTeamRecord = m::mock('Craft\TournamentData_TournamentTeamRecord');
		$this->service = new TournamentData_TournamentTeamService($this->tournamentTeamRecord);
	}

	protected function loadServices()
	{
		require_once __DIR__ . '/../../services/TournamentData_TournamentTeamService.php';
	}

	public function testNewTournamentTeam()
	{
		$result = $this->service->newTournamentTeam();

		$this->assertInstanceOf('Craft\TournamentData_TournamentTeamModel', $result);
	}

	public function testNewTournamentTeamWithAttributes()
	{
		$result = $this->service->newTournamentTeam(array('id' => 5));

		$this->assertInstanceOf('Craft\TournamentData_TournamentTeamModel', $result);
		$this->assertEquals(5, $result->id);
	}

	public function testGetAllTournamentTeams()
	{
		$fakeResults = array(array('id' => 3), array('id' => 5));

		$this->tournamentTeamRecord
		     ->shouldReceive('findAll')->with(array('order' => 't.id'))
			 ->andReturn($fakeResults);
		
		$results = $this->service->getAllTournamentTeams();

		$this->assertEquals(2, count($results));
		$this->assertInstanceOf('Craft\TournamentData_TournamentTeamModel', $results[5]);
	}

	public function testGetTournamentTeamById()
    {
        $attributes = array('id' => 5);
        $mockRecord = m::mock('Craft\TournamentData_TournamentTeamModel');
        $this->tournamentTeamRecord
            ->shouldReceive('findByPk')->with(5)
            ->andReturn($mockRecord);
        $mockRecord->shouldReceive('getAttributes')->andReturn($attributes);
        $result = $this->service->getTournamentTeamById(5);
        $this->assertInstanceOf('Craft\TournamentData_TournamentTeamModel', $result);
        $this->assertEquals(5, $result->id);
    }

    public function testGetTournamentTeamByMissingId()
    {
        $this->tournamentTeamRecord->shouldReceive('findByPk')->with(5)
            ->andReturn(null);
        $result = $this->service->getTournamentTeamById(5);
        $this->assertNull($result);
    }

    public function testSaveTournamentTeam()
    {
        $mockModel = m::mock('Craft\TournamentData_TournamentTeamModel');
        $mockModel->shouldReceive('getAttribute')->with('id')->once()->andReturn(5);
        $mockRecord = m::mock('Craft\TournamentData_TournamentTeamRecord');
        $this->tournamentTeamRecord->shouldReceive('findByPk')->with(5)->once()
            ->andReturn($mockRecord);
        $attributes = array('name' => 'example');
        $mockModel->shouldReceive('getAttributes')->once()->andReturn($attributes);
        $mockRecord->shouldReceive('setAttributes')->with($attributes)->once();
        $mockRecord->shouldReceive('save')->once()->andReturn(true);
        $mockRecord->shouldReceive('getAttribute')->with('id')->once()
            ->andReturn(5);
        $mockModel->shouldReceive('setAttribute')->with('id', 5)->once();
        $result = $this->service->saveTournamentTeam($mockModel);
        $this->assertTrue($result);
    }

    /**
     * @expectedException Craft\Exception
     */
    public function testSaveTournamentTeamNotFound()
    {
        $mockModel = m::mock('Craft\TournamentData_TournamentTeamModel');
        $mockModel->shouldReceive('getAttribute')->with('id')->once()->andReturn(5);
        $mockRecord = m::mock('Craft\TournamentData_TournamentTeamRecord');
        $this->tournamentTeamRecord->shouldReceive('findByPk')->with(5)->once()
            ->andReturn(null);
        $result = $this->service->saveTournamentTeam($mockModel);
    }

    public function testSaveTournamentTeamInvalid()
    {
        $mockModel = m::mock('Craft\TournamentData_TournamentTeamModel');
        $mockModel->shouldReceive('getAttribute')->with('id')->once()->andReturn(5);
        $mockRecord = m::mock('Craft\TournamentData_TournamentTeamRecord');
        $this->tournamentTeamRecord->shouldReceive('findByPk')->with(5)->once()
            ->andReturn($mockRecord);
        $attributes = array('name' => 'example');
        $mockModel->shouldReceive('getAttributes')->once()->andReturn($attributes);
        $mockRecord->shouldReceive('setAttributes')->with($attributes)->once();
        $mockRecord->shouldReceive('save')->once()->andReturn(false);
        $errors = array('name' => 'error message');
        $mockRecord->shouldReceive('getErrors')->once()->andReturn($errors);
        $mockModel->shouldReceive('addErrors')->with($errors)->once();
        $result = $this->service->saveTournamentTeam($mockModel);
        $this->assertFalse($result);
    }

    public function testSaveTournamentTeamNewRecord()
    {
        $mockModel = m::mock('Craft\TournamentData_TournamentTeamModel');
        $mockModel->shouldReceive('getAttribute')->with('id')->once()->andReturn(null);
        $mockRecord = m::mock('Craft\TournamentData_TournamentTeamRecord');
        $this->tournamentTeamRecord->shouldReceive('create')->once()
            ->andReturn($mockRecord);
        $attributes = array('name' => 'example');
        $mockModel->shouldReceive('getAttributes')->once()->andReturn($attributes);
        $mockRecord->shouldReceive('setAttributes')->with($attributes)->once();
        $mockRecord->shouldReceive('save')->once()->andReturn(true);
        $mockRecord->shouldReceive('getAttribute')->with('id')->once()
            ->andReturn(5);
        $mockModel->shouldReceive('setAttribute')->with('id', 5)->once();
        $result = $this->service->saveTournamentTeam($mockModel);
        $this->assertTrue($result);
    }
    
	public function testDeleteTournamentTeamById()
    {
		$mockModel = m::mock('Craft\TournamentData_TournamentTeamModel');
        $mockModel->shouldReceive('getAttribute')->with('id')->once()->andReturn(5);
        $mockRecord = m::mock('Craft\TournamentData_TournamentTeamRecord');
        $this->tournamentTeamRecord->shouldReceive('findByPk')->with(5)->once()
            ->andReturn($mockRecord);
        
        $mockRecord->shouldReceive('setAttribute')->with('isActive', false)->once();
        $mockRecord->shouldReceive('save')->once()->andReturn(true);
        $mockRecord->shouldReceive('getAttribute')->with('id')->once()
            ->andReturn(5);
        $mockModel->shouldReceive('setAttribute')->with('id', 5)->once();

        $result = $this->service->deleteTournamentTeamById(5);
        $this->assertTrue($result);
    }

	public function testUndoDeleteTournamentTeamById()
	{
		$mockModel = m::mock('Craft\TournamentData_TournamentTeamModel');
        $mockModel->shouldReceive('getAttribute')->with('id')->once()->andReturn(5);
        $mockRecord = m::mock('Craft\TournamentData_TournamentTeamRecord');
        $this->tournamentTeamRecord->shouldReceive('findByPk')->with(5)->once()
            ->andReturn($mockRecord);
        
        $mockRecord->shouldReceive('setAttribute')->with('isActive', true)->once();
        $mockRecord->shouldReceive('save')->once()->andReturn(true);
        $mockRecord->shouldReceive('getAttribute')->with('id')->once()
            ->andReturn(5);
        $mockModel->shouldReceive('setAttribute')->with('id', 5)->once();

        $result = $this->service->undoDeleteTournamentTeamById(5);
        $this->assertTrue($result);
	}
}