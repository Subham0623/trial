<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //
    public $table = 'user_details';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'user_id',
        'can_read_book',
        'contact',
        'age',
        'gender',
        'province',
        'district',
        'muncipality',
        'ward',
        'street_name',
        'teaching_level',
        'subject',
        'institute',
        'institute_contact',
        'institute_province',
        'institute_district',
        'institute_muncipality',
        'institute_ward',
        'institute_street_name',
        'institute_principal',
        'card',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
