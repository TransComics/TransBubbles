<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Default preparation for each test
     */
    public function setUp() {
        parent::setUp();
        Artisan::call('migrate');
        Session::start();
        Mail::pretend(true);
        Route::enableFilters();
    }
    
    public function tearDown() {
        parent::tearDown();
        Artisan::call('migrate:reset');
    }

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication() {
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__ . '/../../bootstrap/start.php';
    }
    
}