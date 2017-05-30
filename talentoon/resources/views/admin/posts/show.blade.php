@extends('../../layouts/app')
@section('title')
    post show
@endsection

@section('content')

    welcome from show post
    <ul>
      <li>Title:->  {{$post->title}}</li>
      <li> Description:-> {{$post->description}}</li>
      <li>Category:-> {{$category_name}}</li>
      <li>Username:-> {{$user_name}}</li>

    </ul>

@endsection
