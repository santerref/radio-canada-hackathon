<template>
    <div>
        <button :class="{'active': (!playing && play_state == 1) || !playing && play_state != 1}" class="btn btn-primary btn-rounded" @click="on_click_button"><i :class="{'fa-play': !playing && play_state != 1, 'fa-pause': playing && play_state == 2, 'fa-hourglass-2': !playing && play_state == 1}" class="fa"></i>{{this.duration}}</button>
        <div :id="id" hidden="hidden"></div>
    </div>
</template>

<script>
    function generateUUID () { // Public Domain/MIT
        var d = new Date().getTime();
        if (typeof performance !== 'undefined' && typeof performance.now === 'function'){
            d += performance.now(); //use high-precision timer if available
        }
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = (d + Math.random() * 16) % 16 | 0;
            d = Math.floor(d / 16);
            return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });
    };

    import moment from 'moment'

    export default {
        props: ['mediaId', 'duration', 'startAt', 'endAt', 'diffusion'],
        data() {
            return {
                id: "radiocanada_player_" + generateUUID(),
                player: null,
                playing: false,
                play_state: 0, // 0 = never, 1 = loading, 2 = ok
            }
        },
        mounted() {
            this.player = new RadioCanada.player(this.id, {
                appCode: 'medianet',
                idMedia: this.mediaId
            });
            this.player.addEventListener(RadioCanada.player.events.PAUSE, this.on_pause);
            this.player.addEventListener(RadioCanada.player.events.PLAY, this.on_play);
            this.player.addEventListener(RadioCanada.player.events.SEEKING, this.on_seeking);
            this.player.addEventListener(RadioCanada.player.events.SEEKED, this.on_seeked);
            this.player.addEventListener(RadioCanada.player.events.COMPLETE, this.on_complete);
            this.player.addEventListener(RadioCanada.player.events.META_LOADED, this.on_metaloaded);
            this.player.addEventListener(RadioCanada.player.events.READY, this.on_ready);
        },
        methods: {
            on_click_button: function(event) {
                if (this.playing) {
                    this.player.pause();
                } else {
                    if (this.play_state == 0) {
                        this.play_state = 1;
                    }
                    this.player.play();
                }
            },
            on_pause: function(event) {
                console.log("on pause");
                this.playing = false;
            },
            on_play: function(event) {
                console.log("on play");
                this.playing = true;
                this.play_state = 2;
            },
            on_seeking: function(event) {
                console.log("on seeking");
                this.seeking = true;
            },
            on_seeked: function(event) {
                console.log("on seeked");
                this.seeking = false;
            },
            on_complete: function(event) {
                console.log("on complete");
            },
            on_metaloaded: function(event) {
                console.log("on on_metaloaded");
            },
            on_ready: function(event) {
                console.log("on ready");
            }
        }
    }
</script>

<!--
RadioCanada.player.events = {
  AD_COMPLETE: "AD_COMPLETE",
  AD_PLAY: "AD_PLAY",
  AD_STARTED: "AD_STARTED",
  BEGIN: "BEGIN",
  COMPLETE: "COMPLETE",
  CURRENT_TIME_CHANGE: "CURRENT_TIME_CHANGE",
  END: "END",
  END_CHAPTER: "END_CHAPTER",
  ENTER_FULL_SCREEN: "ENTER_FULL_SCREEN",
  ERROR: "ERROR",
  EXIT_FULL_SCREEN: "EXIT_FULL_SCREEN",
  EXTRACT: "EXTRACT",
  MEDIA_CHANGED: "MEDIA_CHANGED",
  META_LOADED: "META_LOADED",
  MUTE: "MUTE",
  NEXT: "NEXT",
  NEXT_CHAPTER: "NEXT_CHAPTER",
  PAUSE: "PAUSE",
  PLAY: "PLAY",
  PLAYER_READY: "PLAYER_READY",
  PRESENCE: "PRESENCE",
  PREVIOUS: "PREVIOUS",
  READY: "READY",
  RELATED: "RELATED",
  SEEKED: "SEEKED",
  SEEKING: "SEEKING",
  SHARE: "SHARE",
  START: "START",
  STOP: "STOP",
  UNMUTE: "UNMUTE",
  VOLUME_CHANGE: "VOLUME_CHANGE"
}
-->