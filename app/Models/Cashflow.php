<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//region ### Additional namespace #
//endregion

/**
 * App\Models\Cashflow
 *
 * @property integer      $id
 * @property float        $nominal
 * @property integer      $cashable_id
 * @property string       $cashable_type
 * @property null|integer $user_id
 * @property null|Carbon  $created_at
 * @property null|Carbon  $updated_at
 *
 * @property-read Users   $usersUser
 *
 * @method static Builder|Cashflow whereId($value)
 * @method static Builder|Cashflow whereNominal($value)
 * @method static Builder|Cashflow whereCashableId($value)
 * @method static Builder|Cashflow whereCashableType($value)
 * @method static Builder|Cashflow whereUserId($value)
 * @method static Builder|Cashflow whereCreatedAt($value)
 * @method static Builder|Cashflow whereUpdatedAt($value)
 *
 * @method static Builder|Cashflow query()
 *
 * @method static Collection|Cashflow[]     all($columns = ['*'])
 * @method static Cashflow|null             find($id, $columns = ['*'])
 * @method static Collection|Cashflow[]     findMany($ids, $columns = ['*'])
 * @method static Cashflow                  findOrNew($id, $columns = ['*'])
 * @method static Cashflow                  findOrFail($id, $columns = ['*'])
 * @method static Cashflow|null             first($columns = ['*'])
 * @method static Cashflow                  firstOrFail($columns = ['*'])
 * @method static Cashflow                  firstOrNew($attributes, $values = array())
 * @method static Cashflow                  firstOrCreate($attributes, $values = ['*'])
 * @method static Cashflow                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Cashflow[]     get($columns = ['*'])
 */
class Cashflow extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cashflow';

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
    protected $hidden = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nominal',
        'cashable_id',
        'cashable_type',
        'user_id',
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
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'nominal'       => 'float',
        'cashable_id'   => 'integer',
        'cashable_type' => 'string',
        'user_id'       => 'integer',
    ];

    /**
     * @return BelongsTo|Builder|Users
     */
    public function usersUser()
    {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    //region ### User defined function #
    //endregion
}
