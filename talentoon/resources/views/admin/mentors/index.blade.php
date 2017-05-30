@extends('../../layouts/app')
@section('title')
    users list
@endsection

@section('content')

    <table class="table table-striped" border="1">
      <thead>
          <th>Name</th>
          <th>Category</th>
          <th>years of experience</th>
          <th>experience</th>
          <th  colspan="4">action</th>
      </thead>
      <tbody>
          @foreach ($mentors as $mentor)
          <tr>

                  <td>{{$mentor->first_name}} {{$mentor->last_name}}</td>
                  <td>{{$mentor->title}}</td>
                  <td>{{$mentor->years_of_experience}}</td>
                  <td>{{$mentor->experience}}</td>
                  <td>


                  @if ($mentor->status == 1)
                  <a class="btn btn-danger" href="{{route('mentor.unmentor',$mentor->mentor_id)}}">Un Mentor</a>
                  @else
                  <a class="btn btn-danger" href="{{route('mentor.be_mentor',$mentor->mentor_id)}}">Be Mentor</a>

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
