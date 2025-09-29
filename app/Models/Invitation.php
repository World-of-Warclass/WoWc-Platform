<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $table = 'invitations';

    protected $fillable = [
        'name',
        'code',
        'email',
        'used',
        'id_course',
    ];

    /**
     * Relación con el curso
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
}
