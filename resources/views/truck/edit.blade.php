@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit a truck</div>
        <div class="card-body">
          <form method="POST" action="{{route('truck.update',[$truck])}}">
            <div class="form-group">
              <label>Maker</label>
              <input type="text" name="truck_maker" class="form-control" value="{{old('truck_maker',$truck->maker)}}">



              <small class="form-text text-muted">Truck maker</small>
            </div>
            <div class="form-group">
              <label>Plate</label>
              <input type="text" name="truck_plate" class="form-control" value="{{old('truck_plate',$truck->plate)}}">



              <small class="form-text text-muted">Truck number plate</small>
            </div>
            <div class="form-group">
              <label>Make Year</label>
              <input type="text" name="truck_make_year" class="form-control" value="{{old('truck_make_year',$truck->make_year)}}">



              <small class="form-text text-muted">Year the truck was made</small>
            </div>
            <div class="form-group">
              <label>Mechanic Notices</label>
              <textarea id="summernote" class="form-control" name="truck_mechanic_notices">{{old('truck_mechanic_notices',$truck->mechanic_notices)}}</textarea>



              <small class="form-text text-muted">Truck's mechanic notices</small>
            </div>

            <select name="mechanic_id">
              @foreach ($mechanics as $mechanic)
              <option value="{{$mechanic->id}}" @if($mechanic->id == $truck->mechanic_id) selected @endif>
                {{$mechanic->name}} {{$mechanic->surname}}
              </option>
              @endforeach
            </select>
            @csrf
            <button type="submit" class="btn btn-success">EDIT</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
