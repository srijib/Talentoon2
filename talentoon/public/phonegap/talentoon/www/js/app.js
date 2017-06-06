// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('talentoon', ['ionic'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {

    if(window.cordova && window.cordova.plugins.Keyboard) {

cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
//-local notification---------------------
cordova.plugins.notification.local.schedule({
    id: 1,
    title: "Production Jour fixe",
    text: "Duration 1h",
    firstAt: Tuesday_2_am,
    every: "week",
    // sound: "file://sounds/reminder.mp3",
    // icon: "http://icons.com/?cal_id=1",
    data: { meetingId:"123#fg8" }
});

cordova.plugins.notification.local.on("click", function (notification) {
    joinMeeting(notification.data.meetingId);
});

//---------------------
      //------------push ----------------------------
          var push = PushNotification.init({
          	android: {
              senderID:"794863664785"
          	}
          });

          push.on('registration', function(data) {
          	console.log(data.registrationId)
            localStorage.setItem('pushtoken',data.registrationId);
          });

          push.on('notification', function(data) {
          	// data.message,
          	// data.title,
          	// data.count,
          	// data.sound,
          	// data.image,
          	// data.additionalData
          });

          push.on('error', function(e) {
          	// e.message
          });


      //-----------end push-----------------
















      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)


      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();


    }
  });
})
