angular.module('talentoon').controller("userprofile", function ($scope, $http, user,$rootScope) {
  $rootScope.token = localStorage.getItem('token');

  user.userprofile().then(function(data){
		 console.log(data);
		$scope.userprofile=data.data;
                console.log("categories array",$scope.userprofile);
        console.log("user profile",$scope.userprofile);
	} , function(err){
		console.log(err);

	});


  user.userposts().then(function(data){
     console.log(data.data);
    $scope.userposts=data.data.allPosts;
    $scope.userinfo=data.data;
        console.log("user profile posts",$scope.userposts);
        console.log("user profile info",$scope.userinfo);

  } , function(err){
    console.log(err);

  });
//----------facebook--------------
// $scope.init = function() {
//     if($localStorage.hasOwnProperty("accessToken") === true) {
//         $http.get("https://graph.facebook.com/v2.2/me", { params: { access_token: $localStorage.accessToken, fields: "id,name,gender,location,website,picture,relationship_status", format: "json" }}).then(function(result) {
//             $scope.profileData = result.data;
//             console.log($scope.profileData)
//         }, function(error) {
//             alert("There was a problem getting your profile.  Check the logs for details.");
//             console.log(error);
//         });
//     } else {
//         alert("Not signed in");
//         $state.go('login');
//     }
// };
// ,$localStorage
//--------------------------

})
