
<style type="text/css">
	.mapTooltip {
		position:fixed;
		background-color : #fff;
		moz-opacity:0.70;
		opacity: 0.70;
		filter:alpha(opacity=70);
		border-radius:10px;
		padding : 10px;
		z-index: 1000;
		max-width: 200px;
		display:none;
		color:#343434;
	}
	
	.zoomIn, .zoomOut {
		background-color:#fff;
		border:1px solid #ccc;
		color:#000;
		width:15px;
		height:15px;
		line-height: 15px;
		text-align:center;
		border-radius:3px;
		cursor:pointer;
		position:absolute;
		top : 10px;
		font-weight:bold;
		left : 10px;
		
		-webkit-user-select: none; // For Webkit
		-khtml-user-select: none;
		-moz-user-select: none; // For Mozilla
		-o-user-select: none;
		user-select: none; // Default
	}
	
	.zoomOut {
		top:30px;
	}
	
	.map {
		position:relative;
	}
	
</style>

<div class="container">

	<div class="maparea">
		<div class="map">
			<div class="row"><div class="col-md-3 col-md-offset-4"><img src="img/loading_icon.gif" /></div></div>
		</div>
	</div>
	
</div>

<!--<script src="http://code.jquery.com/jquery-1.9.1.min.js" charset="utf-8" ></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="js/raphael/raphael-min.js" charset="utf-8" ></script>
<script src="js/jquery.mapael.js" charset="utf-8" ></script>
<script src="js/maps/world_countries.js" charset="utf-8" ></script>
<script type="text/javascript">
	$(function(){

		$(".maparea").mapael({
			map : {
				name : "world_countries",
				defaultArea: {
					attrs : {
						stroke : "#fff", 
						"stroke-width" : 1,
					},
	                eventHandlers : {
	                    click : function(e, id, mapElem, textElem) {
	                    	//alert(id);
	                        window.open('pays.php?id_pays='+id,'_self');
	                        /*
	                        _blank - URL is loaded into a new window. This is default
							_parent - URL is loaded into the parent frame
							_self - URL replaces the current page
							_top - URL replaces any framesets that may be loaded
							*/
	                    }
	                }
				}
			}
		});
	});
</script>
<!-- Intégration de la libraire de composants de Bootstrap -->
<script src="js/bootstrap.min.js"></script>

