<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaperResource
 *
 * @package App\Models
 * @property $id
 * @property $paper_id
 * @property $type
 * @property $url
 * @property $print
 * @property $active
 * @property $online
 */
class PaperResource extends Model
{
    protected $table = 'paper_resources';

    protected $casts = [
        'print' => 'bool',
        'active' => 'bool'
    ];

    protected $appends = ['active_label', 'online_label', 'type_label', 'type_description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id');
    }

    /**
     * @return string
     */
    public function getActiveLabelAttribute()
    {
        return $this->active ? 'Active' : 'Inactive';
    }

    /**
     * @return null|string
     */
    public function getOnlineLabelAttribute()
    {
        // 0 | 1 | 2

        switch ($this->online) {

            case 0:
                return 'Auto';

            case 1:
                return 'Online';

            case 2:
                return 'Offline';
        }

        return null;
    }

    /**
     * @return string
     */
    public function getTypeLabelAttribute()
    {
        return ucfirst($this->type);
    }

    /**
     * @return string
     */
    public function getTypeDescriptionAttribute()
    {
        switch ($this->type) {
            case 'original':
                return 'This is the internet source\'s original address.';
            case 'local':
                return 'This is a specifically saved copy.';
            case 'mirror':
                return 'This is an alternative source for the original.';
        }
        return 'This is something else ...';
    }
}
