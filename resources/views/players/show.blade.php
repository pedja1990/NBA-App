@extends('layouts.app')

@section('title', $player->first_name . ' ' . $player->last_name)

@section('content')
<h2>{{$player->first_name}} {{$player->last_name}}</h2>

<div>Email: {{$player->email}}</div>
<div>Team: <a href="{{route('team', ['team' => $player->team])}}">{{$player->team->name}}</a></div>
@endsection