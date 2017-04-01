<?php namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MainController extends Controller
{
  public function Index()
  {
    return view('index');
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
      'event' => 'required|string|max:255',
      'category' => 'required|string|max:255',
      'link' => 'string|max:255',
      'text' => 'required|string|max:144',
    ]);
    $article = new Article();
    $article->event = $request->input('event');
    $article->category = $request->input('category');
    $article->link = $request->input('link');
    $article->text = $request->input('text');
    $article->save();
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
    return view('administration');
  }
}
