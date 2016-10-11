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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resource()
    {
        return $this->hasMany(PaperResource::class, 'paper_id')->orderBy('type','desc');
    }

    /**
     * @param $slug
     * @return $this|bool
     */
    public function scopePrintResources($slug)
    {
        $paper = $this->findByPublicId($slug); /** @var Paper $paper */

        if ( ! $paper || ! $paper->print) return false;

        return $paper->load(['resource' => function($q) {
            $q->where('print','=',true);
        }]);
    }

}
