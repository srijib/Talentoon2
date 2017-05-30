@extends('../../layouts/app')
@section('title')
    category show
@endsection

@section('content')
<a class="btn btn-danger" href="{{route('news.create')}}">Create</a>

    <table class="table table-striped" border="1">
      <thead>
          <th>title</th>
          <th>description</th>
          <th>Created By </th>
          <th> Category</th>
          <th  colspan="4">action</th>
      </thead>
      <tbody>
          @foreach ($news as $news)
          <tr>

                  <td>{{$news->title}}</td>
                  <td>{{$news->description}}</td>
                  <td>{{$news->name}}</td>
                  <td>{{$news->cat_title}}</td>
                  <td><form method="post" action="{{route('news.destroy',$news->id)}}">
                  <input name="_method" type="hidden" value="DELETE">
                  <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <button type="submit" class="btn btn-primary">Delete</button>
                       </div>
                    </form>
                  <a class="btn btn-danger" href="{{route('news.edit',$news->id)}}">Edit</a>
                  <a class="btn btn-danger" href="{{route('news.show',$news->id)}}">Show</a>


                </td>

          </tr>
          @endforeach
      </tbody>
    </table>

          @if(count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

@endsection
