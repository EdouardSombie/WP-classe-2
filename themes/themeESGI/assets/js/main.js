$(document).ready(function(){
	$('.page-numbers').click(function(e){
		e.preventDefault();

		const currentPage = Number($('.page-numbers.current').html());
		var page;
		if($(this).hasClass('next')){
			page = currentPage + 1;
		}
		else if($(this).hasClass('prev')){
			page = currentPage - 1;
		}
		else{
			page = Number($(this).html());
		}
		showPage(page);

	})
})


function showPage(page, nextState, nextTitle, nextURL){
	$.ajax({
		url: esgi.ajaxURL,
		type: 'POST',
		data: {
			'action': 'load_posts',
			'page' : page,
			'base' : esgi.urlBase
		}
	}).done(function(reponse){
		$('#post-list-wrapper').html(reponse);
		ajaxizepaginationLinks()
		window.history.replaceState(nextState, nextTitle, nextURL);
	})
}


function ajaxizepaginationLinks(){
	var page = 1;
	$('.page-numbers').click(function(e){
		e.preventDefault();
		var currentPage = $('.page-numbers.current').html();
		if($(this).hasClass('next')){
			page = Number(currentPage) + 1;
		}
		else if($(this).hasClass('prev')){
			page = Number(currentPage) - 1;
		}
		else{
			page = $(this).html();
		}
		

		// mise à jour de l'url
		const nextState = {};
		const nextTitle = 'Page - ' + page;
		const nextURL = $(this).attr('href');
		showPage(page, nextState, nextTitle, nextURL);
	})
}

