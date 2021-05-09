@extends('layouts.app')

@section('title', 'Nba Teams')


@section('content')
<h2>Teams</h2>
<div>
  @foreach ($teams as $team)
    <div>
      <a href="{{ route('team', ['team' => $team->id]) }}">{{$team->name}}</a>
    </div>
  @endforeach
</div>
@endsection