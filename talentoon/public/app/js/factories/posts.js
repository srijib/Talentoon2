
angular.module('myApp').factory("posts", function ($http, $q) {

    return {
likepost:function(data){
  console.log("from factory",data);
  var def =$q.defer();
  $http({
    url:'http://localhost:8000/api/like',
    method:'POST',
    data:data

  }).then(function(res){
    console.log("res from like",res);
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
dislikepost:function(data){
  console.log("from factory",data);
  var def =$q.defer();
  $http({
    url:'http://localhost:8000/api/dislike',
    method:'POST',
    data:data

  }).then(function(res){
    console.log("res from dislike",res);
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
sharepost:function(data){
  console.log("from factory",data);
  var def =$q.defer();
  $http({
    url:'http://localhost:8000/api/share',
    method:'POST',
    data:data

  }).then(function(res){
    console.log("res from share",res);
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
