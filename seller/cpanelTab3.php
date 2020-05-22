
<form  method="POST" action="cpanelMass.html" target="myifram">

	<label for="text">cPanel List:</label>
	<textarea name="inputs" class="form-control " rows="3" placeholder="http://www.website.com:2082/|username|password"></textarea>
<br>
<div class="col-md-3">
<table class="table ">
	<tbody><tr>
		<th>Price</th>
	</tr>
	<tr>
		<td><input placeholder="5" type="text" name="price" class="form-control input-sm" required=""></td>
	</tr>
</tbody></table>


<div class="col-lg-10">
<button type="submit" name="submit" class="btn btn-primary ">Add  <span class="glyphicon glyphicon-indent-left"></span></button>
<input type="hidden" name="start" value="work" />

</div>
</form>
</div>
<iframe style="border:none" width="100%" height="100%" scrolling="yes" name="myifram" id="myifram" src="cpanelMass.html"></iframe>