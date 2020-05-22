							 <form id="shellAdd">
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="shell_host">Shell URL</label>
		<input type="text" name="shell_host" id="shell_host" class="form-control input-sm" placeholder="http://domain.com/path/file.php" required="">
	</div>
</div>
<div class="row">

<div class="col-md-3">
<table class="table ">
	<tbody><tr>
		<th>Price</th>
	</tr>
	<tr>
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
<div class="well well-sm col-md-6"><b>[Respone]</b><div id="result"></div></div>
<script type="text/javascript">
$("#shellAdd").submit(function() {
  $('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'shellAdd.html',
           data: $("#shellAdd").serialize(),
           success: function(data){
            $('button').prop('disabled', false);
            $("#result").html(data).show();
            var data = JSON.parse(data);
            if (data['result'] ==1){
				$('#shell_host').val('');
            }
            $("#result").html(data['text']).show();
            }

});

    return false; // avoid to execute the actual submit of the form.
});

</script>