@extends('layouts.app')

@section('content')


   @foreach($posts as $post)
       <ul>
       {{$post->name}}
       </ul>
    @endforeach

@endsection
@section('footer')
