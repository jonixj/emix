<?php namespace Emix;

use Eloquent;

class Server extends Eloquent
{
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    public function reports()
    {
        return $this->hasMany('Emix\Report');
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function hasReports()
    {
        return $this->reports()->count() > 0;
    }

    public function getLatestReport($type)
    {
        return $this->reports()->whereHas(
            'ReportType',
            function ($q) use ($type) {
                $q->where('name', 'like', $type);

            }
        )->orderBy('created_at', 'desc')->take(1)->first();
    }
}
