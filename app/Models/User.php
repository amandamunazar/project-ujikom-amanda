<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
protected $primaryKey = 'user_id';
public $incrementing = false;
protected $keyType = 'string';
    protected $table = 'tm_user';

    protected $fillable = [
        'user_nama',
        'user_pass',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'user_pass',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'user_id' => 'string',
            'user_pass' => 'hashed',
        ];
    }

    public function barangInventaris(){
        return $this->hasMany(BarangInventaris::class,'user_id');
    }
}
