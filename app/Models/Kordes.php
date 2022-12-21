<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//region ### Additional namespace #
//endregion

/**
 * App\Models\Kordes
 *
 * @property integer       $kordes_id
 * @property string        $nama
 * @property null|integer  $tahun
 * @property integer       $anakasuh_id
 * @property null|Carbon   $created_at
 * @property null|Carbon   $updated_at
 *
 * @property-read AnakAsuh $anakAsuh
 *
 * @method static Builder|Kordes whereKordesId($value)
 * @method static Builder|Kordes whereNama($value)
 * @method static Builder|Kordes whereTahun($value)
 * @method static Builder|Kordes whereAnakasuhId($value)
 * @method static Builder|Kordes whereCreatedAt($value)
 * @method static Builder|Kordes whereUpdatedAt($value)
 *
 * @method static Builder|Kordes query()
 *
 * @method static Collection|Kordes[]     all($columns = ['*'])
 * @method static Kordes|null             find($id, $columns = ['*'])
 * @method static Collection|Kordes[]     findMany($ids, $columns = ['*'])
 * @method static Kordes                  findOrNew($id, $columns = ['*'])
 * @method static Kordes                  findOrFail($id, $columns = ['*'])
 * @method static Kordes|null             first($columns = ['*'])
 * @method static Kordes                  firstOrFail($columns = ['*'])
 * @method static Kordes                  firstOrNew($attributes, $values = array())
 * @method static Kordes                  firstOrCreate($attributes, $values = ['*'])
 * @method static Kordes                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Kordes[]     get($columns = ['*'])
 */
class Kordes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kordes';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'kordes_id';

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
        'kordes_id',
        'nama',
        'tahun',
        'anakasuh_id',
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
        'kordes_id'   => 'integer',
        'nama'        => 'string',
        'tahun'       => 'integer',
        'anakasuh_id' => 'integer',
    ];

    /**
     * @return BelongsTo|Builder|AnakAsuh
     */
    public function anakAsuh()
    {
        return $this->belongsTo('App\Models\AnakAsuh', 'anakasuh_id', 'anakasuh_id');
    }

    //region ### User defined function #
    //endregion
}
