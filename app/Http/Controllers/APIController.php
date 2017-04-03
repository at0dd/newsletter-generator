<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class APIController extends Controller
{
  public function Articles()
  {
    $articles = Article::where('approved', 1)->get();
    return Response::json($articles, 200);
  }
}
