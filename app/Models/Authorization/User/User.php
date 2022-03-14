<?php

namespace App\Models\Authorization\User;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use \DateTimeInterface;
use App\Models\Authorization\Role;
use App\Form;
use App\Organization;
use App\Feedback;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable, HasApiTokens;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->whereNotIn('id', [2,3])->exists();

    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }

    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));

    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);

    }

    public function user_detail()
    {
        return $this->hasOne(UserDetail::class);

    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function updatedForms()
    {
        return $this->hasMany(Form::class);
    }

    public function verifiedForms()
    {
        return $this->hasMany(Form::class);
    }

    public function auditedForms()
    {
        return $this->hasMany(Form::class);
    }

    public function finalVerifiedForms()
    {
        return $this->hasMany(Form::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    
    public function getIsMainAdminAttribute()
    {
        return $this->roles()->whereIn('id', [1])->exists();

    }

    public function scopeOfUser($query)
    {
        $user = User::find(auth()->user()->id);
        
        if (!$user->isMainAdmin) {
            return $query->where('created_by', $user->id);
        }
        return $query;
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

}
