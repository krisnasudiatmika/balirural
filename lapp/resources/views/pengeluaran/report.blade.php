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
            <form method="get" action="{{url('/pengeluaran-search')}}">
              {{csrf_field()}} 
              <div class="row">
                  <div class="form-group">
                <div class="col">
                        <label for="exampleInputEmail1">Start Date</label>
                  <input type="date" class="form-control" placeholder="Start Date" name="start_date">
                </div>
                  </div>
                  <div class="form-group">
                <div class="col">
                        <label for="exampleInputEmail1">End Date</label>
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