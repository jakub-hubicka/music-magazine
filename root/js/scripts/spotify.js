$('#spotifyPlayer').load('templates/spotify-playlists/playlist-1.html');

function showPlaylist(button, template) {
	button.click(function(){
		$('#spotifyPlayer').addClass('c-spotify__player--loading');
		$('#spotifyPlayer').load(template, function(){
			$('#spotifyPlayer iframe').attr('id', 'iframeId');
			$('#iframeId').on('load', function(){
				$('#spotifyPlayer').removeClass('c-spotify__player--loading');
			});
		});
		$('.c-spotify__playlist').removeClass('c-spotify__playlist--active');
		$(this).addClass('c-spotify__playlist--active');
	});
}

showPlaylist($('#playlist1'), 'templates/spotify-playlists/playlist-1.html');
showPlaylist($('#playlist2'), 'templates/spotify-playlists/playlist-2.html');
showPlaylist($('#playlist3'), 'templates/spotify-playlists/playlist-3.html');
showPlaylist($('#playlist4'), 'templates/spotify-playlists/playlist-4.html');