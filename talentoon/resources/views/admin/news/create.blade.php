@extends('../../layouts/app')
@section('title')
    news create
@endsection

@section('content')

    welcome from create news
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form method="POST" action="{{route('news.store')}}">
        {{csrf_field()}}
        <label> Enter title</label>
            <input type="text" name="title">
            <br>

            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
            <label> Enter Description</label>
            <input type="text" name="description">
            <br>
            <label> Enter Category</label>

            <select id="category_id" name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{$category->title}}</option>
            @endforeach
           </select>
           <br>
        <input type="submit" value="Save news" >

    </form>
@endsection
