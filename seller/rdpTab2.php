
<form id="rdpAdd">
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="rdp_host">Host/IP</label>
		<input type="text" name="rdp_host" id="rdp_host" class="form-control input-sm" placeholder="1.1.1.1" required="">
	</div>
</div>
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="rdp_login">Login</label>
		<input type="text" name="rdp_login" id="rdp_login" class="form-control input-sm" placeholder="admin" required="">
	</div>
	<div class="form-group col-lg-3 ">
		<label for="rdp_pass">Password</label>
		<input type="text" name="rdp_pass" id="rdp_pass" class="form-control input-sm" placeholder="abc123" required="">
	</div>
</div>
<div class="row">

<div class="col-md-6">
<table class="table ">
	<tbody><tr>
		<th>Access</th>
		<th>Windows</th>
		<th>RAM</th>
		<th>Price</th>
	</tr>
	<tr>
		<td>
			<select class="form-control input-sm" name="access" required="">
				<option selected="">USER</option>
				<option>ADMIN</option>
			</select>
		</td>
		<td>
		<select class="form-control input-sm" name="windows" required="">
				<option>ME</option>
				<option>2000</option>
				<option>XP</option>
				<option>2003</option>
				<option>Vista</option>
				<option>7</option>
				<option>8</option>
				<option>10</option>
				<option>2008</option>
				<option selected="">2012</option>
				<option>2016</option>

		</select>
		</td>
		<td><input placeholder="512MB/1GB/2GB" type="text" name="ram" class="form-control input-sm" required=""></td>
		<td><input placeholder="5" type="text" name="price" class="form-control input-sm" required=""></td>
	</tr>
</tbody></table>
</div>
<div class="form-group col-lg-10">
	<button type="submit" name="submit" class="btn btn-primary btn-md">Add  <span class="glyphicon glyphicon-indent-left"></span></button>
<input type="hidden" name="start" value="work" />

	</div>
</div>
</form>
<div class="row">
	<div class="well well-sm col-md-6" ><b>[Response]</b><div id="result"></div></div>
</div>
<script type="text/javascript">
$("#rdpAdd").submit(function() {
  $('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'rdpAdd.html',
           data: $("#rdpAdd").serialize(),
           success: function(data){
            $('button').prop('disabled', false);
            $("#result").html(data).show();
            var data = JSON.parse(data);
            if (data['result'] ==1){
				$('#rdp_host').val('');
				$('#rdp_login').val('');
				$('#rdp_pass').val('');
            }
            $("#result").html(data['text']).show();
            }

});

    return false; // avoid to execute the actual submit of the form.
});
</script>