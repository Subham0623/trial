<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Authorization\User\User;


class Feedback extends Model
{
    public $table = 'feedbacks';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'feedback',
        'user_id',
        'status',
        'form_detail_id',
        'created_at',
        'updated_at',
    ];

    public function formDetail()
    {
        return $this->belongsTo(FormDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
