<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use \App\Http\Traits\UsesUuid;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    protected $guarded = [];
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pendidikan',
        'penyakit_berat', //alias tes kesehatan
        'pengetahuan_kesehatan',
        'keaktifan_sosial',
        'keahlian_komputer',
        'kepribadian',
        'mempunyai_hp',
        'kader_id'
];

    public function kader()
    {
        return $this->belongsTo('App\Models\Kader');
    }
}
