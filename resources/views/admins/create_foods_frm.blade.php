@extends('layouts.admin')

@section('content')
<!-- Imported start -->
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Food Items</h5>
      <form method="POST" action="{{ route('store-foods') }}" enctype="multipart/form-data">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
              @error('name')
                    <span class="text-danger" role="alert">
                        <small><em>{{ $message }}</em></small>
                    </span>
                @enderror
            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
              @error('price')
                    <span class="text-danger" role="alert">
                        <small><em>{{ $message }}</em></small>
                    </span>
                @enderror
            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control"  />
             
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              @error('description')
                    <span class="text-danger" role="alert">
                        <small><em>{{ $message }}</em></small>
                    </span>
                @enderror
            </div>
           
            <div class="form-outline mb-4 mt-4">

              <select name="category" class="form-select  form-control" aria-label="Default select example">
                <option selected>Choose category</option>
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="Dinner">Dinner</option>
              </select>
              @error('category')
                    <span class="text-danger" role="alert">
                        <small><em>{{ $message }}</em></small>
                    </span>
                @enderror
            </div>

            <br>
  
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>
<!-- Imported end -->
@endsection