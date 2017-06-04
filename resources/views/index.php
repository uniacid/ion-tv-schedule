<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>TV Schedule</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">    

    <!-- Bootstrap core CSS -->
    <!--<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .picker {
            width: 200px;
        }
        .tvShow {
            padding-bottom: 10px;
        }
    </style>
  </head>

  <body>

    <div id="app" class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active">
                <h5>Select a Date:</h5> 
                <datepicker v-model="dateSelected" class="picker" v-on:input="dateSelect" :min="defaultDate" :max="maxDate"></datepicker>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">ION TV Schedule</h3>
        <h5>Selected date: <b>{{ tvScheduleSelectedDate }}</b></h5>
        <h5>Current date: <b>{{ momentDateTime }}</b></h5>
      </div>

      <div class="jumbotron">
        <h1>{{ featuredShow.showName }}</h1>
        <img v-bind:src="featuredShow.image" v-bind:alt="featuredShow.showName" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <p class="lead"><strong>Episode:</strong> <br/> {{ featuredShow.episodetitle }}</p>
        <p class="lead"><strong>Synopsis:</strong> <br/> {{ featuredShow.synopsis }}</p>
        <p class="lead"><strong>Time:</strong> <br/> {{ featuredShow.tune_in_time }}</p>
        <p class="lead"><strong>Duration:</strong> <br/> {{ featuredShow.duration / 60 }} Minutes</p>

        <p><a class="btn btn-lg btn-primary" role="button" target="_blank" v-bind:href="featuredShow.link">View Show Info</a></p>
      </div>

      <div class="row marketing">
        <div class="tvShow col-lg-6 col-md-6 col-sm-6 col-xs-6" v-for="show in tvScheduleSelectedDay">
          <img v-bind:src="show.image" v-bind:alt="show.showName" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4>{{ show.showName }} - {{ show.episodetitle }}</h4>
            
            <h5>{{ show.tune_in_time }}</h5>

            <p class="synopsis-short" v-show="!show.showFullSynopsis">
                <strong>Synopsis:</strong> {{ show.synopsis | truncate(100) }} 
                <a @click="fullSynopsis(show, $event)">Show More</a>
            </p>
            <p class="synopsis-full" v-show="show.showFullSynopsis">
                <strong>Synopsis:</strong> {{ show.synopsis }}
                <a @click="shortSynopsis(show, $event)">Show Less</a>
            </p>
            
            <a target="_blank" v-bind:href="show.link">View Show Info</a>
            <p>&nbsp;</p>
          </div>
        </div>

      </div>

      <footer class="footer">
        <p>&copy; <?=date('Y');?> ION Media.</p>
      </footer>

    </div> <!-- /container -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.5.0/bluebird.min.js"></script>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        
    <script src="https://unpkg.com/vue@2.3.3"></script>
    
    <script src="js/vue-datepicker.js"></script>
        
    <script src="js/app.js"></script>
        
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>
</html>