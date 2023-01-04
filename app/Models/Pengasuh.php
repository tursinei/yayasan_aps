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
 * App\Models\Pengasuh
 *
 * @property integer       $pengasuh_id
 * @property string        $nama
 * @property null|string   $pekerjaan
 * @property null|string   $alamat
 * @property null|string   $no_hp
 * @property integer       $anakasuh_id
 * @property null|Carbon   $created_at
 * @property null|Carbon   $updated_at
 *
 * @property-read AnakAsuh $anakAsuh
 *
 * @method static Builder|Pengasuh wherePengasuhId($value)
 * @method static Builder|Pengasuh whereNama($value)
 * @method static Builder|Pengasuh wherePekerjaan($value)
 * @method static Builder|Pengasuh whereAlamat($value)
 * @method static Builder|Pengasuh whereNoHp($value)
 * @method static Builder|Pengasuh whereAnakasuhId($value)
 * @method static Builder|Pengasuh whereCreatedAt($value)
 * @method static Builder|Pengasuh whereUpdatedAt($value)
 *
 * @method static Builder|Pengasuh query()
 *
 * @method static Collection|Pengasuh[]     all($columns = ['*'])
 * @method static Pengasuh|null             find($id, $columns = ['*'])
 * @method static Collection|Pengasuh[]     findMany($ids, $columns = ['*'])
 * @method static Pengasuh                  findOrNew($id, $columns = ['*'])
 * @method static Pengasuh                  findOrFail($id, $columns = ['*'])
 * @method static Pengasuh|null             first($columns = ['*'])
 * @method static Pengasuh                  firstOrFail($columns = ['*'])
 * @method static Pengasuh                  firstOrNew($attributes, $values = array())
 * @method static Pengasuh                  firstOrCreate($attributes, $values = ['*'])
 * @method static Pengasuh                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Pengasuh[]     get($columns = ['*'])
 */
class Pengasuh extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengasuh';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'pengasuh_id';

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
        'pengasuh_id',
        'nama',
        'pekerjaan',
        'alamat',
        'no_hp',
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
        'pengasuh_id' => 'integer',
        'nama'        => 'string',
        'pekerjaan'   => 'string',
        'alamat'      => 'string',
        'no_hp'       => 'string',
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
