@extends('layouts.app')

@section('content')
    <form  method="post" action="/posts">
        {{csrf_field()}}
        <input type="text" name="name" placeholder="enter name">
        <input type="submit" name="submit" value="submit">

    </form>
@endsection
@section('footer')
