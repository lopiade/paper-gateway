<?php namespace App\Models;

use App\Support\HashableId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paper
 *
 * @package App\Models
 * @property $id
 * @property $title
 * @property $subtitle
 * @property $print
 * @property $created_at
 * @property $updated_at
 */
class Paper extends Model
{

    use HashableId;

    protected $table = 'paper';

    protected $appends = ['public_id'];

    protected $casts = [
        'print' => 'bool'
    ];

    public function resource()
    {
        return $this->hasMany(PaperResource::class, 'paper_id');
    }


}
