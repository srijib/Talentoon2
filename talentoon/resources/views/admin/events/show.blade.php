@extends('../../layouts/app')
@section('title')
    post show
@endsection

@section('content')

    welcome from show event
    <ul>
      <li>Title:->  {{$event->title}}</li>
      <li> Description:-> {{$event->description}}</li>
      <li> Level:-> {{$event->location}}</li>
      <li> Date From:-> {{$event->date_from}}</li>
      <li> Time From:-> {{$event->time_from}}</li>
      <li> Time To:-> {{$event->time_to}}</li>
      <li>Category:-> {{$category_name}}</li>
      <li>Username:-> {{$user_name}}</li>
      <li>Image:-><img src={{asset("$event->media_url")}}></li>

    </ul>

@endsection
