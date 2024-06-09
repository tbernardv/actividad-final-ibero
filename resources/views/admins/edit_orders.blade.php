@extends('layouts.admin')

@section('content')
<!-- Imported start -->
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Update order status</h5>
          <p>Status is <span class="text-success">{{ $order->status }}</span></p>
        <form method="POST" action="{{ route('orders-update', $order->id) }}" enctype="multipart/form-data">
            @csrf
           
            <div class="form-outline mb-4 mt-4">

              <select name="status" class="form-select  form-control" aria-label="Default select example">
                <option selected>Choose status</option>
                <option value="Processing">Processing</option>
                <option value="Delivering">Delivering</option>
                <option value="Delivered">Delivered</option>
              </select>
            </div>

            <br>
          

  
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">UPDATE</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>
<!-- Imported end -->
@endsection