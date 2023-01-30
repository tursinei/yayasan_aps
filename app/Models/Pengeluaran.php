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
 * App\Models\Pengeluaran
 *
 * @property integer        $pengeluaran_id
 * @property Carbon         $tgl
 * @property integer        $kegiatan_id
 * @property null|integer   $program_id
 * @property null|string    $keterangan
 * @property null|float     $nominal
 * @property null|integer   $kurator_id
 *
 * @property-read MKegiatan $mKegiatan
 * @property-read MKurator  $mKurator
 * @property-read MProgram  $mProgram
 *
 * @method static Builder|Pengeluaran wherePengeluaranId($value)
 * @method static Builder|Pengeluaran whereTgl($value)
 * @method static Builder|Pengeluaran whereKegiatanId($value)
 * @method static Builder|Pengeluaran whereProgramId($value)
 * @method static Builder|Pengeluaran whereKeterangan($value)
 * @method static Builder|Pengeluaran whereNominal($value)
 * @method static Builder|Pengeluaran whereKuratorId($value)
 *
 * @method static Builder|Pengeluaran query()
 *
 * @method static Collection|Pengeluaran[]     all($columns = ['*'])
 * @method static Pengeluaran|null             find($id, $columns = ['*'])
 * @method static Collection|Pengeluaran[]     findMany($ids, $columns = ['*'])
 * @method static Pengeluaran                  findOrNew($id, $columns = ['*'])
 * @method static Pengeluaran                  findOrFail($id, $columns = ['*'])
 * @method static Pengeluaran|null             first($columns = ['*'])
 * @method static Pengeluaran                  firstOrFail($columns = ['*'])
 * @method static Pengeluaran                  firstOrNew($attributes, $values = array())
 * @method static Pengeluaran                  firstOrCreate($attributes, $values = ['*'])
 * @method static Pengeluaran                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Pengeluaran[]     get($columns = ['*'])
 */
class Pengeluaran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengeluaran';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'pengeluaran_id';

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
        'tgl',
        'kegiatan_id',
        'program_id',
        'keterangan',
        'nominal',
        'kurator',
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
        'tgl',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tgl'            => 'date:d-m-Y',
        'pengeluaran_id' => 'integer',
        'kegiatan_id'    => 'integer',
        'program_id'     => 'integer',
        'keterangan'     => 'string',
        'nominal'        => 'string',
        'kurator'        => 'string',
    ];

    /**
     * @return BelongsTo|Builder|MKegiatan
     */
    public function mKegiatan()
    {
        return $this->belongsTo('App\Models\MKegiatan', 'kegiatan_id', 'kegiatan_id');
    }

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
