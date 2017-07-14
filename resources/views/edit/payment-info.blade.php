@extends('templates.default')

@section('content')
@include('profile.partial')

    <form action="{{ route('edit.payment-info') }}" class="form-horizontal" method="post">

      <div class="form-group col-lg-12 {{ $errors->has('paypal-email') ? 'has-danger' : '' }}">
        <label for="paypal-email" class="col-form-label">PayPal Address</label>
        <input type="text" name="paypal-email" class="form-control form-control-danger" value="{{ Request::old('paypal-email') ?: Auth::user()->paypal_email }}">
        @if($errors->has('paypal-email'))
          <div class="form-control-feedback">{{ $errors->first('paypal-email') }}</div>
        @endif
      </div>

      <div class="form-group col-lg-12 {{ $errors->has('paytm-email') ? 'has-danger' : '' }}">
        <label for="paytm-email" class="col-form-label">PayTM Email</label>
        <input type="text" name="paytm-email" class="form-control form-control-danger" value="{{ Request::old('paytm-email') ?: Auth::user()->paytm_email }}">
        @if($errors->has('paytm-email'))
          <div class="form-control-feedback">{{ $errors->first('paytm-email') }}</div>
        @endif
      </div>

      <div class="form-group col-lg-12">
        <div class="text-muted"> Internation users will receive their money via PayPal and Domestic
        or Indian users will receive their money via PayTM, choose wisely, thanks :) </div>
      </div>

      <div class="form-group col-lg-12">
        <button type="submit" class="btn btn-primary"> Update payment info </button>
        {{ csrf_field() }}
      </div>

    </form>

  </div>
</div>

@stop
