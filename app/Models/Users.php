<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

//region ### Additional namespace #
//endregion

/**
 * App\Models\Users
 *
 * @property integer                       $id
 * @property string                        $name
 * @property string                        $email
 * @property null|Carbon                   $email_verified_at
 * @property string                        $password
 * @property integer                       $peran
 * @property null|string                   $remember_token
 * @property null|Carbon                   $created_at
 * @property null|Carbon                   $updated_at
 *
 * @property-read Collection|CalonYatama[] $calonYatamaUsers
 * @property-read Collection|Cashflow[]    $cashflowUsers
 *
 * @method static Builder|Users whereId($value)
 * @method static Builder|Users whereName($value)
 * @method static Builder|Users whereEmail($value)
 * @method static Builder|Users whereEmailVerifiedAt($value)
 * @method static Builder|Users wherePassword($value)
 * @method static Builder|Users wherePeran($value)
 * @method static Builder|Users whereRememberToken($value)
 * @method static Builder|Users whereCreatedAt($value)
 * @method static Builder|Users whereUpdatedAt($value)
 *
 * @method static Builder|Users query()
 *
 * @method static Collection|Users[]     all($columns = ['*'])
 * @method static Users|null             find($id, $columns = ['*'])
 * @method static Collection|Users[]     findMany($ids, $columns = ['*'])
 * @method static Users                  findOrNew($id, $columns = ['*'])
 * @method static Users                  findOrFail($id, $columns = ['*'])
 * @method static Users|null             first($columns = ['*'])
 * @method static Users                  firstOrFail($columns = ['*'])
 * @method static Users                  firstOrNew($attributes, $values = array())
 * @method static Users                  firstOrCreate($attributes, $values = ['*'])
 * @method static Users                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Users[]     get($columns = ['*'])
 */
class Users extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password','remember_token'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'peran',
        'remember_token',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'name'           => 'string',
        'email'          => 'string',
        'password'       => 'string',
        'remember_token' => 'string',
        'email_verified_at' => 'datetime',
        'created_at'     => 'date:d-m-Y'
    ];


    public static function getPeran($key = ''){
        $dataPeran = [
            'admin','pengurus','kordes','sekretaris', 'bendahara','humas','kesehatan'
        ];
        if($key == ''){
            return $dataPeran;
        }
        if(!isset($dataPeran[$key])){
            throw new Exception('Peran tidak ditemukan');
        }
        return $dataPeran[$key];
    }

    /**
     * @return HasMany|Builder|CalonYatama
     */
    public function calonYatamaUsers()
    {
        return $this->hasMany('App\Models\CalonYatama', 'user_id', 'id');
    }

    /**
     * @return HasMany|Builder|Cashflow
     */
    public function cashflowUsers()
    {
        return $this->hasMany('App\Models\Cashflow', 'user_id', 'id');
    }

    //region ### User defined function #
    //endregion
}
