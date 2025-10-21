<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('Tasks.Index', compact('tasks'));
    }

    public function create()
    {
        $users = User::all();
        $categories = Categorie::all();
        return view('Tasks.Create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully');
    }

    public function show(Task $task)
    {
        $authUser = auth()->user();

        if (!$this->canAccess($authUser, $task->user)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        return view('Tasks.Show', compact('task'));
    }

    public function edit(Task $task)
    {
        $authUser = auth()->user();

        if (!$this->canAccess($authUser, $task->user)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        $categories = Categorie::all();
        $users = User::all();

        return view('Tasks.Edit', compact('task', 'categories', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $authUser = auth()->user();

        if (!$this->canAccess($authUser, $task->user)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        $task->update($request->all());

        return redirect()->route('tasks.show', $task->id)
            ->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $authUser = auth()->user();

        if (!$this->canAccess($authUser, $task->user)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully');
    }

    /**************************************************************/

    // Admin and User can see only their tasks
    public function myTasks($id)
    {
        $tasks = Task::where('user_id', $id)->paginate(10);
        return view('Tasks.myTasks', compact('tasks'));
    }

private function canAccess($authUser, $targetUser)
{
    $hierarchy = [
        'manager' => 3,
        'admin' => 2,
        'user' => 1,
    ];

    // فحالة ماكانش task مرتبط بمستخدم (rare)
    if (!$targetUser) {
        return false;
    }

    // 🔹 إلى نفس الشخص → مسموح
    if ($authUser->id === $targetUser->id) {
        return true;
    }

    // 🔹 إذا الدور ديال المتصل أصغر أو يساوي الهدف → ممنوع
    if ($hierarchy[$authUser->role] <= $hierarchy[$targetUser->role]) {
        return false;
    }

    // 🔹 غير هاد الحالة: الدور ديال المتصل أكبر → مسموح
    return true;
}

}
