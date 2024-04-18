<!-- View for editing roles -->
<div class="container">
        <h1>Edit User</h1>
        <form method="POST" action="{{ route('admin.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group row">
    <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>

    <div class="col-md-6">
        <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
        </select>
    </div>
</div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form></div>

