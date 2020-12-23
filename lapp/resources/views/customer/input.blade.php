@extends('welcome')



@section('kontent')
   {{-- menampilkan error validasi --}}
   @if (count($errors) > 0)
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
   @endif
<div class="row">
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
              <div class="card-text">
                <h4 class="card-title">Tambah Customers</h4>
              </div>
            </div>
            <div class="card-body">
                    <form action="{{url('/simpancustomer')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tour Operator</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="tour_operators" value="{{old('tour_operators')}}">
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name ="address" value="{{old('address')}}">
                               
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="contact" value="{{old('contact')}}">
                               
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="title" value="{{old('title')}}">
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="phone" value="{{old('phone')}}">
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fax</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="fax" value="{{old('fax')}}">
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="email" value="{{old('email')}}">
                                
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
            </div>
        </div>
    </div>
</div>


@endsection
