
    <div id="text_editor" class="text_editor well form-group" style="padding:0px; text-align:left;">
        <div class="form-inline">
            <input name="previsualisation" type="checkbox" class="checkbox" id="previsualisation" value="previsualisation" checked="true" />
            <label for="previsualisation">Prévisualisation automatique</label>

            <img src="<?php echo $img.'icons/text-left.png'; ?>" alt="text-left" onclick="insertTag('[left]','[/left]', 'textarea');" />
            <img src="<?php echo $img.'icons/text-center.png'; ?>" alt="text-center" onclick="insertTag('[center]','[/center]', 'textarea');" />
            <img src="<?php echo $img.'icons/text-right.png'; ?>" alt="text-right" onclick="insertTag('[right]','[/right]', 'textarea');" />
            <img src="<?php echo $img.'icons/text-justify.png'; ?>" alt="text-justify" onclick="insertTag('[justify]','[/justify]', 'textarea');" />
            <select class="form-control" onchange="insertTag('[size=' + this.options[this.selectedIndex].value + ']', '[/size]', 'textarea');">
                <option value="10">10</option>
                <option value="14" class="selected" selected>14</option>
                <option value="18">18</option>
                <option value="20">20</option>
                <option value="24">24</option>
                <option value="28">28</option>
            </select>
            <img src="<?php echo $img.'icons/bold.png'; ?>" height="25" alt="bold" onclick="insertTag('[b]','[/b]','textarea');" />
            <img src="<?php echo $img.'icons/italic.png'; ?>" height="25" alt="italic" onclick="insertTag('[i]','[/i]','textarea');" />
            <img src="<?php echo $img.'icons/underline.png'; ?>" height="25" alt="underline" onclick="insertTag('[u]','[/u]','textarea');" />
            <img src="<?php echo $img.'icons/ulist.png'; ?>" height="25" alt="ulist" onclick="insertTag('[list]\n[*]\n[*]\n[*]\n','[/list]','textarea');" />
            <img src="<?php echo $img.'icons/olist.png'; ?>" height="25" alt="olist" onclick="insertTag('[list=1]\n[*]\n[*]\n[*]\n','[/list]','textarea');" />
            <select class="form-control" onchange="insertTag('[color=' + this.options[this.selectedIndex].value + ']', '[/color]', 'textarea');">
                <option value="black" class="selected" selected>black</option>
                <option value="red">red</option>
                <option value="blue">blue</option>
                <option value="green">green</option>
                <option value="fuchsia">fuchsia</option>
            </select>
            <input type="button" value="Lien" onclick="insertTag('[url]','[/url]','textarea', 'url');" />
            <input type="button" value="Mail" onclick="insertTag('[email]','[/email]','textarea');" />
            <input type="button" value="Citation" onclick="insertTag('[quote]','[/quote]','textarea', 'quote');" />
            <input type="button" value="Image" onclick="insertTag('[image]','[/image]','textarea');" />
            <select class="form-control" onchange="insertTag('[title=' + this.options[this.selectedIndex].value + ']', '[/title]', 'textarea');">
                <option value="0" class="selected" selected>Aucun style</option>
                <option value="1">Titre 1</option>
                <option value="2">Titre 2</option>
                <option value="3">Titre 3</option>
            </select>
        </div>
            <textarea onkeyup="preview(this, 'previewDiv');" onselect="preview(this, 'previewDiv');" id="textarea" rows="10" name="article" class="form-control" placeholder="Article"><?php echo $contenu_edite; ?></textarea>
            
            <div id="previewDiv"></div>
    </div>
    
<?php
    if ($contenu_edite) 
    {   
?>          
        <script type="text/javascript">
            window.onload = function(){preview('textarea', 'previewDiv')};
        </script>
<?php
    }   
?>  



<script type="text/javascript">
    function preview(textareaId, previewDiv) {
        var field = textareaId.value;
        if (document.getElementById('previsualisation').checked && field) {
            field = bbcode2xhtml(field);
            /*
            var smiliesName = new Array(':magicien:', ':colere:', ':diable:', ':ange:', ':ninja:', '&gt;_&lt;', ':pirate:', ':zorro:', ':honte:', ':soleil:', ':\'\\(', ':waw:', ':\\)', ':D', ';\\)', ':p', ':lol:', ':euh:', ':\\(', ':o', ':colere2:', 'o_O', '\\^\\^', ':\\-°');
            var smiliesUrl  = new Array('magicien.png', 'angry.gif', 'diable.png', 'ange.png', 'ninja.png', 'pinch.png', 'pirate.png', 'zorro.png', 'rouge.png', 'soleil.png', 'pleure.png', 'waw.png', 'smile.png', 'heureux.png', 'clin.png', 'langue.png', 'rire.gif', 'unsure.gif', 'triste.png', 'huh.png', 'mechant.png', 'blink.gif', 'hihi.png', 'siffle.png');
            var smiliesPath = "http://www.siteduzero.com/Templates/images/smilies/";
        
            field = field.replace(/&/g, '&amp;');
            field = field.replace(/</g, '&lt;').replace(/>/g, '&gt;');
            field = field.replace(/\n/g, '<br />').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            
            field = field.replace(/&lt;gras&gt;([\s\S]*?)&lt;\/gras&gt;/g, '<strong>$1</strong>');
            field = field.replace(/&lt;italique&gt;([\s\S]*?)&lt;\/italique&gt;/g, '<em>$1</em>');
            field = field.replace(/&lt;lien&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1">$1</a>');
            field = field.replace(/&lt;lien url="([\s\S]*?)"&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1" title="$2">$2</a>');
            field = field.replace(/&lt;image&gt;([\s\S]*?)&lt;\/image&gt;/g, '<img src="$1" alt="Image" />');
            field = field.replace(/&lt;citation nom=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation">Citation : $1</span><div class="citation2">$2</div>');
            field = field.replace(/&lt;citation lien=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$1">Citation</a></span><div class="citation2">$2</div>');
            field = field.replace(/&lt;citation nom=\"(.*?)\" lien=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$2">Citation : $1</a></span><div class="citation2">$3</div>');
            field = field.replace(/&lt;citation lien=\"(.*?)\" nom=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$1">Citation : $2</a></span><div class="citation2">$3</div>');
            field = field.replace(/&lt;citation&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation">Citation</span><div class="citation2">$1</div>');
            field = field.replace(/&lt;taille valeur=\"(.*?)\"&gt;([\s\S]*?)&lt;\/taille&gt;/g, '<span style="font-size:$1px">$2</span>');


            field = field.replace(/&lt;left&gt;([\s\S]*?)&lt;\/left&gt;/g, '<p class="text-left">$1</p>');
            field = field.replace(/&lt;center&gt;([\s\S]*?)&lt;\/center&gt;/g, '<p class="text-center">$1</p>');
            field = field.replace(/&lt;right&gt;([\s\S]*?)&lt;\/right&gt;/g, '<p class="text-right">$1</p>');
            field = field.replace(/&lt;justify&gt;([\s\S]*?)&lt;\/justify&gt;/g, '<p class="text-justify">$1</p>');
            
            for (var i=0, c=smiliesName.length; i<c; i++) {
                field = field.replace(new RegExp(" " + smiliesName[i] + " ", "g"), "&nbsp;<img src=\"" + smiliesPath + smiliesUrl[i] + "\" alt=\"" + smiliesUrl[i] + "\" />&nbsp;");
            }
            var start = '<div class="panel panel-default" style="margin:0px;"><div class="panel-body">';
            field = start.concat(field);
            field = field.concat('</div></div>');
            */
            document.getElementById(previewDiv).innerHTML = field;
        }
    }

    function insertTag(startTag, endTag, textareaId, tagType) {
        var field  = document.getElementById(textareaId); 
        var scroll = field.scrollTop;
        field.focus();
        
        /* === Partie 1 : on récupère la sélection === */
        if (window.ActiveXObject) {
                var textRange = document.selection.createRange();            
                var currentSelection = textRange.text;
        } else {
                var startSelection   = field.value.substring(0, field.selectionStart);
                var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
                var endSelection     = field.value.substring(field.selectionEnd);               
        }
        
        /* === Partie 2 : on analyse le tagType === */
        if (tagType) {
                switch (tagType) {
                        case "url":
                            endTag = "[/url]";
                            if (currentSelection) 
                            { // Il y a une sélection
                                    if (currentSelection.indexOf("http://") == 0 || currentSelection.indexOf("https://") == 0 || currentSelection.indexOf("ftp://") == 0 || currentSelection.indexOf("www.") == 0) 
                                    {
                                            // La sélection semble être un lien. On demande alors le libellé
                                            //var label = prompt("Quel est le libellé du lien ?") || "";
                                            //startTag = "[url=" + currentSelection + "]";
                                            //currentSelection = label;
                                            startTag = "[url]";
                                    } else 
                                    {
                                            // La sélection n'est pas un lien, donc c'est le libelle. On demande alors l'URL
                                            var URL = prompt("Quelle est l'url ?");
                                            startTag = "[url=" + URL + "]";
                                    }
                            } else 
                            { // Pas de sélection, donc on demande l'URL et le libelle
                                    var URL = prompt("Quelle est l'url ?") || "";
                                    //var label = prompt("Quel est le libellé du lien ?") || "";
                                    startTag = "[url=" + URL + "]" + URL;
                                    //currentSelection = label;                     
                            }
                        break;
                        case "quote":
                            endTag = "[/quote]";
                            if (currentSelection) { // Il y a une sélection
                                    if (currentSelection.length > 30) 
                                    { // La longueur de la sélection est plus grande que 30. C'est certainement la citation, le pseudo fait rarement 20 caractères
                                            var auteur = prompt("Quel est l'auteur de la citation ?") || "";
                                            startTag = "[quote=\"" + auteur + "\"]";
                                    } else 
                                    { // On a l'Auteur, on demande la citation
                                            var citation = prompt("Quelle est la citation ?") || "";
                                            startTag = "[quote=\"" + currentSelection + "\"]";
                                            currentSelection = citation;    
                                    }
                            } else 
                            { // Pas de selection, donc on demande l'Auteur et la Citation
                                    var auteur = prompt("Quel est l'auteur de la citation ?") || "";
                                    var citation = prompt("Quelle est la citation ?") || "";
                                    startTag = "[quote=\"" + auteur + "\"]";
                                    currentSelection = citation;    
                            }
                        break;
                }
        }
        
        /* === Partie 3 : on insère le tout === */
        if (window.ActiveXObject) {
                textRange.text = startTag + currentSelection + endTag;
                textRange.moveStart("character", -endTag.length - currentSelection.length);
                textRange.moveEnd("character", -endTag.length);
                textRange.select();     
        } else {
                field.value = startSelection + startTag + currentSelection + endTag + endSelection;
                field.focus();
                field.setSelectionRange(startSelection.length + startTag.length, startSelection.length + startTag.length + currentSelection.length);
        } 

        field.scrollTop = scroll;    

        preview(textareaId, 'previewDiv'); 
    }
</script>