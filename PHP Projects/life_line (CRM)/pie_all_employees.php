
<?php 

  $query = $con->query("SELECT count(*) AS 'val',district AS 'label' FROM `inquiry` where district!='' GROUP BY district  
ORDER BY `val`  DESC");

  foreach($query as $datas)
  {
    $labelp[] = $datas['label'];
    $valp[] = $datas['val'];
  }

?>


  <canvas id="mypresent"></canvas>

 
<script>
  // === include 'setup' then 'config' above ===
  var labels = <?php echo json_encode($labelp) ?>;
  var    data = {
    labels: labels,
    datasets: [{
      label: 'employees',
      data: <?php echo json_encode($valp) ?>,
      backgroundColor: ["#F7464A", "#E2EAE9", "#961eb0", "#949FB1", "#4D5360", "#FF6600", "#4081BD", "#64992C", "#956188", "#DC6D7F", "#415E9B", "#C50000", "#873e23","#1e81b0","#092735"
      ],
      borderColor: ["#F7464A", "#E2EAE9", "#961eb0", "#949FB1", "#4D5360", "#FF6600", "#4081BD", "#64992C", "#956188", "#DC6D7F", "#415E9B", "#C50000", "#873e23","#1e81b0","#092735"
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
       options: {
        plugins: {
            legend: {
                display: true,position:'bottom',
                
            }
        }
    }
      
  };

  var myChart = new Chart(
    document.getElementById('mypresent'),
    config
  );
</script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="js/scripts.js"></script>
	<script src="vendor/chart.js/Chart.min.js" crossorigin="anonymous"></script>
	<script src="demo/chart-area-demo.js"></script>
	<script src="demo/chart-bar-demo.js"></script>
</body>
</html>