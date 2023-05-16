<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Task;
use Tests\TestCase;
use Carbon\Carbon;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_list_all_tasks() {
        $this->withoutExceptionHandling(); // Optional: Disable exception handling for better error messages
        Task::factory()->count(1)->create();

        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200)->assertJsonCount(1);
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
                'dueDate' => $task->dueDate,
                'status' => $task->status
                 ]
            ]);
    }
    public function test_can_create_a_task() {
        $data = [
            'title' => 'Test Task',
             'description' => 'This is a test task',
             'status' => 'pending',
             'dueDate' => '23-09-65'
        ];
        $response = $this->postJson('/api/tasks', $data);
         $response->assertStatus(201)
         ->assertJson([
            'data' => [
                'id' => $response['data']['id'],
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'dueDate' => $data['dueDate'],
                'created_at' => $response['data']['created_at'],
                'updated_at' => $response['data']['updated_at'],
            ]
        ]);
    }
    public function test_can_update_a_task() {
        $task = Task::factory()->create();
        $data = [
             'title' => 'Updated Task Title',
              'description' => 'This task has been updated',
              'status' => "completed",
              'dueDate' => '23-09-2024'
        ];
        $response = $this->putJson('/api/tasks/' . $task->id, $data);
         $response->assertStatus(200)
         ->assertJson([
            'data' => [
                'id' => $task->id,
                 'title' => $data['title'],
                 'description' => $data['description'],
                'status' => $data['status'],
                'dueDate' => $data['dueDate'],
                'created_at' => $response['data']['created_at'],
                'updated_at' => $response['data']['updated_at'],

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
