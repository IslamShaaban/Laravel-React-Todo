<?php

namespace App\Http\Controllers;
use App\Models\Todo; 
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    //Display All Todos
    public function index()
    {
        $todos = Todo::all();
        if(count($todos) == 0) {
            return response()->json([
                'message'  => 'List is Empty',
                'todoList' => $todos
            ], 200);
        } else {
            return response()->json([
                'todoList' => $todos
            ], 200);
        }
    }

    //Store New Todo
    public function store(Request $request, Todo $todo)
    {
        $data = $request->all();
        $todo = Todo::Create($data);
        if(!$todo->save()){
            //Todo not Created and Return Error
            return response()->json([
                'error' => 'Failed to add task.'
            ], 400);
        }
        //Todo was created show OK message
        return response()->json(array('success' => true, 'task_created' => 1), 201);
    }

    //Update Specified Todo
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            if ($todo->done === 1) {
                $todo->done = 0;
            } else {
                $todo->done = 1;
            }
            $todo->save();
            return response()->json([
                'message' => 'Todo Updated Successfully'
            ], 200); 
        } else {
            return response()->json([
                'message' => 'Todo Not Found'
            ], 404);   
        }
    }

    //Destroy Specified Todo
    public function destroy($id)
    {
        $todo = Todo::find($id);
        if($todo) {
            $todo->destroy($id);
            return response()->json([
                'message' => 'Todo has been deleted'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Todo Not Found'
            ], 404);
        }
    }
}