@extends('admin.layouts.master')
@section('content')
<p>{{$blog->id}}</p>
<p>{{$blog->title}}</p>
<p>{{$blog->slug}}</p>
<p>{{$blog->description}}</p>
@foreach ($blog->image as $image)
        <img src="{{asset('storage/images/blog/'.$image->filename)}}"alt="{{$image->filename}}">
@endforeach
@endsection