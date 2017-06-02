@extends('../../layouts/app')
@section('title')
    workshops
@endsection

@section('content')

    <table class="table table-striped" border="1">
      <thead>
          <th>title</th><th>Description</th><th  colspan="4">action</th>
      </thead>
      <tbody>
          @foreach ($workshops as $workshop)
          <tr>

                  <td>{{$workshop->name}}</td>
                  <td>{{$workshop->description}}</td>
                  <td>

                  <a class="btn btn-danger" href="{{route('workshop.show',$workshop->id)}}">Show</a>

                  @if ($workshop->is_approved == 1)
                  <a class="btn btn-danger" href="{{route('workshop.unapprove',$workshop->id)}}">Un Approve</a>
                  @else
                  <a class="btn btn-danger" href="{{route('workshop.approve',$workshop->id)}}">Approve</a>

                  @endif
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
