<?php namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Response;

class MainController extends Controller
{
  public function Index()
  {
    $categories = Category::all();
    $monday = date("Y-m-d", strtotime('monday this week'));
    $sunday = date("Y-m-d", strtotime('this sunday'));
    $articles = Article::where('approved', 1)->where('archived', 0)->whereDate('publish', '>=', $monday)->whereDate('publish', '<=', $sunday)->orderBy('date', 'asc')->get();
    $byDay = array();
    for($i=0; $i<7; $i++){
      $byDay[$i] = array();
    }
    $catCount = array();
    foreach($categories as $category){
      array_push($catCount, count($category->articles()->where('approved', 1)->where('archived', 0)->whereDate('publish', '>=', $monday)->whereDate('publish', '<=', $sunday)->get()));
    }
    foreach($articles as $article){
      if($article->date != null && $article->categories()->first()->category != "Job Opportunities"){
        array_push($byDay[date('w', strtotime($article->date))], $article);
      }
    }
    return view('index', compact('categories', 'articles', 'byDay', 'catCount'));
  }

  public function Mail()
  {
    $categories = Category::all();
    $monday = date("Y-m-d", strtotime('monday this week'));
    $sunday = date("Y-m-d", strtotime('this sunday'));
    $articles = Article::where('approved', 1)->where('archived', 0)->whereDate('publish', '>=', $monday)->whereDate('publish', '<=', $sunday)->orderBy('date', 'asc')->get();
    $catCount = array();
    foreach($categories as $category){
      array_push($catCount, count($category->articles()->where('approved', 1)->where('archived', 0)->whereDate('publish', '>=', $monday)->whereDate('publish', '<=', $sunday)->get()));
    }
    return view('mail/newsletter', compact('categories', 'articles', 'catCount'));
  }

  public function Archives()
  {
    $categories = Category::all();
    $articles = Article::with('categories')->where('approved', 1)->where('archived', 1)->orderBy('publish', 'asc')->paginate(15);
    $catCount = array();
    foreach($categories as $category){
      array_push($catCount, count($category->articles()->where('approved', 1)->where('archived', 1)->get()));
    }
    return view('archives', compact('categories', 'articles', 'catCount'));
  }

  public function Guidelines()
  {
    return view('guidelines');
  }

  public function Contribute()
  {
    $categories = Category::all();
    return view('contribute', compact('categories'));
  }

  public function ContributeSubmit(Request $request)
  {
    $this->validate($request, [
      'title' => 'required|string|max:255',
      'publish' => 'max:255',
      'category' => 'required|string|max:255',
      'link' => 'max:255',
      'date' => 'max:255',
      'location' => 'max:255',
      'text' => 'required|string|max:255',
    ]);
    $category = Category::where('slug', $request->input('category'))->first();
    $article = new Article();
    $article->title = $request->input('title');
    $publish = date_create_from_format('m/d/Y', $request->input('publish'));
    $publish->getTimestamp();
    $article->publish = $publish;
    $article->link = $request->input('link');
    if($request->input('date') != "")
    {
      $date = date_create_from_format('m/d/Y h:i A', $request->input('date'));
      $date->getTimestamp();
      $article->date = $date;
    }
    $article->location = $request->input('location');
    $article->text = $request->input('text');
    $article->submitter()->associate(Auth::user());
    $article->save();
    $article->categories()->attach($category);
    return redirect()->action('MainController@Contribute')->with('success', 'Your article has been submitted for review!');
  }

  public function Profile()
  {
    return view('profile');
  }

  public function UpdateProfile(Request $request)
  {
    $user = User::where('eid', Auth::user()->eid)->first();
    $this->validate($request, [
      'first' => 'required|string|max:255',
      'last' => 'required|string|max:255',
      'email' => 'required|email|max:255|unique:users,email,'.$user->id,
    ]);
    $user->first = $request->input('first');
    $user->last = $request->input('last');
    $user->email = $request->input('email');
    $user->save();
    return redirect()->action('MainController@Profile')->with('success', 'Your profile has been updated!');
  }

  public function Administration()
  {
    $articles = Article::orderBy('publish', 'asc')->paginate(15);
    $articlecount = Article::count();
    $usercount = User::count();
    return view('administration', compact('articles', 'articlecount', 'usercount'));
  }

  public function ArchiveAll()
  {
    $articles = Article::where('approved', 1)->where('archived', 0)->get();
    foreach($articles as $article){
      $article->archived = 1;
      $article->save();
    }
    return redirect()->action('MainController@Administration')->with('success', 'All articles have been archived!');
  }

  public function Users()
  {
    $users = User::all();
    $articlecount = Article::count();
    $usercount = User::count();
    return view('users', compact('users', 'articlecount', 'usercount'));
  }
}
