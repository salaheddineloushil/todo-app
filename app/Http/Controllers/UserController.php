<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('Users.Index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();

        if (!$this->canAccess($authUser, $user)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        return view('Users.Show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();

        if (!$this->canAccess($authUser, $user)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        return view('Users.Edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();

        if (!$this->canAccess($authUser, $user)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        $user->update($request->all());
        return redirect()->route('users.index')
            ->with('success', 'User ' . $user->name . ' updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();

        if (!$this->canAccess($authUser, $user)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    /**
     * Vérifie si l'utilisateur connecté peut accéder à l'autre utilisateur
     */
    private function canAccess($authUser, $targetUser)
    {
        $hierarchy = [
            'manager' => 3,
            'admin' => 2,
            'user' => 1,
        ];

        // نفس role و ماشي نفس id → ممنوع
        if ($authUser->role === $targetUser->role && $authUser->id !== $targetUser->id) {
            return false;
        }

        // إذا الدور ديال المتصل أقل أو يساوي الدور ديال الهدف → ممنوع
        if ($hierarchy[$authUser->role] <= $hierarchy[$targetUser->role] && $authUser->id !== $targetUser->id) {
            return false;
        }

        return true;
    }
}
