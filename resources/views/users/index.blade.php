@extends('layouts.backend')

@section('content')
<x-hero title="المستخدين">
  <x-breadcrumb-item title="المستخدمين" link="{{route('users')}}"></x-breadcrumb-item>
</x-hero>
@endsection
