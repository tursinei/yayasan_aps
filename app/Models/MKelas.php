<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
class MKelas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_kelas';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'kelas_id';

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
        'kelas_id',
        'kelas_nama',
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
        'kelas_id' => 'integer',
        'kelas_nama'       => 'string',
    ];


    //region ### User defined function #
    //endregion
}
