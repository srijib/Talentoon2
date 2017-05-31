angular.module('myApp').controller("eventcontroller",function(event,$scope,$http,$routeParams,$rootScope){
    var filesuploaded = []

    $scope.newevent = function(vaild) {
        if (vaild) {
            var category= $routeParams['category_id'];
            var user_id= 1;
            $scope.event.category_id=category
            console.log("ddddffffffffffffffffffff",$scope.event);
            $scope.event.mentor_id=user_id
            var data = $scope.event;


            event.addevent(data).then(function(data){

                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);

            });

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
        $rootScope.currentFile = element.files[0];
    }
});