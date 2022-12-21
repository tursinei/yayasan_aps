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
 * App\Models\Pendidikan
 *
 * @property integer       $jenjang_id
 * @property null|string   $jenjang
 * @property null|string   $nama_sekolah
 * @property null|string   $kelas
 * @property null|string   $wali_kelas
 * @property integer       $anakasuh_id
 * @property null|Carbon   $created_at
 * @property null|Carbon   $updated_at
 *
 * @property-read AnakAsuh $anakAsuh
 *
 * @method static Builder|Pendidikan whereJenjangId($value)
 * @method static Builder|Pendidikan whereJenjang($value)
 * @method static Builder|Pendidikan whereNamaSekolah($value)
 * @method static Builder|Pendidikan whereKelas($value)
 * @method static Builder|Pendidikan whereWaliKelas($value)
 * @method static Builder|Pendidikan whereAnakasuhId($value)
 * @method static Builder|Pendidikan whereCreatedAt($value)
 * @method static Builder|Pendidikan whereUpdatedAt($value)
 *
 * @method static Builder|Pendidikan query()
 *
 * @method static Collection|Pendidikan[]     all($columns = ['*'])
 * @method static Pendidikan|null             find($id, $columns = ['*'])
 * @method static Collection|Pendidikan[]     findMany($ids, $columns = ['*'])
 * @method static Pendidikan                  findOrNew($id, $columns = ['*'])
 * @method static Pendidikan                  findOrFail($id, $columns = ['*'])
 * @method static Pendidikan|null             first($columns = ['*'])
 * @method static Pendidikan                  firstOrFail($columns = ['*'])
 * @method static Pendidikan                  firstOrNew($attributes, $values = array())
 * @method static Pendidikan                  firstOrCreate($attributes, $values = ['*'])
 * @method static Pendidikan                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Pendidikan[]     get($columns = ['*'])
 */
class Pendidikan extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pendidikan';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'jenjang_id';

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
        'jenjang_id',
        'jenjang',
        'nama_sekolah',
        'kelas',
        'wali_kelas',
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
        'jenjang_id'   => 'integer',
        'jenjang'      => 'string',
        'nama_sekolah' => 'string',
        'kelas'        => 'string',
        'wali_kelas'   => 'string',
        'anakasuh_id'  => 'integer',
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
