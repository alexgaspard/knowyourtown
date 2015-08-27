<!-- JavaScript -->

<!-- Intégration de la libraire jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!--<script src="js/jquery.js"></script>-->
<!-- Intégration de la libraire de composants de Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Script pour les images agrandies (voir http://twitter.github.io/bootstrap/javascript.html#modals) -->
<script src="js/bootstrap-modal.js"></script>
<!-- Intégration de la libraire de composants de Bootstrap LightBox pour les images agrandies (voir http://jbutz.github.io/bootstrap-lightbox) -->
<script src="js/bootstrap-lightbox.min.js"></script>
<!-- Intégration de la libraire de composants de Bootstrap pour les Togglable tabs (voir http://twitter.github.io/bootstrap/javascript.html#tabs) -->
<script src="js/bootstrap-tab.js"></script>
<script>
	$(function () {
	$('#myTab a:last').tab('show');
	})
</script>


<!-- Pour la lecture rapide -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-30570115-14', 'zolmeister.com');
	ga('send', 'pageview');

</script>
<script>
	//var a = document.getElementsByTagName('canvas')[0];
	var a = document.getElementById('c');
	//var b = document.body;
	var b = a.parentNode;
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

<!-- Pour l'édition d'article -->
<script type="text/javascript">
	function bbcode2xhtml(string) {
		var field = string;

		/*var smiliesName = new Array(':magicien:', ':colere:', ':diable:', ':ange:', ':ninja:', '&gt;_&lt;', ':pirate:', ':zorro:', ':honte:', ':soleil:', ':\'\\(', ':waw:', ':\\)', ':D', ';\\)', ':p', ':lol:', ':euh:', ':\\(', ':o', ':colere2:', 'o_O', '\\^\\^', ':\\-°');
	    var smiliesUrl  = new Array('magicien.png', 'angry.gif', 'diable.png', 'ange.png', 'ninja.png', 'pinch.png', 'pirate.png', 'zorro.png', 'rouge.png', 'soleil.png', 'pleure.png', 'waw.png', 'smile.png', 'heureux.png', 'clin.png', 'langue.png', 'rire.gif', 'unsure.gif', 'triste.png', 'huh.png', 'mechant.png', 'blink.gif', 'hihi.png', 'siffle.png');
	    var smiliesPath = "http://www.siteduzero.com/Templates/images/smilies/";*/

	    //field = field.replace(/&/g, '&amp;');
	    //field = field.replace(/"/g, '&quot;');
	    field = field.replace(/</g, '&lt;').replace(/>/g, '&gt;');
	    field = field.replace(/\n/g, '<br />').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
	    field = field.replace(/€/g, '&euro;').replace(/£/g, '&pound;').replace(/¥/g, '&yen;');
	    
	    //field = field.replace(/\[b\]([\s\S]*?)\[\/b\]/g, '<span class="bold">$1</span>');
	    field = field.replace(/\[b\]/g, '<span class="bold">').replace(/\[\/b\]/g, '</span>');
	    //field = field.replace(/\[i\]([\s\S]*?)\[\/i\]/g, '<span class="italic">$1</span>');
	    field = field.replace(/\[i\]/g, '<span class="italic">').replace(/\[\/i\]/g, '</span>');
	    //field = field.replace(/\[u\]([\s\S]*?)\[\/u\]/g, '<span class="underline">$1</span>');
	    field = field.replace(/\[u\]/g, '<span class="underline">').replace(/\[\/u\]/g, '</span>');

	    field = field.replace(/\[list=1\]([\s\S]*?)\[\*\]([\s\S]*?)\[\/list\]/g, '<ol><li>$2</li></ol>');
	    field = field.replace(/\[list\]([\s\S]*?)\[\*\]([\s\S]*?)\[\/list\]/g, '<ul><li>$2</li></ul>');
	    field = field.replace(/\[\*\]/g, '</li><li>');//\<br\/\>
	    //field = field.replace(/\[color=([\s\S]*?)\]([\s\S]*?)\[\/color\]/g, '<font color="$1">$2</font>');
	    field = field.replace(/\[color=([\s\S]*?)\]/g, '<font color="$1">').replace(/\[\/color\]/g, '</font>');
	    //field = field.replace(/\[url=([\s\S]*?)\[\/lien\]/g, '<a href="$1">$1</a>');
	    field = field.replace(/\[url\]([\s\S]*?)\[\/url\]/g, '<a href="$1">$1</a>');
	    field = field.replace(/\[url=www.([\s\S]*?)\]/g, '<a href="https://www.$1">');
	    field = field.replace(/\[url=([\s\S]*?)\]/g, '<a href="$1">').replace(/\[\/url\]/g, '</a>');
	    field = field.replace(/\[email\]([\s\S]*?)\[\/email\]/g, '<a href="mailto:$1">$1</a>');
	    //field = field.replace(/\[lien url="([\s\S]*?)"\]([\s\S]*?)\[\/lien\]/g, '<a href="$1" title="$2">$2</a>');
	    field = field.replace(/\[image\]([\s\S]*?)\[\/image\]/g, '<img src="$1" alt="Image" class="img-thumbnail" width="300px" />');
	    field = field.replace(/\[quote\]([\s\S]*?)\[\/quote\]/g, '<br /><span class="citation">Citation :</span><div class="citation2">$1</div>');
	    field = field.replace(/\[quote=\"([\s\S]*?)\"\]/g, '<br /><span class="citation">Citation : $1</span><div class="citation2">').replace(/\[\/quote\]/g, '</div>');
	    /*field = field.replace(/\[quote=\"(.*?)\"\]([\s\S]*?)\[\/quote\]/g, '<br /><span class="citation">Citation : $1</span><div class="citation2">$2</div>');
	    field = field.replace(/\[citation lien=\"(.*?)\"\]([\s\S]*?)\[\/citation\]/g, '<br /><span class="citation"><a href="$1">Citation</a></span><div class="citation2">$2</div>');
	    field = field.replace(/\[citation nom=\"(.*?)\" lien=\"(.*?)\"\]([\s\S]*?)\[\/citation\]/g, '<br /><span class="citation"><a href="$2">Citation : $1</a></span><div class="citation2">$3</div>');
	    field = field.replace(/\[citation lien=\"(.*?)\" nom=\"(.*?)\"\]([\s\S]*?)\[\/citation\]/g, '<br /><span class="citation"><a href="$1">Citation : $2</a></span><div class="citation2">$3</div>');
	    field = field.replace(/\[citation\]([\s\S]*?)\[\/citation\]/g, '<br /><span class="citation">Citation</span><div class="citation2">$1</div>');*/
	    //field = field.replace(/\[size=(.*?)\]([\s\S]*?)\[\/size\]/g, '<span style="font-size:$1px">$2</span>');
	    field = field.replace(/\[size=(.*?)\]/g, '<span style="font-size:$1px">').replace(/\[\/size\]/g, '</span>');
	    field = field.replace(/\[title=0\]([\s\S]*?)\[\/title\]/g, '$1');
	    field = field.replace(/\[title=1\]([\s\S]*?)\[\/title\]/g, '<h2>$1</h2>');
	    field = field.replace(/\[title=2\]([\s\S]*?)\[\/title\]/g, '<h3>$1</h3>');
	    field = field.replace(/\[title=3\]([\s\S]*?)\[\/title\]/g, '<h4>$1</h4>');


	    field = field.replace(/\[left\]([\s\S]*?)\[\/left\]/g, '<p class="text-left">$1</p>');
	    field = field.replace(/\[center\]([\s\S]*?)\[\/center\]/g, '<p class="text-center">$1</p>');
	    field = field.replace(/\[right\]([\s\S]*?)\[\/right\]/g, '<p class="text-right">$1</p>');
	    field = field.replace(/\[justify\]([\s\S]*?)\[\/justify\]/g, '<p class="text-justify">$1</p>');
	    
	    /*for (var i=0, c=smiliesName.length; i<c; i++) {
	        field = field.replace(new RegExp(" " + smiliesName[i] + " ", "g"), "&nbsp;<img src=\"" + smiliesPath + smiliesUrl[i] + "\" alt=\"" + smiliesUrl[i] + "\" />&nbsp;");
	    }*/

	    return field;
	}

	 function preview(textareaId, previewDiv) {
        var field = textareaId.value;
        if (field) {
            field = bbcode2xhtml(field);
		    field = '<div class="panel panel-default" style="margin:0px;"><div class="panel-body">'.concat(field).concat('</div></div>');
            document.getElementById(previewDiv).innerHTML = field;
        }
    }

	 function previewArticle(textareaId, previewDiv) {
        var field = textareaId.value;
        var elt = document.getElementById(textareaId);
    	var field = elt.innerText || elt.textContent;
        if (field) {
        	//alert("[g]blabla[/g]".replace(/\[g]([^\]]*)\[\/g]/gim,'<strong>$1<\/strong>'));

	    	//field = field.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
            field = bbcode2xhtml(field);
            document.getElementById(previewDiv).innerHTML = field;
        }
    }
</script>
