@extends('../../layouts/app')
@section('title')
    post show
@endsection

@section('content')

    welcome from show workshop
    <ul>
      <li>Title:->  {{$workshop->name}}</li>
      <li> Description:-> {{$workshop->description}}</li>
      <li> Level:-> {{$workshop->level}}</li>
      <li> Capacity:-> {{$workshop->max_capacity}}</li>
      <li> Date From:-> {{$workshop->date_from}}</li>
      <li> Time From:-> {{$workshop->time_from}}</li>
      <li> Time To:-> {{$workshop->time_to}}</li>
      <li> Capacity:-> {{$workshop->max_capacity}}</li>
      <li>Category:-> {{$category_name}}</li>
      <li>Username:-> {{$user_name}}</li>

    </ul>

@endsection
