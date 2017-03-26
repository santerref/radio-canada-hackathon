<template>
    <div>
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

    export default {
        data() {
            return {
                id: "radiocanada_player_" + generateUUID()
            }
        },
        mounted() {
            radioPlayerInstance = new RadioCanada.player(this.id, {
                'appCode': 'medianet'
            });
        },
        computed() {
            
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