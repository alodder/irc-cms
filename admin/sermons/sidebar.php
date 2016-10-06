<ul id="subTools">
    <li>
    	<a href="javascript:;" onclick = "sendRequest('sermons/insertform.php', null, 'GET', 'palette2');" style="background: url('images/icons/cset/24/add.png') no-repeat; background-position:left; padding:24px"> New Entry</a>
    </li>
    <li>
    	<a href="javascript:;" onclick = "sendRequest('sermons/mp3up_form.php', null, 'GET', 'palette');" style="background: url('images/icons/cset/24/add_page.png') no-repeat; background-position:left; padding:24px"> Upload .mp3</a>
    </li>
</ul>
 
<form action="<? echo $_SERVER['PHP_SELF']?>" class="selectfield" title="Sort results">
    <fieldset>
        <input type="hidden" name="articles" value="sermons" />
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort">
            <?
            foreach ($fielders as $key => $value) { 
                echo '<option value="'.$key.'"';
                if ($key==$sort){
                    echo ' selected="selected">'.$value.'</option>';
                } else {
                    echo '>'.$value.'</option>';
                }
            }
            ?>
        </select>
        <label for="order">Order:</label>
        <select name="order" id="order">
            <?
            foreach ($orders as $key => $value) { 
                echo '<option value="'.$key.'"';
                if ($key==$order){
                    echo ' selected="selected">'.$value.'</option>';
                } else {
                    echo '>'.$value.'</option>';
                }
            }
            ?>
        </select>
        <input type="hidden" value="<? echo $search; ?>" name="search" />
        <input type="submit" value="Sort" class="searchbutton"/>
    </fieldset>
</form>
<form  action="<? echo $_SERVER['PHP_SELF']?>" class="searchfield" title="Search all sermons">
    <fieldset>
        <input type="hidden" value="sermons" name="articles" />
        <input type="hidden" value="<? echo $sort; ?>" name="sort" />
        <input type="hidden" value="<? echo $order; ?>" name="order" />
        <img src="images/icons/cset/24/search.png" />
        <input type="search" placeholder="Search Sermons" name="search" id="search" value="<? echo $search; ?>" />
        <input type="submit" value="Search" class="searchbutton" />
    </fieldset>
</form>
<a name="palette"></a>
<div id="palette"></div>
<iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;" >
</iframe>
<div id="palette2">
	
</div>