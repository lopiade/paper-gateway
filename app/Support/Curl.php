<?php namespace App\Support;


class Curl {


    /** @var resource cUrl Session */
    protected $session;

    /** @var string */
    public $body;

    /** @var int */
    public $status;


    /**
     * perform cURl request
     *
     * @param $url
     * @return $this
     */
    public static function request( $url )
    {
        $curl = new static;
        $curl->session = curl_init( $url );
        return $curl->handle();
    }

    /**
     * @return $this
     */
    protected function handle()
    {
        curl_setopt($this->session, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($this->session, CURLOPT_RETURNTRANSFER, true);

        $this->body = curl_exec($this->session);
        $this->status = curl_getinfo($this->session, CURLINFO_HTTP_CODE);

        curl_close($this->session);

        return $this;
    }
    
}