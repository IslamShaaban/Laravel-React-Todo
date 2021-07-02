<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Todo;
use Tests\Unit\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    //Test List All Todos
    public function test_can_list_todos() {
        $todos = factory(Todo::class, 2)->create()->map(function ($todo) {
            return $todo;
        });
        $this->get(route('todos'))
             ->assertStatus(200)
             ->assertJson(['todoList' => $todos->toArray()]);
    }

    //Test List All Todos when List is Empty
    public function test_can_list_todos_not_found() {
        $todos = factory(Todo::class, 2)->create();
        Todo::truncate();
        $this->get(route('todos'))
             ->assertStatus(200)
             ->assertJson(['message'  => 'List is Empty',
                          ]);
    }

    //Test Create New Todo
    public function test_can_create_todo() {
        $data = [
            'title' => $this->faker->sentence,
        ];
        $this->post(route('todos.store'), $data)
             ->assertStatus(201);
    }

    //Test Update Specified Todo
    public function test_can_update_todo() {
        $todo = factory(Todo::class)->create();
        $data = [
            'title' => $this->faker->sentence,
        ];
        $this->post(route('todos.update', $todo->id), $data)
             ->assertStatus(200)
             ->assertJson(['message' => 'Todo Updated Successfully']);
    }

    //Test Update Specified Todo Not Found
    public function test_can_update_todo_not_found() {
        $todo = factory(Todo::class)->create();
        $data = [
            'title' => $this->faker->sentence,
        ];
        Todo::truncate();
        $this->post(route('todos.update', $todo->id), $data)
             ->assertStatus(404)
             ->assertJson(['message' => 'Todo Not Found']);
    }

    //Test Delete Specified Todo
    public function test_can_delete_todo() {
        $todo = factory(Todo::class)->create();
        $this->post(route('todos.destroy', $todo->id))
             ->assertStatus(200)
             ->assertJson(['message' => 'Todo has been deleted']);
    }

    //Test Delete Specified Todo Not Found
    public function test_can_delete_todo_not_found() {
        $todo = factory(Todo::class)->create();
        Todo::truncate();
        $this->post(route('todos.destroy', $todo->id))
             ->assertStatus(404)
             ->assertJson(['message' => 'Todo Not Found']);
    }
}