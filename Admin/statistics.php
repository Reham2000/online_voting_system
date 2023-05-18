<?php

include "includes/header.php";
include "App/Http/Middlewares/Auth.php";
include "includes/navbar.php";
include "includes/sidebar.php";

use App\Database\Models\User;
use App\Database\Models\Vote;
use App\Database\Models\Admin;
use App\Database\Models\Message;

$admin = new Admin;
$user = new User;
$vote = new Vote;
$message = new Message;

// Users
$active = $user->activeNum()->fetch_array();
$not_active = $user->notActiveNum()->fetch_array();
// votes
$votes = $vote->statistics()->fetch_all();
$votesName = array_column($votes,0);
$votesLike = array_column($votes,1);
$votesDislike = array_column($votes,2);
// Messages
$repliedNum = $message->repliedNum()->fetch_array();
$notRepliedNum = $message->notRepliedNum()->fetch_array();

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Statistics</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Statistics</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- chart js -->
      <div class="row justify-content-around">
        <div class="col-lg-4 col-md-6 col-sm-6 mb-5">
          <p class="text-center">Users</p>
          <canvas id="users"></canvas>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 mb-5">
          <p class="text-center">Messages</p>
          <canvas id="messages"></canvas>
        </div>
        <div class=" col-md-6 col-sm-6 mb-5">
          <p class="text-center">Votes</p>
          <canvas id="votes"></canvas>
        </div>
      </div>
      <!-- ./chart js -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  const user = document.getElementById('users');
  const vote = document.getElementById('votes');
  const message = document.getElementById('messages');

  const userData = {
    labels: [
      'Not Active',
      'Active'
    ],
    datasets: [{
      label: 'Users ',
      data: [ <?= $not_active[0] ?> , <?= $active[0] ?> ],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)'
      ],
      hoverOffset: 4
    }]
  };
  new Chart(user, {
    type: 'doughnut',
    data: userData,
  });


  // votes chart
  const voteData = {
    labels: <?= json_encode($votesName) ?>,
    datasets: [{
      label: 'Like',
      data:  <?= json_encode($votesLike) ?>  ,
      backgroundColor: [
        'rgba(153, 102, 255, 0.2)',
      ],
      borderColor: [
        'rgb(153, 102, 255)',
      ],
      borderWidth: 2,
      hoverOffset: 4
    },
    {
      label: 'Dislike',
      data:  <?= json_encode($votesDislike) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
      ],
      borderColor: [
        'rgb(255, 99, 132)',
      ],

      borderWidth: 2,
      hoverOffset: 4
    }
  ]
  };
  new Chart(vote, {
    type: 'bar',
    data: voteData,
    options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
  });


  // messages chart
  const messageData = {
    labels: [
      'Replied Messages',
      'Not Replied Messages'
    ],
    datasets: [{
      label: 'Messages ',
      data: [ <?= $repliedNum[0] ?> , <?= $notRepliedNum[0] ?> ],
      backgroundColor: [
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)'
      ],
      hoverOffset: 4
    }]
  };
  new Chart(message, {
    type: 'doughnut',
    data: messageData,
  });

</script>

<?php


include "includes/footer.php";
