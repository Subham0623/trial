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
        'form_option_id',
        'created_at',
        'updated_at',
    ];

    public function formOption()
    {
        return $this->belongsTo(FormDetail::class,'form_option_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
