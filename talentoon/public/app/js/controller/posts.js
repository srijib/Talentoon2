angular.module('myApp').controller("posts",function($location,$scope,$http,posts,$rootScope,$q){


    posts.getSubscribePosts().then(function (data) {
        $scope.posts = data.posts;
        console.log("data posts",data );
        console.log("subscribe posts",$scope.posts );
    }, function (err) {
        console.log(err);
    });
});
