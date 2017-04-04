<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Newsletter;
use Response;

class APIController extends Controller
{
  public function Articles()
  {
    $articles = Article::with('categories')->where('approved', 1)->where('archived', 0)->get();
    return response()->json(['articles' => $articles], 200);
  }

  public function Approve($id)
  {
    if(Auth::check()){
      if(Auth::user()->hasRole('Administrator'))
      {
        $article = Article::where('id', $id)->first();
        $article->approved = true;
        $article->save();
        return Response::json(200);
      }
      return Response::json(401);
    }
    return Response::json(403);
  }

  public function Deny($id)
  {
    if(Auth::check()){
      if(Auth::user()->hasRole('Administrator'))
      {
        $article = Article::where('id', $id)->first();
        $article->approved = false;
        $article->save();
        return Response::json(200);
      }
      return Response::json(401);
    }
    return Response::json(403);
  }

  public function Role($id, $role)
  {
    if(Auth::check()){
      if(Auth::user()->hasRole('Administrator'))
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
      return Response::json(401);
    }
    return Response::json(403);
  }

  public function Archive($id)
  {
    if(Auth::check()){
      if(Auth::user()->hasRole('Administrator'))
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
      return Response::json(401);
    }
    return Response::json(403);
  }

  public function SendNewsletter()
  {
    if(Auth::check()){
      if(Auth::user()->hasRole('Administrator'))
      {
        $articles = Article::with('categories')->where('approved', 1)->where('archived', 0)->get();
        Mail::to('atodd@ksu.edu')->send(new Newsletter($articles));
        return Response::json(200);
      }
      return Response::json(401);
    }
    return Response::json(403);

  }
}
