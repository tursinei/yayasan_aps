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
 * App\Models\Pemasukan
 *
 * @property integer       $pemasukan_id
 * @property Carbon        $tgl
 * @property integer       $is_donasi
 * @property string        $kategori_lain
 * @property string        $nama_donatur
 * @property null|string   $keterangan
 * @property float         $nominal
 * @property null|integer  $kurator_id
 *
 * @property-read MKurator $mKurator
 *
 * @method static Builder|Pemasukan wherePemasukanId($value)
 * @method static Builder|Pemasukan whereTgl($value)
 * @method static Builder|Pemasukan whereIsDonasi($value)
 * @method static Builder|Pemasukan whereKategoriLain($value)
 * @method static Builder|Pemasukan whereNamaDonatur($value)
 * @method static Builder|Pemasukan whereKeterangan($value)
 * @method static Builder|Pemasukan whereNominal($value)
 * @method static Builder|Pemasukan whereKuratorId($value)
 *
 * @method static Builder|Pemasukan query()
 *
 * @method static Collection|Pemasukan[]     all($columns = ['*'])
 * @method static Pemasukan|null             find($id, $columns = ['*'])
 * @method static Collection|Pemasukan[]     findMany($ids, $columns = ['*'])
 * @method static Pemasukan                  findOrNew($id, $columns = ['*'])
 * @method static Pemasukan                  findOrFail($id, $columns = ['*'])
 * @method static Pemasukan|null             first($columns = ['*'])
 * @method static Pemasukan                  firstOrFail($columns = ['*'])
 * @method static Pemasukan                  firstOrNew($attributes, $values = array())
 * @method static Pemasukan                  firstOrCreate($attributes, $values = ['*'])
 * @method static Pemasukan                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Pemasukan[]     get($columns = ['*'])
 */
class Pemasukan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pemasukan';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'pemasukan_id';

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
        'pemasukan_id',
        'tgl',
        'is_donasi',
        'kategori_lain',
        'nama_donatur',
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
        'tgl'           => 'date:d-m-Y',
        'pemasukan_id'  => 'integer',
        'is_donasi'     => 'boolean',
        'kategori_lain' => 'string',
        'nama_donatur'  => 'string',
        'keterangan'    => 'string',
        'nominal'       => 'string',
        'kurator'    => 'string',
    ];

    //region ### User defined function #
    //endregion
}
