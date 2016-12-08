<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return void
     */
    public function testBasicExample()
    {
        try {
            $this->visit('/');
        } catch (\Exception $e) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }
}
