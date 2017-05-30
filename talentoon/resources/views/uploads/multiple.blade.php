@extends('layouts.admin')

@section('body')

    <div class="container">

        <div class="form-group">
            <h2>Simple Multiple Uploads</h2>
            <form action="/uploads/multipleuploded" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="file" name="images[]" multiple>

                <br>
                <input type="submit" value="Upload">
            </form>



        </div>
    </div>


    @endsection