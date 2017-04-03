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
    $articles = Article::where('approved', 1)->get();

    return view('index', compact('categories', 'articles'));
  }

  public function Archives()
  {
    return view('archives');
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
    $article->date = $request->input('date');
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
    $articles = Article::all();
    $usercount = User::count();
    return view('administration', compact('articles', 'usercount'));
  }

  public function Users()
  {
    $users = User::all();
    return view('users', compact('users'));
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
}
