@extends('welcome')



@section('kontent')
<div class="col-md-6">
    <div class="card">
        <div class="card-header card-header-text card-header-primary">
          <div class="card-text">
            <h4 class="card-title">Pencarian Data</h4>
          </div>
        </div>
        <div class="card-body">
            <form method="Get" action="{{url('/searchdate')}}">
              {{csrf_field()}} 
              <div class="row">
                  <div class="form-group">
                <div class="col">
                  <input type="date" class="form-control" placeholder="Start Date" name="start_date">
                </div>
                  </div>
                  <div class="form-group">
                <div class="col">
                  <input type="date" class="form-control" placeholder="End Date" name="end_date">
                </div>
                  </div>
              </div>
            
              <input type="submit" value="Cari" class="btn btn-primary">
              
            </form>
        </div>
    </div>
</div>
</div>


  @endsection