<?php namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Response;

class MainController extends Controller
{
  public function Index()
  {
    $categories = Category::all();
    $articles = Article::where('approved', 1)->where('archived', 0)->orderBy('date', 'asc')->get();

    return view('index', compact('categories', 'articles'));
  }

  public function Mail()
  {
    $articles = Article::with('categories')->where('approved', 1)->where('archived', 0)->orderBy('date', 'asc')->get();
    return view('mail/newsletter', compact('articles'));
  }

  public function Archives()
  {
    $categories = Category::all();
    $articles = Article::with('categories')->where('approved', 1)->where('archived', 1)->orderBy('date', 'asc')->paginate(15);
    return view('archives', compact('categories', 'articles'));
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
      'category' => 'required|string|max:255',
      'link' => 'max:255',
      'date' => 'max:255',
      'location' => 'max:255',
      'text' => 'required|string|max:144',
    ]);
    $category = Category::where('slug', $request->input('category'))->first();
    $article = new Article();
    $article->title = $request->input('title');
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
    $articles = Article::paginate(15);
    $articlecount = Article::count();
    $usercount = User::count();
    return view('administration', compact('articles', 'articlecount', 'usercount'));
  }

  public function ArchiveAll()
  {
    $articles = Article::where('archived', 0)->get();
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
