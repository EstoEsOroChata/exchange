<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'es_admin',
        'oro',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function usersProductos(){
        return $this->belongsToMany('App\Models\UsersProductos');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'users_productos', 'user_id', 'producto_id')
            ->withPivot('cantidad');
    }

    //Relación uno a muchos
    public function subastas(){
        return $this->hasMany('App\Models\Subasta');
    }

// Para guardar registros en minúscula y devolverlos con la primera letra en mayúscula
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set:  fn($value) => strtolower($value)  
        );
    }
    
}
