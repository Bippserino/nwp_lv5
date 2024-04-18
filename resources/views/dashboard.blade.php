<style>
    .edit-button {
        color: red;
        margin-top: 2rem;
    }

    td, th {
        padding: 1rem;
        text-align: center;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($role === 'student') 
                        <h1><b>Student</b></h1>
                        @if ($tasks->isEmpty())
                            <h1 style="margin-bottom: 2rem;">No available tasks</h1 style="margin-bottom: 2rem;">
                        @else
                        <!-- Shows all available tasks to a user with a role student -->
                            @foreach($tasks as $task)
                                @if ($task->dostupan === 1)
                                    <div style="border: 1px solid black;border-radius: 1rem;padding: 1rem 2rem;margin-bottom: 2rem;">
                                        <h2>{{ $task->naziv_rada }}</h2>
                                        <h2>{{ $task->naziv_rada_eng }}</h2>
                                        <p><b>Zadatak: </b>{{ $task->zadatak_rada}}</p>
                                        <h3><b>Tip studija: </b>{{ $task->tip_studija }}</h3>
                                        <h3><b>Nastavnik:</b> {{ $task->teacher->name }}</h3>
                                        <!-- Hide apply button if the user already applied for it -->
                                            @if (DB::table('rad_student')
                                                ->where('rad_id', $task->id)
                                                ->where('student_id', auth()->user()->id)
                                                ->exists() === true)
                                            <p style="color: green;">Prijavljen</p>
                                            @else
                                                <form action="{{ route('task.apply', $task->id) }}" method="POST" style="margin-bottom: 0;">
                                                    @csrf
                                                    <button class="apply" type="submit" style="color: red;">Apply</button>  
                                                </form>
                                            @endif
                                    </div>   
                                @endif
                                
                            @endforeach
                        @endif                        

                    @elseif ($role === 'teacher')
                        <h1><b>Teacher</b></h1>
                        @if ($tasks === null)
                            <h1 style="margin-bottom: 2rem;">No tasks associated with this user</h1 style="margin-bottom: 2rem;">
                        @else
                            <div class="container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('lang.naziv_rada') }}</th>
                                            <th>{{ __('lang.naziv_rada_eng') }}</th>
                                            <th>{{ __('lang.zadatak_rada') }}</th>
                                            <th>{{ __('lang.tip_studija') }}</th>
                                            <th>{{ __('lang.prijavljeni_studenti') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{$task->naziv_rada }}</td>
                                            <td>{{$task->naziv_rada_eng }}</td>
                                            <td>{{$task->zadatak_rada }}</td>
                                            <td>{{$task->tip_studija }}</td>
                                            <td>
                                                <!-- Show all students who applied for the specific task -->
                                            <select name="student_id">
                                                        @foreach ($task->appliedUsers($task->id) as $user)
                                                            <option value="{{ $user->student_id }}"> {{ \App\Models\User::find($user->student_id )->name }}</option>                            
                                                        @endforeach 
                                                    </select>
                                            </td>
                                        
                                            <td><a class="edit" href="./dashboard/edit/{{ $task->id}}" style="color: blue;">{{ __('lang.uredi') }}</a></td>
                                            <td><form action="{{ route('task.destroy', $task->id) }}" method="POST" style="margin-bottom: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="delete" type="submit" style="color: red;">{{ __('lang.brisi') }}</button>  
                                                </form></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>  
                        @endif
                        <a class="add-button" style="background-color: whitesmoke;padding: 1rem; border-radius: 1rem;margin-top: 2rem;" href="./dashboard/tasks/create">{{ __('lang.dodaj') }}</a>
                    @else 
                        <h1><b>Admin</b></p>
                        <div class="container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Show all users and their info -->
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <a class="edit-button" href="{{ route('admin.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
