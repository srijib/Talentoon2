@extends('../../layouts/app')
@section('title')
    Edit Post
@endsection

@section('content')

    welcome from Edit post
    <form method="POST" action="{{route('category.update',$category->id)}}}" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <label> Enter title</label>
        <input type="text" name="title" value="{{$category->title}}" required>
        <br>
        <label> Enter description</label>
        <input type="text" name="description" value="{{$category->description}}" required>

        <br>
        <label> Enter image , current image is: {{$category->image}}</label>
        <input type="file" name="image" required>

        <input type="submit" value="Update category" >

    </form>
@endsection
