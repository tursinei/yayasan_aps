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
 * App\Models\Rab
 *
 * @property integer       $rab_id
 * @property null|string   $uraian
 * @property float         $nominal
 * @property integer       $tahun
 * @property integer       $program_id
 * @property null|Carbon   $created_at
 * @property null|Carbon   $updated_at
 *
 * @property-read MProgram $mProgram
 *
 * @method static Builder|Rab whereRabId($value)
 * @method static Builder|Rab whereUraian($value)
 * @method static Builder|Rab whereNominal($value)
 * @method static Builder|Rab whereTahun($value)
 * @method static Builder|Rab whereProgramId($value)
 * @method static Builder|Rab whereCreatedAt($value)
 * @method static Builder|Rab whereUpdatedAt($value)
 *
 * @method static Builder|Rab query()
 *
 * @method static Collection|Rab[]     all($columns = ['*'])
 * @method static Rab|null             find($id, $columns = ['*'])
 * @method static Collection|Rab[]     findMany($ids, $columns = ['*'])
 * @method static Rab                  findOrNew($id, $columns = ['*'])
 * @method static Rab                  findOrFail($id, $columns = ['*'])
 * @method static Rab|null             first($columns = ['*'])
 * @method static Rab                  firstOrFail($columns = ['*'])
 * @method static Rab                  firstOrNew($attributes, $values = array())
 * @method static Rab                  firstOrCreate($attributes, $values = ['*'])
 * @method static Rab                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Rab[]     get($columns = ['*'])
 */
class Rab extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rab';

    /** 
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rab_id';

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
        'rab_id',
        'uraian',
        'nominal',
        'tahun',
        'program_id',
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
        'rab_id'     => 'integer',
        'uraian'     => 'string',
        'nominal'    => 'float',
        'tahun'      => 'integer',
        'program_id' => 'integer',
    ];

    /**
     * @return BelongsTo|Builder|MProgram
     */
    public function mProgram()
    {
        return $this->belongsTo('App\Models\MProgram', 'program_id', 'program_id');
    }

    //region ### User defined function #
    //endregion
}
