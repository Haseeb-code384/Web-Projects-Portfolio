<style>
.content-wrapper
    {
        visibility: hidden;
    }
   .content-wrapper {
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

    </style>
<script>window.addEventListener("load", function() {
  setTimeout(function() {
    document.querySelector(".content-wrapper").style.opacity = 1;
  }, 0);
});
	function loadcntnt()
		{
			document.getElementById("preloader").style.display="none";
		
            const collection = document.getElementsByClassName("content-wrapper");
for (let i = 0; i < collection.length; i++) {
  collection[i].style.visibility="visible";
}
		//	document.getElementById("cntnt").style.visibility="visible";
			
		}
	</script>

<div id="preloader" style="margin-top: 10%;">
	<center>
	<img src="img/loading.gif" style="width: 200px; vertical-align: middle;">
	</center>
	
	</div>

<body   onLoad="loadcntnt();">