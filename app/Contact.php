<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

  protected $table = 'contacts';

  protected $fillable = [
    'Fname',  'Lname','phone','email','rank','admin_id', 'type_id',
  ];
  public function cases()
{
  return $this->belongsToMany('App\Court_case', 'case_contacts');
}

}