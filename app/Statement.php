<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $table = 'statements';

    public function admin()
    {
        return $this->belongsTo('App\Admin','admin_id');
    }
    public function report_crime()
    {
        return $this->belongsTo('App\Report_crime','crime_id');
    }



    protected $fillable = [
        'crime_id',  'admin_id','ob_number','police_number','status','statement',
    ];
}
