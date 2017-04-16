<?php namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Response;

class APIController extends Controller
{
  public function Articles()
  {
    $monday = date("Y-m-d", strtotime('monday this week'));
    $sunday = date("Y-m-d", strtotime('this sunday'));
    $articles = Article::where('approved', 1)->where('archived', 0)->whereDate('publish', '>=', $monday)->whereDate('publish', '<=', $sunday)->orderBy('date', 'asc')->get();
    return response()->json(['articles' => $articles], 200);
  }

  public function ArticlesByDay($day){
    if($day < 0 || $day > 6){
      return response()->json(400);
    }
    $monday = date("Y-m-d", strtotime('monday this week'));
    $sunday = date("Y-m-d", strtotime('this sunday'));
    $articles = Article::where('approved', 1)->where('archived', 0)->whereDate('publish', '>=', $monday)->whereDate('publish', '<=', $sunday)->orderBy('date', 'asc')->get();
    $daily = array();
    $today = jddayofweek($day-1, 1);
    $today = date("Y-m-d", strtotime('last '.$today, strtotime($today)));
    foreach($articles as $article){
      $date = date("Y-m-d", strtotime($article->date));
      if($date == $today){
        array_push($daily, $article);
      }
    }
    return response()->json(['articles' => $daily], 200);
  }

  public function ClubArticles(){
    $monday = date("Y-m-d", strtotime('monday this week'));
    $sunday = date("Y-m-d", strtotime('this sunday'));
    $articles = Article::with('categories')->where('approved', 1)->where('archived', 0)->whereDate('publish', '>=', $monday)->whereDate('publish', '<=', $sunday)->orderBy('date', 'asc')->get();
    $clubs = array();
    foreach($articles as $article){
      if($article->categories()->first()->category == "Club Annoucements"){
        array_push($clubs, $article);
      }
    }
    return response()->json(['articles' => $clubs], 200);
  }

  public function Approve($id)
  {
    $article = Article::where('id', $id)->first();
    $article->approved = true;
    $article->save();
    return Response::json(200);
  }

  public function Deny($id)
  {
    $article = Article::where('id', $id)->first();
    $article->approved = false;
    $article->save();
    return Response::json(200);
  }

  public function Role($id, $role)
  {
    $user = User::where('id', $id)->first();
    $roleo = Role::where('name', $role)->first();
    if($user->hasRole($role)){
      $user->roles()->detach($roleo->id);
    } else {
      $user->roles()->attach($roleo->id);
    }
    $user->save();
    return Response::json(200);
  }

  public function Archive($id)
  {
    $article = Article::where('id', $id)->first();
    if($article->archived){
      $article->archived = 0;
    } else {
      $article->archived = 1;
    }
    $article->save();
    return Response::json(200);
  }

  public function SendNewsletter()
  {
    $categories = Category::all();
    $monday = date("Y-m-d", strtotime('monday this week'));
    $sunday = date("Y-m-d", strtotime('this sunday'));
    $articles = Article::where('approved', 1)->where('archived', 0)->whereDate('publish', '>=', $monday)->whereDate('publish', '<=', $sunday)->orderBy('date', 'asc')->get();
    $catCount = array();
    for($i=0; $i<count($categories); $i++){
      array_push($catCount, 0);
    }
    foreach($articles as $article){
      $catCount[($article->categories()->first()->id)-1]++;
    }
    Mail::to('atodd@ksu.edu')->send(new Newsletter($articles, $categories, $catCount));
    return Response::json(200);
  }
}
