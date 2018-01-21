$("#imgFile").change(function()
{
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				
				$('#preview').attr('src', e.target.result);	//previews image	
			}
			reader.readAsDataURL(this.files[0]);
	}
});