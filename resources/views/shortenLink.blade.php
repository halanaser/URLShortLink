@extends('layouts.shortlink.app')
@section('content')
    <h1 style="color:blue;">Genarate Short Link</h1>
   
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ route('generate.shorten.link.post') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" type="submit">Generate Shorten Link</button>
              </div>
            </div>
        </form>
      </div>
     
    </div>
    <div class="card-body">
   
   @if (Session::has('success'))
       <div class="alert alert-success">
           <p>{{ Session::get('success') }}</p>
       </div>
   @endif
  
   <div>
 

    

@endsection