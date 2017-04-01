<?php namespace App\Http\Controllers;

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
    return view('contribute');
  }

  public function Profile()
  {
    return view('profile');
  }

  public function Administration()
  {
    return view('administration');
  }
}
