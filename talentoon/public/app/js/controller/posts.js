angular.module('myApp').controller("posts",function($location,$route,categories,$scope,$http,posts,$rootScope,$q){


    posts.getSubscribePosts().then(function (data) {
        $scope.posts = data.posts;
        console.log("data posts",data );
        console.log("subscribe posts",$scope.posts );
    }, function (err) {
        console.log(err);
    });
    $scope.comment={}

    $scope.add_comment = function(i) {
        console.log("hhh",i);
        categories.submitComment($scope.posts[i].comment,$scope.posts[i].id).then(function(data){
            console.log("saved success comment",data)
            $route.reload();
        } , function(err){
            console.log(err);

        });
    }
});
