<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Task;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_list_all_tasks() {
         Task::factory()->count(3)->create();
         $response = $this->getJson('/api/tasks');
         $response->assertStatus(200) ->assertJsonCount(3);
        }
    public function test_can_show_a_task() {
         $task = Task::factory()->create();
          $response = $this->getJson('/api/tasks/' . $task->id);
          $response->assertStatus(200)
          ->assertJson([
            'data' => [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'completed' => $task->completed
                 ]
            ]);
    }
    public function test_can_create_a_task() {
        $data = [
            'title' => 'Test Task',
             'description' => 'This is a test task',
             'completed' => false
        ];
        $response = $this->postJson('/api/tasks', $data);
         $response->assertStatus(201)
         ->assertJson([
            'data' => [
                'title' => $data['title'],
                'description' => $data['description'],
                'completed' => $data['completed']
            ]
        ]);
    }
    public function test_can_update_a_task() {
        $task = Task::factory()->create();
        $data = [
             'title' => 'Updated Task Title',
              'description' => 'This task has been updated',
              'completed' => true
        ];
        $response = $this->putJson('/api/tasks/' . $task->id, $data);
         $response->assertStatus(200)
         ->assertJson([
            'data' => [
                'id' => $task->id,
                 'title' => $data['title'],
                 'description' => $data['description'],
                'completed' => $data['completed']
            ]
        ]);
    }
    public function test_can_delete_a_task() {
        $task = Task::factory()->create();
        $response = $this->deleteJson('/api/tasks/' . $task->id);
         $response->assertStatus(204);
         $this->assertDatabaseMissing('tasks',
          ['id' => $task->id]);
    }

}
