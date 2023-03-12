@extends('layouts.auth')

@section('content')
<h3 class="card-title text-left mb-3">Register</h3>
<form method="POST" action="{{url('register/post')}}">
  @csrf
  <div class="form-group">
    <div class="form-group">
    <label>NIK</label>
    <input type="text"  class="form-control p_input num_input" name="nik" minlength="16" maxlength="16" required value="{{old('nik')}}">
    @if ($errors->has('nik'))
      <span class="help-block text-danger">
        <strong>{{ $errors->first('nik') }}</strong>
      </span>
    @endif
    </div>
    <label>Nama</label>
    <input type="text" class="form-control p_input" name="nama" required value="{{old('nama')}}">
    @if ($errors->has('nama'))
      <span class="help-block text-danger">
        <strong>{{ $errors->first('nama') }}</strong>
      </span>
    @endif
  </div>
  <div class="form-group">
    <div class="form-group">
    <label>NO Telfon</label>
    <input type="text" class="form-control p_input num_input" name="telp" minlength="11" maxlength="13" required value="{{old('telp')}}">
    {{-- <input type="text" placeholder="Search For . . . " pattern= "[0-9]" value="{{ old('telp') }}" minlength="11" maxlength="13" name="telp" class="@error('telp') is-invalid @enderror form-control p_input" required  oninvalid="this.setCustomValidity('Please Fill With Number !!!')" onvalid="this.setCustomValidity('')"> --}}
    @if ($errors->has('telp'))
      <span class="help-block text-danger">
        <strong>{{ $errors->first('telp') }}</strong>
      </span>
    @endif
    </div>
  </div>
  <div class="form-group">
    <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control p_input" name="email" required value="{{old('email')}}">
    </div>
    @if ($errors->has('email'))
      <span class="help-block text-danger">
        <strong>{{ $errors->first('email') }}</strong>
      </span>
    @endif
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control p_input" name="password" required minlength="6">
    @if ($errors->has('password'))
      <span class="help-block text-danger">
        <strong>{{ $errors->first('password') }}</strong>
      </span>
    @endif
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-primary btn-block enter-btn">Register</button>
  </div>
  <p class="sign-up text-center">Already have an Account?<a href="{{url('login')}}"> Login</a></p>
</form>
<script>
  $(function ($) {  
    $.fn.inputFilter = function(callback, errMsg) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
        if (callback(this.value)) {
            // Accepted value
            if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
            $(this).removeClass("input-error");
            this.setCustomValidity("");
            }
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
            // Rejected value - restore the previous one
            $(this).addClass("input-error");
            this.setCustomValidity(errMsg);
            this.reportValidity();
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
            // Rejected value - nothing to restore
            this.value = "";
        }
        });
    };
    $(document).ready(function() {
      $(".num_input").inputFilter(function(value) {
          return /^\d*$/.test(value);    // Allow digits only, using a RegExp
      },"Only digits allowed");
    });
});
</script>
@endsection