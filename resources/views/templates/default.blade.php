<!DOCTYPE html>
<html>
<head>
  <title> Social Media with Laravel </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
  <link href="http://fonts.googleapis.com/css?family=Josefin+Sans:700|Amatic+SC:700|Roboto" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href=" {{ URL::asset('css/style.css') }} ">
  <script src="https://use.fontawesome.com/fa4c6c8791.js"></script>
</head>
<body>
<div class="container-fluid">

  @include('templates.partials.navigation')
  @include('templates.partials.alert')
  @yield('content')

</div>

    <!-- <footer class="footer">
      <div class="container">
        <p class="text-lg-center" style="color:#FDFCFC;">&copy; Earnm.in All rights reserved <?php echo date("Y");?></p>
        <ul class="footer-li list-inline">
          <li class="list-inline-item"><a href="{{ route('support.contact-us') }}"> Contact us </a></li>
          <li class="list-inline-item"><a href=""> Report bug </a></li>
        </ul>
      </div>
    </footer> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>

</body>
</html>
