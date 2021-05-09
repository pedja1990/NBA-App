<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateNewsRequest;
use App\Models\News;
use App\Models\Team;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;


class NewsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $allNews = News::with('user')->orderBy('created_at', 'desc')->paginate(10);
    return view('news.index', compact('allNews'));
  
  }

  public function show(News $news) {
    return view('news.show', compact('news'));
  }


  public function getNewsByTeam($teamName)
  {
    $team = Team::where('name', $teamName)->firstOrFail();
    $news = $team->news()->paginate(10);
    return view('news.team-news', compact('team', 'news'));
  }

  public function create()
  {
    $teams = Team::all();
    return view('news.create', compact('teams'));
  }

  public function store(CreateNewsRequest $request)
  {
    $data = $request->validated();
    $news = auth()->user()->news()->create($data);
    $news->teams()->attach(Arr::get($data, 'teams', []));

    Session::flash('status_message', "Thank you for publishing article on www.nba.com");
    return redirect('/news');
  }
}