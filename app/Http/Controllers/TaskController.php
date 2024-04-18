<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create()
    {
        return view('tasks.create');
    }

    // Store in DB
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'naziv_rada' => 'required',
            'naziv_rada_eng' => 'required',
            'zadatak_rada' => 'required',
            'tip_studija' => 'required',
        ]);

        $task = new Task();
        $task->naziv_rada = $validatedData['naziv_rada'];
        $task->naziv_rada_eng = $validatedData['naziv_rada_eng'];
        $task->zadatak_rada = $validatedData['zadatak_rada'];
        $task->tip_studija = $validatedData['tip_studija'];
        $task->nastavnik_id = auth()->user()->id;
        $task->save();

        return redirect()->route('dashboard');
    }

    // Show all available tasks
    public function index()
{
    $availableTasks = Task::availableTasks();
    return view('tasks.index', compact('availableTasks'));
}

// Delete task
public function destroy($id)
{
    $task = Task::find($id);
    $task->delete();
    return redirect()->route('dashboard');
}

// Update values in DB
public function update(Request $request, $id)
{
    $task = Task::findOrFail($id);

    $task->naziv_rada = $request->input('naziv_rada');
    $task->naziv_rada_eng = $request->input('naziv_rada_eng');
    $task->zadatak_rada = $request->input('zadatak_rada');
    $task->tip_studija = $request->input('tip_studija');

    $task->save();

    return redirect()->route('dashboard');
}

// Edit task
public function edit($id)
{
    $task = Task::findOrFail($id);
    return view('tasks.edit', compact('task'));
}

// Save student application to DB
public function apply($id)
{
    $student = auth()->user();

    DB::table('rad_student')->insert([
        'rad_id' => $id,
        'student_id' => $student->id
    ]);

    return redirect()->route('dashboard');
}

// Change tasks availability when accepting and delete all other applications from DB except for the accepted one
public function acceptStudent(Request $request)
{    
    DB::table('rad_student')
        ->where('rad_id', $taskId)
        ->where('student_id', '!=', $studentId)
        ->delete();

    DB::table('tasks')
        ->where('id', $taskId)
        ->update(['dostupan' => 0]);

    return redirect()->route('dashboardu');
}
}
