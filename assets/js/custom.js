$(document).ready(function(){

	hidealert(3);
	star_rating();

	$(document).on('focus mousedown', '.input-daterange', function(){
		
		var tags = $(this).find('input');
		$.each(tags, function(key, value){
			$(value).attr('autocomplete', 'off');
		});

		$(this).datepicker({
			format: "dd-mm-yyyy",
		    weekStart: 0,
		    multidate: false,
		    startDate: "+infinity",
		    autoclose: true
		});
	});


	$(document).on('focus', '.datepicker', function(){
		$(this).trigger('mousedown');
	});

});

	function star_rating()
	{
		var str = '';
		str += '<span class="fa fa-star-o m-1" data-value="1"></span>';
		str += '<span class="fa fa-star-o m-1" data-value="2"></span>';
		str += '<span class="fa fa-star-o m-1" data-value="3"></span>';
		str += '<span class="fa fa-star-o m-1" data-value="4"></span>';
		str += '<span class="fa fa-star-o m-1" data-value="5"></span>';

		$('.star-rating').html(str);


		$('.star-rating').on('click', '.fa', function(){
			var num = $(this).data('value');
			var parent = $(this).parent();

			parent.parent().find('input').val(selected);
			var array = $(this).parent().find('.fa');
			var color = (selected == 1)? '#d8000c' : (selected == 2)? '#ff730f' : (selected == 3)? '#ffc217' : (selected == 4)? '#babd06' : (selected == 5)? '#4f8a10' : '';
			$.each(array, function(key,value){
				var data = $(value).data('value');
				if(selected >= data)
				{
					$(value).removeClass('fa-star-o').addClass('fa-star').css('color', color);
				}
				else
				{
					$(value).removeClass('fa-star').addClass('fa-star-o').css('color', '');
				}
			});
		});
	}

	function star_for_view(num)
	{
		var color = (num == 1)? '#d8000c' : (num == 2)? '#ff730f' : (num == 3)? '#ffc217' : (num == 4)? '#babd06' : (num == 5)? '#4f8a10' : '';
		var str = '';
		for(var i=1; i<=5; i++)
		{
			if( i <= num)
			{
				str += '<span class="fa fa-star m-1" style="color:'+color+'"></span>';
			}
			else
			{
				str += '<span class="fa fa-star-o m-1"></span>';
			}
		}
		return str;
	}


	function hidealert(seconds)
	{
		$('#alert').ready(function(){
			setTimeout(function(){
				$('#alert').slideUp("normal", function(){
					$(this).remove();
				});
			},seconds*1000);
		});
	}

	function page_reload(seconds)
	{
		setTimeout(function(){
		window.location.reload();
		}, seconds*1000);
	}


	function showdatepicker(tag_id)
	{
		$('#'+tag_id).attr('autocomplete', 'off');
		$('#'+tag_id).datepicker({
			format: "dd-mm-yyyy",
		    weekStart: 0,
		    endDate: "+infinity",
		    multidate: false,
		    autoclose: true
		});		
	}			


	function validateForm(form_name, mode)
	{
		 
		$('#'+form_name).append('<input type="hidden" name="mode" value="'+mode+'"/>');

		
		$(document).on('submit', '#'+form_name , function(e){					

			$(this).find('[validate="true"]').each(function(key, value){
				var node = $(this).parent().parent().find('#message_for_'+$(this).attr('id'));
				if($(this).val() == '')
				{
					e.preventDefault();
					$(this).css('box-shadow', '#a94442 0px 0px 2px 2px');
					node.html(node.attr('msg')).addClass('text-danger');
				}
				else
				{
					$(this).css('box-shadow', '');
					node.html('').removeClass('text-danger');
				}
			});			
		});				
	}


	function validateFormAjax(form_name)
	{
		var error = 0;
		$('#'+form_name).find('[validate="true"]').each(function(key, value){
			var node = $(this).parent().parent().find('#message_for_'+$(this).attr('id'));
			if($(this).val() == '')
			{
				$(this).css('box-shadow', '#a94442 0px 0px 2px 2px');
				node.html(node.attr('msg')).addClass('text-danger');
				error += 1;
			}
			else
			{
				$(this).css('box-shadow', '');
				node.html('').removeClass('text-danger');
			}
		});

		return error;				
	}



	function validDate(value)
	{
		var date = new Date(value);
		if(date != 'Invalid Date' && !isNaN(date))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function scroll_to_top() {
		$('html, body').animate({scrollTop:0}, '20');
	  /*document.body.scrollTop = 0;
	  document.documentElement.scrollTop = 0;*/
	}

	function redirect_post(url, data) {
	    var form = document.createElement('form');
	    document.body.appendChild(form);
	    form.method = 'post';
	    form.action = url;
	    for (var name in data) {
	        var input = document.createElement('input');
	        input.type = 'hidden';
	        input.name = name;
	        input.value = data[name];
	        form.appendChild(input);
	    }
	    form.submit();
	}