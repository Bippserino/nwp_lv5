<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv_rada',
        'naziv_rada_eng',
        'zadatak_rada',
        'tip_studija',
        'nastavnik_id',
    ];

    // Get the id of the teacher that published task
    public function teacher()
    {
        return $this->belongsTo(User::class, 'nastavnik_id');
    }

    public static function availableTasks()
    {
        return self::where('dostupan', true)->get();
    }

    // Get the list of all users that applied for specific task
    public function appliedUsers($taskId)
{
    $appliedUsers = DB::table('rad_student')
        ->where('rad_id', $taskId)
        ->get();

    return $appliedUsers;
}
}
