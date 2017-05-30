@extends('../../layouts/app')
@section('title')
    Edit Post
@endsection

@section('content')

    welcome from Edit post
    <form method="POST" action="{{route('post.update',$post->id)}}}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <label> Enter title</label>
        <input type="text" name="title" value="{{$post->title}}">
        <br>
        <label> Enter description</label>
        <input type=""text name="description" value="{{$post->description}}">
        <input type="submit" value="Update post" >

    </form>
@endsection
