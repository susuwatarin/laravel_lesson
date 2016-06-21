<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'published_at'];

    public function getTableAttribute($value){
      return mb_strtoupper($value);
    }
    // public function setTitleAttribute($value){
    //   $this->attributes['title'] = mb_strtolower($value);
    // }

    protected $dates = ['published_at'];


    public function scopePublished($query) {
      $query->where('published_at', '<=', Carbon::now());
    }
    
    public function user() 
    {
      return $this->belongsTo('App\User');
    }
    
}
