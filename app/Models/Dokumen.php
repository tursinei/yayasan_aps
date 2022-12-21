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
 * App\Models\Dokumen
 *
 * @property integer       $anakasuh_id
 * @property string        $foto
 * @property null|Carbon   $foto_upload
 * @property null|string   $kk
 * @property null|Carbon   $kk_upload
 *
 * @property-read AnakAsuh $anakAsuh
 *
 * @method static Builder|Dokumen whereAnakasuhId($value)
 * @method static Builder|Dokumen whereFoto($value)
 * @method static Builder|Dokumen whereFotoUpload($value)
 * @method static Builder|Dokumen whereKk($value)
 * @method static Builder|Dokumen whereKkUpload($value)
 *
 * @method static Builder|Dokumen query()
 *
 * @method static Collection|Dokumen[]     all($columns = ['*'])
 * @method static Dokumen|null             find($id, $columns = ['*'])
 * @method static Collection|Dokumen[]     findMany($ids, $columns = ['*'])
 * @method static Dokumen                  findOrNew($id, $columns = ['*'])
 * @method static Dokumen                  findOrFail($id, $columns = ['*'])
 * @method static Dokumen|null             first($columns = ['*'])
 * @method static Dokumen                  firstOrFail($columns = ['*'])
 * @method static Dokumen                  firstOrNew($attributes, $values = array())
 * @method static Dokumen                  firstOrCreate($attributes, $values = ['*'])
 * @method static Dokumen                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Dokumen[]     get($columns = ['*'])
 */
class Dokumen extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dokumen';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'anakasuh_id';

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
        'anakasuh_id',
        'foto',
        'foto_upload',
        'kk',
        'kk_upload',
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
        'foto_upload',
        'kk_upload',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'anakasuh_id' => 'integer',
        'foto'        => 'string',
        'kk'          => 'string',
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
