
angular.module('myApp').factory("workshops", function ($http, $q,$rootScope) {

    return {

workshop_enroll:function(data){
  console.log("from factory",data);
  var def =$q.defer();
  $http({
    url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/workshop_enroll',
    method:'POST',
    data:data

  }).then(function(res){
    console.log("resssssssssssssss",res);
    if(res.data){
      console.log(res.data);
     def.resolve(res.data);

    }else{
      def.reject('there is no data ')
    }

  },function(err){
    def.reject(err);
  })
  return def.promise ;

},
addsession:function(data){

    var def =$q.defer();
    $http({

        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/workshop/'+data.workshop_id ,
        method:'POST',
        data:data

    }).then(function(res){
        console.log("session1111111",res.data);
        $http({
            method: 'POST',
            url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/session_upload/' + res.data.workshop_id,
            processData: false,
            data: {"media_url": "uploads/files" + $rootScope.sessionFile.name, "media_type": $rootScope.sessionFile.type},
            transformRequest: function (data) {
                var formData = new FormData();
                formData.append("file", $rootScope.sessionFile);
                return formData;
            },
            headers: {
                'Content-Type': undefined,
                'Process-Data': false
            }
        }).then(function (data) {
            // alert(data);
            console.log("thennnnn in add post", data)
        });

        //////////////////////////////////////////////
        console.log(res);
        if(res.data){
            def.resolve(res.data)
        }else{
            def.reject('there is no data ')
        }

    },function(err){
        // console.log(err);
        def.reject(err);
    })
    return def.promise ;

},


}})
