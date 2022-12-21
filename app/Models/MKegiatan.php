<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

//region ### Additional namespace #
//endregion

/**
 * App\Models\MKegiatan
 *
 * @property integer                       $kegiatan_id
 * @property string                        $kegiatan
 * @property null|Carbon                   $created_at
 * @property null|Carbon                   $updated_at
 * @property Carbon                        $deleted_at
 *
 * @property-read Collection|Pengeluaran[] $pengeluarans
 *
 * @method static Builder|MKegiatan whereKegiatanId($value)
 * @method static Builder|MKegiatan whereKegiatan($value)
 * @method static Builder|MKegiatan whereCreatedAt($value)
 * @method static Builder|MKegiatan whereUpdatedAt($value)
 * @method static Builder|MKegiatan whereDeletedAt($value)
 *
 * @method static Builder|MKegiatan query()
 *
 * @method static Collection|MKegiatan[]     all($columns = ['*'])
 * @method static MKegiatan|null             find($id, $columns = ['*'])
 * @method static Collection|MKegiatan[]     findMany($ids, $columns = ['*'])
 * @method static MKegiatan                  findOrNew($id, $columns = ['*'])
 * @method static MKegiatan                  findOrFail($id, $columns = ['*'])
 * @method static MKegiatan|null             first($columns = ['*'])
 * @method static MKegiatan                  firstOrFail($columns = ['*'])
 * @method static MKegiatan                  firstOrNew($attributes, $values = array())
 * @method static MKegiatan                  firstOrCreate($attributes, $values = ['*'])
 * @method static MKegiatan                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|MKegiatan[]     get($columns = ['*'])
 */
class MKegiatan extends Eloquent
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_kegiatan';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'kegiatan_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
        'kegiatan_id',
        'kegiatan',
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
        'kegiatan_id' => 'integer',
        'kegiatan'    => 'string',
    ];

    /**
     * @return HasMany|Builder|Pengeluaran
     */
    public function pengeluarans()
    {
        return $this->hasMany('App\Models\Pengeluaran', 'kegiatan_id', 'kegiatan_id');
    }

    //region ### User defined function #
    //endregion
}
