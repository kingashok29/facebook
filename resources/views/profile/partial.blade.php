<h1 class="text-xs-center"> Edit profile </h1>
<p class="text-xs-center text-info"> Fill the form below and submit, and your info will be updated. </p>
<p class="text-xs-center help-block"> If you want any of your information to be updated then fill the
  relative form
and update <br> else you can leave them empty to keep information unchanged.
</p>

<div class="row">
  <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12">
    <br>
      <div class="text-xs-center">
            <a href=" {{ route('edit.basic') }} " role="button" class="btn btn-md btn-warning">Basic info</a>
            <a href=" {{ route('edit.email-info') }} " role="button" class="btn btn-md btn-warning">Email &amp; password</a>
            <a href=" {{ route('edit.payment-info') }} " role="button" class="btn btn-md btn-warning">Payment info</a>
            <a href=" {{ route('edit.profile-info') }} " role="button" class="btn btn-md btn-warning">Profile Picture</a>
      </div>
    <br>
