<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{

    /**
     * 状態が定義された値ではない場合はバリデーションエラー
     * @test
     */
    public function status_should_be_within_defined_numbers()
    {
        $this->seed('TasksTableSeeder');
        $response = $this->post('/folders/1/tasks/1/edit', [
          'title'     =>  'Sample task',
          'due_date'  => Carbon::today()->format('Y/m/d'),
          'status'    =>  999,
        ]);
        $response->assertSessionHasErrors([
          'status'  =>  '状態 には 未着手、着手中、完了 のいずれかを指定してください。',
        ]);
    }

}
