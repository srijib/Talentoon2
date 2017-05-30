@extends('layouts.admin')
@section('title')
    categories index
@endsection

@section('body')
    welcome from index
    <ul>
      <li>categories</li>
        @foreach($categories as $category)
            <li>Title:->  {{$category->title}}</li>
            <li> Description:-> {{$category->description}}</li>
               <br>

            <ul>
                <li>All Comments</li>

            </ul>
                 @endforeach
              </ul>


@endsection
