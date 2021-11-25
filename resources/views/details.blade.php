@extends('layouts.shortlink.app')
@section('content')


@foreach($shortLinks as $row)
<div class="row row-grid align-items-center">
  
<div class="col-12 col-md-7 col-lg-6 order-md-1 pr-md-5">
<a href="{{$row->link}}" target="_blank" ><h2 >{{$row->titles}}</h2></a>
<a href="{{ route('shorten.link', $row->code) }}" target="_blank" >{{ route('shorten.link', $row->code )}}</a>
<p class="text-secondary">{{$row->clicks}} Total Clicks</p></div>
<div class="col-12 col-md-7 col-lg-6 order-md-5 pr-md-5">
<a href="{{ route('dashboard')}} ">Go Back</a></div>
</div>
@endforeach
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">ip</th>
      <th scope="col">browser</th>
      <th scope="col">Date</th>
      
    </tr>
  </thead>
  <tbody>
  @foreach($Details as $row)
    <tr>
      <th >{{$row->ip_address}}</th>
      <td>{{$row->user_agent}}</td>
      <td>{{$row->created_at}}</td>
    
    </tr>
    <tr>
    @endforeach  
  </tbody>
</table>
@endsection