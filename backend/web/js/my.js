


$(function(){
	$('.show-images').click(function(){
		$('#root').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	})
})

/*$(function(){
	$('.create-unit').click(function(e){

		e.preventDefault();
		$('#unit').modal('show')
					.find('#modalContent')
					.load($(this).attr('href'));
	});
})*/

/*$(function(){
	$('.create-unit').click(function(e){
		
		$('#unit').modal('show')
					.find('#modalContent')
					.load($(this).attr('data-url'));
	});
})*/


$(document).on({
	ready: function(){
		return $('body').on('click', '.create-unit', function(e){
			e.preventDefault();
			$('#unit').modal('show')
					.find('#modalContent')
					.load($(this).attr('href'));
		})
	}
})


$(document).on({
	ready: function(){
		return $('body').on('click', '.modalLink', function(e){
			e.preventDefault();
			$('#alert-message').css('display', 'none').removeClass();
			$('#root').modal('show')
					.find('#modalContent')
					.load($(this).attr('data-attribute-url'));
		})
	}
})

$(document).on({
	ready:function(){
		return $('body').on('click', '.btn-create', function(){
			$('#alert-message').css('display', 'none').removeClass();
			$('#root').modal('show')
					.find('#modalContent')
					.load($(this).attr('data-attribute-url'));
		})
			
	}
})

$(document).on({
	ready: function(){
		return $('body').on('click', '.modal-update', function(e){
			e.preventDefault();
			$('#marka').modal('show')
					.find('#modalContent')
					.load($(this).attr('href'));
		})
	}
})











