<?php namespace App\Support;


use Hashids\Hashids;

trait HashableId {

    /**
     * @param $public_id
     * @return mixed
     */
    public function findByPublicId($public_id)
    {
        return $this->find($this->_hashIds($public_id));
    }

    /**
     * @param $query
     * @param $public_id
     * @return mixed
     */
    public function scopeByPublicId($query, $public_id)
    {
        return $this->findByPublicId($public_id);
    }

    /**
     * @return mixed
     */
    public function getPublicIdAttribute()
    {
        return $this->_hashIds($this->{$this->getKeyName()});
    }

    /**
     * @param $id
     * @return array|bool|string
     */
    private function _hashIds($id)
    {
        $alphabet = 'abcdefghijklmnpqrstuvwxyz123456789';


        $hashids = new Hashids(
            getenv('APP_HASH_SALT'),
            6,
            $alphabet
        );

        if (preg_match("/^[0-9]+$/",$id)) {

            if ($id < 0) return null;

            return $hashids->encode(intval($id));

        } else {

            $decoded = $hashids->decode($id);

//            dd($decoded);

            if (is_array($decoded) && ! empty($decoded) ) {
                return $decoded[0];
            }

            return null;
        }
    }
    
}