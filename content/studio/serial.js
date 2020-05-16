function lightStars(starCount) {
	for(i = starCount; i >= 1; i--) {
		$("[data-starcount='"+i+"']").addClass('lit');
	}
}

$(document).ready(function() {
	var code = $('#code').text();
	var serial = $('#serial').text();

	$('.star').hover(
		function() {
			$('#rating-stars').addClass('hovering');
			lightStars($(this).attr('data-starcount'));
		},
		function() {
			$('#rating-stars').removeClass('hovering');
			$("[data-starcount]").removeClass('lit');
		}
	);
	$('.star').click(
		function() {
			var rating = $(this).attr('data-starcount');
			$.getJSON(
				'/api/rate/'+code+'/'+serial,
				{ r: rating }
			)
			.done(function(data) {
				if(data.status == "OK") {
					$('#rating-stars').removeClass('hovering');
					$('#rating-stars').removeClass('no-rating');
					$('#rating-stars').removeClass('rating-1');
					$('#rating-stars').removeClass('rating-2');
					$('#rating-stars').removeClass('rating-3');
					$('#rating-stars').removeClass('rating-4');
					$('#rating-stars').removeClass('rating-5');
					$('#rating-stars .star').removeClass('lit');
					$('#rating-stars').addClass('rating-'+data.rating);
				}
			});
		}
	);
});