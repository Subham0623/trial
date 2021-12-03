@extends('layouts.website')
  
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Checkout</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.order-store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth::user()->name }}"  autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paymentmode" class="col-md-4 col-form-label text-md-right">Payment mode</label>

                            <div class="col-md-6">
                                <input id="paymentmode" type="paymentmode" class="form-control @error('paymentmode') is-invalid @enderror" name="paymentmode" value="{{ old('paymentmode') }}"  autocomplete="paymentmode">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-md-4 col-form-label text-md-right">Total</label>

                            <div class="col-md-6">
                                <input id="total" type="total" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ old('total') }}"  autocomplete="total">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Proceed to pay
                                </button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection