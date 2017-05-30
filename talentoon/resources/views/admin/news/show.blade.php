@extends('../../layouts/app')
@section('title')
    category show
@endsection

@section('content')

    welcome from show category
    <ul>
      <li>Title:->  {{$news->title}}</li>
      <li> Description:-> {{$news->description}}</li>

    </ul>
@endsection
