@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Create a Truck</div>
                  <form method="POST" action="{{route('truck.store')}}">
                     Maker: <input type="text" name="truck_maker">
                     Plate: <input type="text" name="truck_plate">
                     Make Year: <input type="text" name="truck_make_year">
                     Mechanic Notices: <textarea id="summernote" name="truck_mechanic_notices"></textarea>
                     <select name="mechanic_id">
                        @foreach ($mechanics as $mechanic)
                           <option value="{{$mechanic->id}}">{{$mechanic->name}} {{$mechanic->surname}}</option>
                        @endforeach
                  </select>
                     @csrf
                     <button type="submit">ADD</button>
                  </form>
               
           </div>
       </div>
   </div>
</div>
<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>
@endsection