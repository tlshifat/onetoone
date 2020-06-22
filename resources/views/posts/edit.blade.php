@extends('layouts.app')

@section('content')
    <form  method="post" action="/posts/{{$posts->id}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">
        <input type="text" name="name" placeholder="enter name" value={{$posts->name}}}>
        <input type="submit" name="submit" value="submit">

    </form>
@endsection
@section('footer')
