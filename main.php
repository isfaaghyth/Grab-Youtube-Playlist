<?php
	set_time_limit(0);
	$playlist = $_REQUEST['id'];

	if ($playlist) {
		define("BASE_URL", "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=");
		define("PLAYLIST_ID", $playlist);
		define("API_KEY", "Developer Key");

		function printallpost($token = null){
			$posts = json_decode(file_get_contents(BASE_URL . PLAYLIST_ID . "&key=" . API_KEY . $token), true);
			foreach($posts['items'] as $v) {
				echo "https://www.youtube.com/watch?v=" . $v['snippet']['resourceId']['videoId']. "<br>";
				//versi json
				//echo json_encode(array("id" => $v['snippet']['resourceId']['videoId']));
			}
			if(array_key_exists('nextPageToken', $posts)){
				printallpost('&pageToken='. $posts['nextPageToken']);
			}
		}

		echo "<p><h3>Playlist Link:</h3></p>";

		printallpost();
	} else {
		echo "<p><h3>Mana playlist id nya om?</h3></p>";
	}
?>
