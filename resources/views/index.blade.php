<html>
<head>
  <title>Index</title>
  <!-- Latest compiled and minified CSS -->
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
-->
  <link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.css" >
  <link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css" >

  <style>
    .container-fluid{
      padding: 0;
    }
    .jumbotron{
      border-radius: 0px; !important
      border-width: 0px;
      -moz-border-radius: 0px;
      -webkit-border-radius: 0px;
      margin-bottom: 0px;
    }
    .bar{
      display: block;
      width: 100%;
      text-align: center;
      background-color: #00E8AD;
      color: #fff;
      font-size: 20pt;
    }
    .bar:hover{
      background-color: #00BF8E;
      color: inherit;
      text-decoration: none;
    }
  </style>
</head>

<body>
    <?php
    // initiate Helpers
    $helper = new \app\Helpers\DateTimeHelper;
    $song = new \app\Helpers\SongHelper;
    ?>
      <div class="jumbotron">
        <div class="container">
          <h3 class="text-success">NOW PLAYING: </h3>
          <h1>
            @foreach($np as $p)
              {{ $p->artist }} - {{ $p->title }}
            @endforeach
          </h1>
        </div>
      </div>
      <a class="bar" href="/listen.m3u">TUNE IN</a>
  <div class="container">
      <h3>History:</h3>
      <table class="table table-striped col-lg-12">
        <tr>
          <th class="col-lg-1">#</th>
          <th class="col-lg-4">Artist</th>
          <th class="col-lg-6">Title</th>
          <th class="col-lg-1">Duration</th>
        </tr>
      <tbody>
      @foreach($history as $h)
        <tr>
          <td>
            {{ $h->ID }}
          </td>
          <td>
            {{ $h->artist }}
          </td>
          <td>
            {{ $h->title }}
          </td>
          <td>
            {{ $helper->convertTime($h->duration) }}
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
      <h3>Upcoming</h3>
      <table class="table table-striped col-lg-12">
        <tr>
          <th class="col-lg-1">#</th>
          <th class="col-lg-4">Artist</th>
          <th class="col-lg-6">Title</th>
          <th class="col-lg-1">Duration</th>
        </tr>
        <tbody>
        @foreach($upcoming as $u)
          @foreach($song->getSongByID($u->songID)->get() as $track)
            <tr>
              <td>
                {{ $track->ID }}
              </td>
              <td>
                {{ $track->artist }}
              </td>
              <td>
                {{ $track->title }}
              </td>
              <td>
                {{ $helper->convertTime($track->duration) }}
              </td>
            </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
