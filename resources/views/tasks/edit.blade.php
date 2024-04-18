<!-- View for editing task -->
<div class="container">
        <h1>Edit Task</h1>
        <form method="POST" action="{{ route('task.update', $task->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="naziv_rada">Naziv rada (hrvatski)</label>
                <input type="text" class="form-control" id="naziv_rada" name="naziv_rada" required value="{{$task->naziv_rada}}">
            </div>

            <div class="form-group">
                <label for="naziv_rada_eng">Naziv rada (engleski)</label>
                <input type="text" class="form-control" id="naziv_rada_eng" name="naziv_rada_eng" required value="{{$task->naziv_rada_eng}}">
            </div>

            <div class="form-group">
                <label for="zadatak_rada">Zadatak rada</label>
                <textarea class="form-control" id="zadatak_rada" name="zadatak_rada" rows="4" required>{{$task->zadatak_rada}}</textarea>
            </div>

            <div class="form-group">
                <label for="tip_studija">Tip studija</label>
                <select class="form-control" id="tip_studija" name="tip_studija" required>
                    <option value="stručni">Stručni</option>
                    <option value="preddiplomski">Preddiplomski</option>
                    <option value="diplomski">Diplomski</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
