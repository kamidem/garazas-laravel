@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Create a Mechanic</div>
               <form method="POST" action="{{route('mechanic.store')}}">
                  Name: <input type="text" name="mechanic_name">
                  Surname: <input type="text" name="mechanic_surname">
                  @csrf
                  <button type="submit">ADD</button>
               </form>
               
           </div>
       </div>
   </div>
</div>
@endsection