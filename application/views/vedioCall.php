<html><head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="https://rawgithub.com/openpeer/webrtc-shim/v0.1.2/webrtc-shim.js"></script>
</head><body>

<div class="view view-callcontrol">

    <table class="flow">
        <tr>
            <th>Pushpendra Kumar</th>
            <td rowspan="4" class="internet"></td>
            <th>Rahul Singh</th>
        </tr>
        <tr>
            <td class="video">
                <div>
                    <video id="alice_localVideo" class="local" autoplay="autoplay" muted="true"></video>
                    <video id="alice_remoteVideo" class="remote" autoplay="autoplay"></video>
                </div>
            </td>
            <td class="video">
                <div>
                    <video id="bob_localVideo" class="local" autoplay="autoplay" muted="true"></video>
                    <video id="bob_remoteVideo" class="remote" autoplay="autoplay"></video>
                </div>
            </td>
        </tr>
        <tr>
            <td><button onclick="call()">Call</button> <button onclick="hangupOffer()">Hangup</button></td>
            <td><button onclick="accept()">Accept</button> <button onclick="decline()">Decline</button></td>
        </tr>
        <tr>
            <td><button onclick="hangup()">Hangup</button></td>
            <td><button onclick="hangup()">Hangup</button></td>
        </tr>
    </table>

</div>

<div class="footer"><a href="javascript:fullscreen()">Fullscreen</a></div>

<script>
$('BUTTON').attr('disabled','disabled');
$('TD.video > DIV').hide();
enableButtons([ 'call' ]);
function fail(err) {
    console.error(err, err.stack);
    alert('Failure code: ' + err.code);
}
// ############################################################
// # Signaling & control
// ############################################################
// We setup two clients and connections in the same page and tightly couple them
// to demonstrate call control and how to hook up the media streams.
// To see how to decouple these clients and connections across two browsers/users
// see the 'Offer/Answer' and 'Identities' demos.
var alice_peerConnection = null;
var bob_peerConnection = null;
var localStream = null;
function call() {
    disableButtons([ 'call' ]);
    enableButtons([ 'hangupOffer', 'accept', 'decline']);
}
function hangupOffer() {
    disableButtons([ 'hangupOffer', 'accept', 'decline' ]);
    enableButtons([ 'call' ]);
}
function decline() {
    disableButtons([ 'hangupOffer', 'accept', 'decline' ]);
    enableButtons([ 'call' ]);
}
function hangup() {
    if (alice_peerConnection) alice_peerConnection.close();
    if (bob_peerConnection) bob_peerConnection.close();
    if (localStream) localStream.stop();
    $('TD.video > DIV').hide();
    disableButtons([ 'hangup' ]);
    enableButtons([ 'call' ]);
}
function accept() {
    disableButtons([ 'hangupOffer', 'accept', 'decline' ]);
    enableButtons([ 'hangup' ]);
    alice_peerConnection = new WEBRTC_SHIM.PeerConnection(WEBRTC_SHIM.PeerConnConfig);
    bob_peerConnection = new WEBRTC_SHIM.PeerConnection(WEBRTC_SHIM.PeerConnConfig);
    // Request access to local webcam and microphone.
    WEBRTC_SHIM.getUserMedia({
        'audio': true,
        'video': true
    }, function (stream) {
        if (!alice_peerConnection || !bob_peerConnection) {
            stream.stop();
            return;
        }
        // Show video HTML elements.
        $('TD.video > DIV').show();
        localStream = stream;
        // Show local video & audio stream to the local video HTML elements.
        $('#alice_localVideo').attr('src', WEBRTC_SHIM.URL.createObjectURL(localStream));
        $('#bob_localVideo').attr('src', WEBRTC_SHIM.URL.createObjectURL(localStream));
        // When a remote video & audio stream is added show it in the remote video HTML elements.
        alice_peerConnection.onaddstream = function (event) {
            $('#alice_remoteVideo').attr('src', WEBRTC_SHIM.URL.createObjectURL(event.stream));
        };
        bob_peerConnection.onaddstream = function (event) {
            $('#bob_remoteVideo').attr('src', WEBRTC_SHIM.URL.createObjectURL(event.stream));
        };
        // Attach local video & audio stream to connection to stream it to peer.
        alice_peerConnection.addStream(localStream);
        bob_peerConnection.addStream(localStream);
        // Tightly couple trickle ICE.
        alice_peerConnection.onicecandidate = function(event) {
            if (!event.candidate) return;
            bob_peerConnection.addIceCandidate(new WEBRTC_SHIM.IceCandidate(JSON.parse(JSON.stringify(event.candidate))));
        }
        bob_peerConnection.onicecandidate = function(event) {
            if (!event.candidate) return;
            alice_peerConnection.addIceCandidate(new WEBRTC_SHIM.IceCandidate(JSON.parse(JSON.stringify(event.candidate))));
        }
        // Tightly couple session description exchange.
        alice_peerConnection.createOffer(function (sessionDescription) {
            alice_peerConnection.setLocalDescription(sessionDescription);
            bob_peerConnection.setRemoteDescription(new WEBRTC_SHIM.SessionDescription(JSON.parse(JSON.stringify(sessionDescription))));
            bob_peerConnection.createAnswer(function (sessionDescription) {
                bob_peerConnection.setLocalDescription(sessionDescription);
                alice_peerConnection.setRemoteDescription(new WEBRTC_SHIM.SessionDescription(JSON.parse(JSON.stringify(sessionDescription))));
            });
        }, fail);
    }, fail);
}
// ############################################################
// # Helpers for UI
// ############################################################
function enableButtons(names) {
    names.forEach(function(name) {
        var btn = $('BUTTON[onclick="' + name + '()"]');
        btn.addClass('active');
        btn.removeAttr('disabled');
    });
}
function disableButtons(names) {
    names.forEach(function(name) {
        var btn = $('BUTTON[onclick="' + name + '()"]');
        btn.removeClass('active');
        btn.attr('disabled','disabled');
    });
}
function fullscreen() {
    $('DIV.view')[0].webkitRequestFullscreen();
}
</script>

</body></html>