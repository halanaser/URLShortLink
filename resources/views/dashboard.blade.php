@extends('layouts.shortlink.app')
@section('content')

<h1 style="color:blue;">Genarate Short Link</h1>
    
@if (Session::has('success'))
       <div class="alert alert-success">
           <p>{{ Session::get('success') }}</p>
       </div>
   @endif
     

   <div class="card">
     <div class="card-header">
       <form method="POST" action="{{ route('generate.shorten.link.post') }}">
           @csrf
           <div class="input-group mb-3">
             <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
             <div class="input-group-append">
               <button class="btn btn-primary" type="submit">Generate Shorten Link</button>
             </div>
           </div>
       </form>
     </div>
    
   </div>
   <div class="card-body">
  

   <table class="table table-sm">
  <thead >
           <tr>
               
               <th>Short Link</th>
               <th>Link</th>
               <th>Clicks</th>
               <th>More Details</th>
               
           </tr>
       </thead>
       <tbody>
           @foreach($shortLinks as $row)
               <tr>
                   
                   <td><a href="{{ route('shorten.link', $row->code) }}"  target="_blank" >{{ route('shorten.link', $row->code) }}</a>
                </td>
                   <td>{{ $row->link }}</td>
                   <td>{{ $row->clicks }}</td>
                   <td> <a class="link-dark" href="{{ route('Detail',$row->id) }}">More...</a></td>
               </tr>
           @endforeach
       </tbody>
   </table>
</div>
</div>

@endsection
