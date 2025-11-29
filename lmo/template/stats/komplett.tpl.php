<html>
<head>
<title><!--TeamA--> vs. <!--TeamB--></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=0.5,user-scalable=yes" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css"	type="text/css" media="screen" />
<link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons" />
</head>
<body>
<div class="container">
  <div class="title">
    <h4><!--Text--></h4>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-3 text-end"><!--TeamA--></div>
    <div class="col-2 text-center"><!--Iconhbig--></div>
    <div class="col-1 text-center"><!--Text2--></div>
    <div class="col-2 text-center"><!--Icongbig--></div>
    <div class="col-3 text-start"><!--TeamB--></div>
  </div>
  <!-- BEGIN Liga -->
  <div class="row mb-2 mt-3">
    <div class="col text-center text-light bg-primary shadow"><h5><!--Liganame--></h5></div>
  </div>
  <!-- BEGIN Inhalt -->
  <div class="row mb-3">
    <div class="col-2 text-start"><!--Datum--></div>
    <div class="col-3 text-end d-none d-lg-block"><!--Heim--></div>
    <div class="col-2 text-end d-lg-none"><!--HeimMittel--></div>
    <div class="col-1 text-center"> - </div>
    <div class="col-3 text-start d-none d-lg-block"><!--Gast--></div>
    <div class="col-2 text-start d-lg-none"><!--GastMittel--></div>
    <div class="col-2 text-center"><!--Tore--> <!--SpielEnde--></div>
    <div class="col-1"><!--Notiz--></div>       
  </div>
  <!-- END Inhalt -->
  <!-- END Liga -->
</div>
<!--StatistikShort-->
<div class="container p-3">
  <div class="row">
    <div class="col"></div>
	<div class="col"><strong><!--highHome--></strong></div>
	<div class="col"><strong><!--highAway--></strong></div>
  </div>
  <div class="row">
    <div class="col"><!--TeamA--></div>
	<div class="col"><!--HeimsiegA--></div>
	<div class="col"><!--GastsiegA--></div>	
  </div>
  <div class="row">
    <div class="col"><!--TeamB--></div>
	<div class="col"><!--HeimsiegB--></div>
	<div class="col"><!--GastsiegB--></div>
  </div>
</div>
<br/>
<!--Spiela-->
<br/>
<!--Spielb-->
<br/>
<!--Tabelle-->
<br/>
<div class="container">
  <div class="row mt-5">
    <div class="col-4"><!--Pdf--></div>
    <div class="col-8 text-end"><!--VERSION--><br><!--VERSIONa--><br><!--SPRACHE--><br><!--Dauer--></div>
  </div>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type='text/javascript'>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>
</body>
</html>