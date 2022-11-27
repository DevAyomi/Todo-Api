<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_todo_list()
    {
        $this->withoutExceptionHandling();
       // Every test has 3 phases

       // Preparation/ Prepare


       //Action / Perform
        $response = $this->getJson(route('todo-list.index'));
       //Assertion / Predict
        $this->assertEquals(1,count($response->json()));
    }
}
