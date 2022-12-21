<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

//region ### Additional namespace #
//endregion

/**
 * App\Models\MProgram
 *
 * @property integer                       $program_id
 * @property string                        $program
 * @property null|Carbon                   $created_at
 * @property null|Carbon                   $updated_at
 * @property Carbon                        $deleted_at
 *
 * @property-read Collection|Pengeluaran[] $pengeluarans
 * @property-read Collection|Rab[]         $rabs
 *
 * @method static Builder|MProgram whereProgramId($value)
 * @method static Builder|MProgram whereProgram($value)
 * @method static Builder|MProgram whereCreatedAt($value)
 * @method static Builder|MProgram whereUpdatedAt($value)
 * @method static Builder|MProgram whereDeletedAt($value)
 *
 * @method static Builder|MProgram query()
 *
 * @method static Collection|MProgram[]     all($columns = ['*'])
 * @method static MProgram|null             find($id, $columns = ['*'])
 * @method static Collection|MProgram[]     findMany($ids, $columns = ['*'])
 * @method static MProgram                  findOrNew($id, $columns = ['*'])
 * @method static MProgram                  findOrFail($id, $columns = ['*'])
 * @method static MProgram|null             first($columns = ['*'])
 * @method static MProgram                  firstOrFail($columns = ['*'])
 * @method static MProgram                  firstOrNew($attributes, $values = array())
 * @method static MProgram                  firstOrCreate($attributes, $values = ['*'])
 * @method static MProgram                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|MProgram[]     get($columns = ['*'])
 */
class MProgram extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_program';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'program_id';

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
        'program_id',
        'program',
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
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'program_id' => 'integer',
        'program'    => 'string',
    ];

    /**
     * @return HasMany|Builder|Pengeluaran
     */
    public function pengeluarans()
    {
        return $this->hasMany('App\Models\Pengeluaran', 'program_id', 'program_id');
    }

    /**
     * @return HasMany|Builder|Rab
     */
    public function rabs()
    {
        return $this->hasMany('App\Models\Rab', 'program_id', 'program_id');
    }

    //region ### User defined function #
    //endregion
}
