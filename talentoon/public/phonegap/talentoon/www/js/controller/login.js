angular.module('talentoon').controller("login", function ($scope, $http, user,$state,$rootScope,$ionicPopup) {
$scope.user={}

    $scope.loginFn = function (valid) {

    //   $ionicPopup.show({
    // template: 'invaild user name or password ',
    // title: 'Password is Incorrect',
    // subTitle: 'Please rewrite your password ',
    // scope: $scope,
    // buttons: [
    //   { text: 'Cancel' },
    //
    // ]
    // });

        console.log('in controller');
        if (valid) {
            console.log(valid);
            var userdata = $scope.user
            console.log($scope.user);
            console.log("inside login:", userdata);
            user.login(userdata).then(function (data) {
              if(data.status == 'wrong'  && data.message =='Password is Incorrect'){
                $ionicPopup.show({
              template: 'invaild user name or password ',
              title: 'Password is Incorrect',
              subTitle: 'Please rewrite your password ',
              scope: $scope,
              buttons: [
                { text: 'Cancel' },

              ]
              });



              }
                console.log("dataaaaa minA",data);
                $rootScope.user_info = data.user
                $rootScope.token = data.token
                localStorage.setItem('token',data.token);
                localStorage.setItem('username',data.user.first_name);
                localStorage.setItem('userimage',data.user.image);

                $state.go('app.home');
            }, function (err) {
                console.log(err);

                if(err.status == -1 ){

                  $ionicPopup.show({
                template: 'There is problem in serve ',
                title: 'server connenection error',
                subTitle: 'Please check of your connection ',
                scope: $scope,
                buttons: [
                  { text: 'Cancel' },

                ]
              });



                }
            });

        }



    }


    //-----------------
    //,$cordovaOauth,$localStorage
    // $scope.login = function() {
    //         $cordovaOauth.facebook("CLIENT_ID_HERE", ["email", "read_stream", "user_website", "user_location", "user_relationships"]).then(function(result) {
    //             $localStorage.accessToken = result.access_token;
    //             $state.go('app.myprofile');
    //         }, function(error) {
    //             alert("There was a problem signing in!  See the console for logs");
    //             console.log(error);
    //         });
    // };
    //

    //--------------------


})
