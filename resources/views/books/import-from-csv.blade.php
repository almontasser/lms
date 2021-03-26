@extends('layouts.backend')

@section('content')

<form action="{{ route('import-from-csv') }}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="file" name="csv" id="csv">
  <input type="submit" value="Submit">
</form>

@endsection
