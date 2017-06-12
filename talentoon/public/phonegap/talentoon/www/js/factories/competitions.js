angular.module('talentoon').factory("Competitions", function ($http, $q,$rootScope) {

    return {
    getAllCompetitions:function(){
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/competition',
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'GET',

      }).then(function(res){
        console.log("all compition from factory",res);
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
    getCategoryCompetitions:function(cat_id){
        console.log('factory commmmm');
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/categories/'+cat_id+'/competitions',
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'GET',

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
    getSingleCompetition:function(cat_id,competition_id){
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/categories/'+cat_id+'/competitions/'+competition_id,
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'GET',

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
    createCompetition:function(competition_data){
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/categories/'+competition_data.category_id+'/competitions',
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'POST',
        data: competition_data

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
    createCompetitionPost:function(competitionPost_data){
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/competitions/'+competitionPost_data.competition_id+'/posts/create',
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'POST',
        data: competitionPost_data

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
    deleteCompetitionPost:function(competition_id,post_id){
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/competitions/'+competition_id+'/posts/'+post_id,
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'DELETE',
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
    getSingleCompetitionPosts:function(competition_id){
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/competitions/'+competition_id+'/posts',
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'GET',
      }).then(function(res){
        console.log("getSingleCompetitionPosts in factory ",res);
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
    joinCompetition:function(competition_id){
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/competition/'+competition_id+'/join',
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'GET',
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
    vote:function(post_id){
      var def =$q.defer();
      $http({
        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/competition/post/'+post_id+'/grantvote',
        headers:{
      'Authorization':'Bearer: '+ $rootScope.token
         },
        method:'GET',
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

}})
