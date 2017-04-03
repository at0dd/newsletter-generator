<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\User;

class Article extends Model
{
  protected $fillable = [
    'title', 'date', 'location', 'link', 'text', 'approved', 'archived', 'submitter_id',
  ];

  public function submitter()
  {
    return $this->belongsTo('App\User', 'submitter_id');
  }

  public function categories()
  {
    return $this->belongsToMany('App\Category', 'article_categories', 'category_id', 'article_id');
  }
}
