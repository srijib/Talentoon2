angular.module('myApp').controller("eventcontroller",function(event,$scope,$http,$routeParams,$rootScope,$location){
    var filesuploaded = []

    // $rootScope.token = JSON.parse(localStorage.getItem("token"));
    $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));

    $scope.newevent = function(vaild) {
        var today = new Date();
        console.log("Today s ", today)

        if (vaild) {
            if (Date.parse($scope.event.date_to) < Date.parse($scope.event.date_from)){
                $scope.End_Start_Date_validation = false;
            }
            else if(today > Date.parse($scope.event.date_from)){
                    $scope.Start_Today_Date_validation = false;
            }
            else {
                var category = $routeParams['category_id'];
                var user_id = $rootScope.cur_user.id;
                $scope.event.category_id = category
                $scope.event.mentor_id = user_id
                var data = $scope.event;

                event.addevent(data).then(function (data) {
                    $scope.event_created = true;
                    console.log("the post request from server is ", data);

                    $location.url('/category/'+$routeParams['category_id']+"/events");
                }, function (err) {
                    $scope.event_created = false;
                    console.log(err);
                    console.log("________________________________error in event new");

                });
            }
        }

    };
    // $scope.submit_event_file= function() {
    //
    //     console.log("inside submit scope " ,filesuploaded)
    //
    //
    //
    //
    //     $http({
    //         method  : 'POST',
    //         url     : 'http://127.0.0.1:8000/api/event',
    //         processData: false,
    //         transformRequest: function (data) {
    //             var formData = new FormData();
    //
    //             for(var i =0;i< filesuploaded.length;i++){
    //                 formData.append("file[]", filesuploaded[i]);
    //                 console.log("file in loop",filesuploaded[i])
    //             }
    //             return formData;
    //         },
    //         data : filesuploaded,
    //         headers: {
    //             'Content-Type': undefined,
    //             'Process-Data':false
    //         }
    //     }).then(function(data){
    //         // alert(data);
    //         console.log("thennnnn in add post",data)
    //     });
    //
    //
    //
    // };

    $scope.uploadedFile = function(element) {
        console.log("element is ",element)
        $rootScope.EventcurrentFile = element.files[0];
    }
});