<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-30570115-14', 'zolmeister.com');
	ga('send', 'pageview');

</script>
<canvas id="c"></canvas>
<script>
	var a = document.getElementsByTagName('canvas')[0];
	var b = document.body;
	var d = function(e){ return function(){ e.parentNode.removeChild(e); }; }(a);
	// unprefix some popular vendor prefixed things (but stick to their original name)
	var AudioContext =
		window.AudioContext ||
		window.webkitAudioContext;
	var requestAnimationFrame =
		window.requestAnimationFrame ||
		window.mozRequestAnimationFrame ||
		window.webkitRequestAnimationFrame ||
		window.msRequestAnimationFrame ||
		function(f){ setTimeout(f, 1000/30); };
	// stretch canvas to screen size (once, wont onresize!)
	a.style.width = (a.width = innerWidth) + 'px';
	a.style.height = (a.height = innerHeight) + 'px';

	var c = a.getContext('2d');
</script>
<script src='js/main.js'>
</script>