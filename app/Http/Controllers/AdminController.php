<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Edit role
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    // Update role in DB
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->get('role');
        $user->save();
        return redirect()->route('admin.index');
    }

}
