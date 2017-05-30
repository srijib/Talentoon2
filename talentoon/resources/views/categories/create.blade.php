@extends('layouts/admin')
@section('title')
    categories create
@endsection

@section('body')

    welcome from create categories
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form method="POST" action="{{route('category.store')}}">
        {{csrf_field()}}
        <label> Enter title</label>
            <input type="text" name="title">
            <br>
            <input type="text" name="image">
        <input type="submit" value="Save category" >

    </form>
@endsection
