
<script src="//cdn.webrtc-experiment.com/socket.io.js"> </script>
<script src="//cdn.webrtc-experiment.com/RTCPeerConnection-v1.5.js"> </script>
<script src="//cdn.webrtc-experiment.com/video-conferencing/conference.js"> </script>

<button id="setup-new-room">Setup New Conference</button>
<table style="width: 100%;" id="rooms-list"></table>
<div id="videos-container"></div>

<script>
var config = {
	openSocket: function (config) {
		// http://socketio-over-nodejs.hp.af.cm/
		// http://socketio-over-nodejs.nodejitsu.com:80/
		// http://webrtc-signaling.nodejitsu.com:80/

		var SIGNALING_SERVER = 'https://webrtc-signaling.nodejitsu.com:443/',
		defaultChannel = location.href.replace(/\/|:|#|%|\.|\[|\]/g, '');

		var channel = config.channel || defaultChannel;
		var sender = Math.round(Math.random() * 999999999) + 999999999;

		io.connect(SIGNALING_SERVER).emit('new-channel', {
			channel: channel,
			sender: sender
		});

			var socket = io.connect(SIGNALING_SERVER + channel);
			socket.channel = channel;
			socket.on('connect', function () {
				if (config.callback) config.callback(socket);
			});

				socket.send = function (message) {
					socket.emit('message', {
						sender: sender,
						data: message
					});
				};

				socket.on('message', config.onmessage);
	},
	onRemoteStream: function (media) {
		var video = media.video;
		video.setAttribute('controls', true);
		video.setAttribute('id', media.stream.id);
		videosContainer.insertBefore(video, videosContainer.firstChild);
		video.play();
	},
	onRemoteStreamEnded: function (stream) {
		var video = document.getElementById(stream.id);
		if (video) video.parentNode.removeChild(video);
	},
	onRoomFound: function (room) {
		var alreadyExist = document.querySelector('button[data-broadcaster="' + room.broadcaster + '"]');
		if (alreadyExist) return;

		var tr = document.createElement('tr');
		tr.innerHTML = '<td><strong>' + room.roomName + '</strong> shared a conferencing room with you!</td>' +
		'<td><button class="join">Join</button></td>';
		roomsList.insertBefore(tr, roomsList.firstChild);

		var joinRoomButton = tr.querySelector('.join');
		joinRoomButton.setAttribute('data-broadcaster', room.broadcaster);
		joinRoomButton.setAttribute('data-roomToken', room.broadcaster);
		joinRoomButton.onclick = function () {
			this.disabled = true;

			var broadcaster = this.getAttribute('data-broadcaster');
			var roomToken = this.getAttribute('data-roomToken');
			captureUserMedia(function () {
				conferenceUI.joinRoom({
					roomToken: roomToken,
					joinUser: broadcaster
				});
			});
		};
	}
};

var conferenceUI = conference(config);
var videosContainer = document.getElementById('videos-container') || document.body;
var roomsList = document.getElementById('rooms-list');

document.getElementById('setup-new-room').onclick = function () {
	this.disabled = true;
	captureUserMedia(function () {
		conferenceUI.createRoom({
			roomName: 'Anonymous'
		});
	});
};

function captureUserMedia(callback) {
	var video = document.createElement('video');
	video.setAttribute('autoplay', true);
	video.setAttribute('controls', true);
	videosContainer.insertBefore(video, videosContainer.firstChild);

	getUserMedia({
		video: video,
		onsuccess: function (stream) {
			config.attachStream = stream;
			video.setAttribute('muted', true);
			callback();
		}
	});
}
</script>
<?php
/*
$this->db->where("user_data !=","");
$a = $this->db->get("ci_sessions");
$b = array();
$i = 1;
foreach($a->result() as $row){
		$custom_data[$i] = unserialize($row->user_data);
		//print_r($custom_data);
		//echo "<br/><br/><br/>";
$i++;
}
echo $custom_data[1]['clinic_name']."<br/>";
echo $custom_data[2]['clinic_name']."<br/>";

$val=$this->db->get("sms_setting")->row();
$senderiD=$val->sender_id;
$authkey=$val->auth_key;
	
$this->load->helper("sms");
$msg =	"Congradulations new branch is added with the user id 10005 and password 12563";
$fmobile = "8382829593";
sms($authkey,$msg,$senderiD,$fmobile);





// old server mysql id
$DBIUser = 'someuser';
$DBIPass = 'thepassword';

// new server mysql id
$NewUser = 'someloser';
$NewPass = 'thepassword';

// server names
$oldServer = 'my crappy old mysql server domain';
$newServer = 'localhost';

if ($argv[0] > " ")
{
	$dbname = $argv[1];
	echo "Starting copy of the $argv[1] database.\n";
	$dbpre = mysql_connect($oldServer, $DBIUser, $DBIPass);
	mysql_select_db($dbname, $dbpre);
	$sql = "SHOW TABLES FROM $dbname";
	echo $sql."\n";
	$result = mysql_query($sql);

	if (!$result)
	{
	echo "DB Error, could not list tables\n";
	    echo 'MySQL Error: ' . mysql_error();
	    		exit;
	}

	$dbtbl = mysql_connect($oldServer, $DBIUser, $DBIPass);
	mysql_select_db($dbname, $dbpre);
	$dbnew = mysql_connect($newServer, $NewUser, $NewPass);
	mysql_select_db("mysql", $dbnew);

	$res2 = mysql_query("CREATE DATABASE IF NOT EXISTS ".$dbname,$dbnew);
    if (!$res2)
	{
	echo "DB Error, could not create database\n";
		    echo 'MySQL Error: ' . mysql_error();
		    exit;
	}
	mysql_select_db($dbname, $dbnew);


	if($result === FALSE)
	{
	die(mysql_error());
}

$f = fopen($dbname.'.log', 'w');
fwrite($f, "Copy all tables in database $dbname on server $oldServer to new database on server $newServer.\n\n");
while ($row = mysql_fetch_row($result))
{
echo "Table: {$row[0]}\n";
fwrite($f, "Table ".$row[0]."\n");
		$tableinfo = mysql_fetch_array(mysql_query("SHOW CREATE TABLE $row[0]  ",$dbtbl));
		$createsyntax = "CREATE TABLE IF NOT EXISTS ";
		$createsyntax .= substr($tableinfo[1], 13);

		//echo $row[0]."\n";

		mysql_query(" $createsyntax ",$dbnew);


		$res = mysql_query("SELECT * FROM $row[0]  ",$dbpre); // select all rows
		$oldcnt = mysql_num_rows($res);
				echo "Count: ".$oldcnt." - ";

		$errors = 0;
		while ($roz = mysql_fetch_array($res, MYSQL_ASSOC) )
		{
		$query =  "INSERT INTO $dbname.$row[0] (".implode(", ",array_keys($roz)).") VALUES (";
		$cnt = 0;
		foreach (array_values($roz) as $value)
		{
		if ($cnt == 0)
		{
			$cnt++;
		} else
		{
		$query .= ",";
		}
		$query .= "'";
		$query .= mysql_real_escape_string($value);
		$query .= "'";

		}
		$query .= ")";

		$look = mysql_query($query,$dbnew);
		if ($look === false)
		{
		// write insert to log on error
		$errors = $errors + 1;
		fwrite($f, mysql_error()." - ".$query."\n");
		}

		}
		$sql = "select count(*) as cnt from $dbname.$row[0] ";
			$res = mysql_query($sql, $dbnew);
			$roz = mysql_fetch_array($res);
			echo $roz['cnt']." - Errors: ".$errors."\n";
			fwrite($f, "Old Record Count: ".$oldcnt." - New Record Count: ".$roz['cnt']." - Errors: ".$errors."\n");
			fwrite($f,"End table copy for table $row[0].\n\n");

}
fclose($f);


} else
{
var_dump($argv);


  }



  ?>
?>
*/