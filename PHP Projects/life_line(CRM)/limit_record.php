<?php
if ( isset( $_REQUEST[ 'limit' ] ) ) {

  $limit = $_REQUEST[ 'limit' ];
  if ( $limit > 0 ) {
    $limit = " LIMIT " . $limit;
  } else {
    $limit = " ";
  }

} else {
  ?>
<script>
var limit=prompt("How Many Records To Display? Cancel For All Records");
//    if (isNaN(limit)) {
//    limit = 0;
//}
  //  limit=parseInt(limit);

var currentURL = window.location.href;
    
    var limitstring;
    if (window.location.search) {
        limitstring="&limit="+limit;
} else {
    
        limitstring="?limit="+limit;
}

    
    currentURL=currentURL+limitstring;
//    alert(currentURL);
    window.location.href=currentURL;
</script>
<?php
}