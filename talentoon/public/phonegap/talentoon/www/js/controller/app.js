
angular.module('talentoon').controller("app", function($scope, $state) {

  $scope.username = localStorage.getItem('username');
  $scope.userimage = localStorage.getItem('userimage');

  $scope.logout= function() {
    console.log('here');
    localStorage.removeItem('username');
    $state.go('landing');

  }
});
