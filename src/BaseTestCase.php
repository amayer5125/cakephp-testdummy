<?php

namespace TestDummy;


use Cake\TestSuite\IntegrationTestCase;

abstract class BaseTestCase extends IntegrationTestCase
{
    protected $factory;

    public $factoriesPath = CONFIG . 'Factories';

    /**
     * The callbacks that should be run before the application is destroyed.
     *
     * @var array
     */
    protected $beforeApplicationDestroyedCallbacks = [];

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        //Load factories
        $this->factory = Definition::getInstance();
        $this->factory->load($this->factoriesPath);

        if (array_key_exists('TestDummy\Traits\DatabaseMigrations', class_uses(static::class))) {
            $this->runDatabaseMigrations();
        }
    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub

        foreach ($this->beforeApplicationDestroyedCallbacks as $callback) {
            call_user_func($callback);
        }
    }

    /**
     * Register a callback to be run before the application is destroyed.
     *
     * @param  callable $callback
     *
     * @return void
     */
    public function beforeApplicationDestroyed(callable $callback)
    {
        $this->beforeApplicationDestroyedCallbacks[] = $callback;
    }

}