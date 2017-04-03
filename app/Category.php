<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Article;

class Category extends Model
{
  protected $fillable = [
    'category',
  ];

  public function articles()
  {
    return $this->belongsToMany('App\Article', 'article_categories', 'article_id', 'category_id');
  }
}
