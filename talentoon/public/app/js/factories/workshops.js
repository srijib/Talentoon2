
angular.module('myApp').factory("workshops", function ($http, $q) {

    return {

workshop_enroll:function(data){
  console.log("from factory",data);
  var def =$q.defer();
  $http({
    url:'http://localhost:8000/api/workshop_enroll',
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

}

}})
