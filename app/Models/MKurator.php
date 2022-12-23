<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//region ### Additional namespace #
//endregion

/**
 * App\Models\MKurator
 *
 * @property integer                       $kurator_id
 * @property string                        $nama
 *
 * @property-read Collection|Pemasukan[]   $pemasukans
 * @property-read Collection|Pengeluaran[] $pengeluarans
 *
 * @method static Builder|MKurator whereKuratorId($value)
 * @method static Builder|MKurator whereNama($value)
 *
 * @method static Builder|MKurator query()
 *
 * @method static Collection|MKurator[]     all($columns = ['*'])
 * @method static MKurator|null             find($id, $columns = ['*'])
 * @method static Collection|MKurator[]     findMany($ids, $columns = ['*'])
 * @method static MKurator                  findOrNew($id, $columns = ['*'])
 * @method static MKurator                  findOrFail($id, $columns = ['*'])
 * @method static MKurator|null             first($columns = ['*'])
 * @method static MKurator                  firstOrFail($columns = ['*'])
 * @method static MKurator                  firstOrNew($attributes, $values = array())
 * @method static MKurator                  firstOrCreate($attributes, $values = ['*'])
 * @method static MKurator                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|MKurator[]     get($columns = ['*'])
 */
class MKurator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_kurator';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'kurator_id';

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
    public $timestamps = false;

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
        'kurator_id',
        'nama',
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
        'kurator_id' => 'integer',
        'nama'       => 'string',
    ];

    /**
     * @return HasMany|Builder|Pemasukan
     */
    public function pemasukans()
    {
        return $this->hasMany('App\Models\Pemasukan', 'kurator_id', 'kurator_id');
    }

    /**
     * @return HasMany|Builder|Pengeluaran
     */
    public function pengeluarans()
    {
        return $this->hasMany('App\Models\Pengeluaran', 'kurator_id', 'kurator_id');
    }

    //region ### User defined function #
    //endregion
}
