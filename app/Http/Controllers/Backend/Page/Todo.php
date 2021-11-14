<?php

namespace App\Http\Controllers\Backend\Page;

use Illuminate\Http\Request;
use App\Events\TodoMailEvent;
use App\Events\CreateTodoEvent;
use App\Models\Todo as TodoModel;
use App\Http\Controllers\Controller;

class Todo extends Controller
{
    public function index()
    {
        $todo = TodoModel::get();

        return view('backend.page.todo', [
            'todo' => $todo
        ]);
    }

    /**
     *  change status and send to channel
     *  and admin's email info about it
     */
    public function done(Request $request)
    {
        $todo = TodoModel::find($request->num);

        $data = new \stdClass();
        $data->todo = $todo->text;
        $data->username = auth()->user()->username;

        $todo->status = 'done';
        $todo->save();

        broadcast(new CreateTodoEvent(
            '',
            $request->num,
            'done'
        ))->toOthers();

        event(new TodoMailEvent($data));

        return response(['success' => true]);
    }


    public function createTodo(Request $request)
    {
        $todo = new TodoModel();
        $todo->id = $request->num;
        $todo->user_id = auth()->user()->id;
        $todo->text = $request->text;
        $todo->save();

        broadcast(new CreateTodoEvent(
            $request->text,
            $request->num,
            'create'
        ))->toOthers();

        return response(['success' => true]);
    }

    public function removeTodo(Request $request)
    {
        $todo = TodoModel::find($request->num);
        $todo->delete();

        broadcast(new CreateTodoEvent(
            '',
            $request->num,
            'removeTodo'
        ))->toOthers();


        return response(['success' => true]);
    }
}
