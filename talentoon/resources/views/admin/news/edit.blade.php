@extends('../../layouts/app')
@section('title')
    categories create
@endsection

@section('content')

    welcome from create category
    <form method="POST" action="{{route('news.update',$news->id)}}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <label> Enter title</label>
        <input type="text" name="title" value="{{$news->title}}">
        <br>
        <label> Enter description</label>
        <input type=""text name="description" value="{{$news->description}}">
        <input type="submit" value="Save category" >

    </form>
@endsection
