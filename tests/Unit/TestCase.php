<?php
namespace Tests\Unit;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;
abstract class TestCase extends BaseTestCase
{
    use createsApplication, DatabaseMigrations;
    protected $faker;
    public function setUp() : void {
        parent::setUp();
        $this->faker = Factory::create();
    }
}