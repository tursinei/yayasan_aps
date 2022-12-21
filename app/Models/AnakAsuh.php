<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

//region ### Additional namespace #
//endregion

/**
 * App\Models\AnakAsuh
 *
 * @property integer                      $anakasuh_id
 * @property string                       $nama
 * @property null|string                  $tempat_lahir
 * @property null|Carbon                  $tgl_lahir
 * @property null|string                  $gender
 * @property null|integer                 $anak_ke
 * @property null|integer                 $is_yatim
 * @property null|integer                 $is_sebelum_yatim
 * @property null|integer                 $yatim_umur
 * @property null|Carbon                  $tgl_masuk
 * @property integer                      $is_alumni
 * @property null|Carbon                  $tgl_lulus
 * @property null|Carbon                  $created_at
 * @property null|Carbon                  $updated_at
 *
 * @property-read Collection|Kordes[]     $kordeses
 * @property-read Collection|Parents[]    $parentses
 * @property-read Collection|Pendidikan[] $pendidikans
 * @property-read Collection|Pengasuh[]   $pengasuhs
 * @property-read Dokumen                 $dokumen
 *
 * @method static Builder|AnakAsuh whereAnakasuhId($value)
 * @method static Builder|AnakAsuh whereNama($value)
 * @method static Builder|AnakAsuh whereTempatLahir($value)
 * @method static Builder|AnakAsuh whereTglLahir($value)
 * @method static Builder|AnakAsuh whereGender($value)
 * @method static Builder|AnakAsuh whereAnakKe($value)
 * @method static Builder|AnakAsuh whereIsYatim($value)
 * @method static Builder|AnakAsuh whereIsSebelumYatim($value)
 * @method static Builder|AnakAsuh whereYatimUmur($value)
 * @method static Builder|AnakAsuh whereTglMasuk($value)
 * @method static Builder|AnakAsuh whereIsAlumni($value)
 * @method static Builder|AnakAsuh whereTglLulus($value)
 * @method static Builder|AnakAsuh whereCreatedAt($value)
 * @method static Builder|AnakAsuh whereUpdatedAt($value)
 *
 * @method static Builder|AnakAsuh query()
 *
 * @method static Collection|AnakAsuh[]     all($columns = ['*'])
 * @method static AnakAsuh|null             find($id, $columns = ['*'])
 * @method static Collection|AnakAsuh[]     findMany($ids, $columns = ['*'])
 * @method static AnakAsuh                  findOrNew($id, $columns = ['*'])
 * @method static AnakAsuh                  findOrFail($id, $columns = ['*'])
 * @method static AnakAsuh|null             first($columns = ['*'])
 * @method static AnakAsuh                  firstOrFail($columns = ['*'])
 * @method static AnakAsuh                  firstOrNew($attributes, $values = array())
 * @method static AnakAsuh                  firstOrCreate($attributes, $values = ['*'])
 * @method static AnakAsuh                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|AnakAsuh[]     get($columns = ['*'])
 */
class AnakAsuh extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anak_asuh';

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
        'anakasuh_id',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'gender',
        'anak_ke',
        'is_yatim',
        'is_sebelum_yatim',
        'yatim_umur',
        'tgl_masuk',
        'is_alumni',
        'tgl_lulus',
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
        'tgl_lahir',
        'tgl_masuk',
        'tgl_lulus',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'anakasuh_id'      => 'integer',
        'nama'             => 'string',
        'tempat_lahir'     => 'string',
        'gender'           => 'string',
        'anak_ke'          => 'integer',
        'is_yatim'         => 'string',
        'is_sebelum_yatim' => 'boolean',
        'yatim_umur'       => 'integer',
        'is_alumni'        => 'integer',
        'tgl_lahir'        => 'date:d-m-Y',
        'tgl_masuk'        => 'date:d-m-Y',
        'tgl_lulus'        => 'date:d-m-Y',
    ];

    /**
     * @return HasOne|Builder|Dokumen
     */
    public function dokumen()
    {
        return $this->hasOne('App\Models\Dokumen', 'anakasuh_id', 'anakasuh_id');
    }

    /**
     * @return HasMany|Builder|Kordes
     */
    public function kordes()
    {
        return $this->hasOne('App\Models\Kordes', 'anakasuh_id', 'anakasuh_id');
    }

    /**
     * @return HasMany|Builder|Parents
     */
    public function parent()
    {
        return $this->hasOne('App\Models\Parents', 'anakasuh_id', 'anakasuh_id');
    }

    /**
     * @return HasMany|Builder|Pendidikan
     */
    public function pendidikan()
    {
        return $this->hasMany('App\Models\Pendidikan', 'anakasuh_id', 'anakasuh_id');
    }

    /**
     * @return HasMany|Builder|Pengasuh
     */
    public function pengasuh()
    {
        return $this->hasOne('App\Models\Pengasuh', 'anakasuh_id', 'anakasuh_id');
    }

    //region ### User defined function #
    //endregion
}
