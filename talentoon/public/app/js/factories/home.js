angular.module('myApp').factory("Home",function($q,$http,$rootScope){

return {

		getTopPosts:function(){

			var def =$q.defer();
			$http({
				url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/mostLikeabe' ,
				method:'GET'

			}).then(function(res){
				if(res.data){
                    def.resolve(res.data)
				}else{
                    def.reject('Sorry, No posts found')
				}

			},function(err){
				// console.log(err);
				def.reject(err);
			})
			return def.promise ;

		},
    getWorkshops:function(){

        var def =$q.defer();
        $http({
            url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/allworkshops' ,
            method:'GET'

        }).then(function(res){
            if(res.data){
                def.resolve(res.data.msg1)
            }else{
                def.reject('there is no data ')
            }

        },function(err){
            // console.log(err);
            def.reject(err);
        })
        return def.promise ;

    },
    getEvents:function(){

			var def =$q.defer();
			$http({
				url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/event/showall' ,
				method:'GET'

			}).then(function(res){
				if(res.data){
					def.resolve(res.data.data)
				}else{
					def.reject('there is no data ')
				}

			},function(err){
				// console.log(err);
				def.reject(err);
			})
			return def.promise ;

		},

		postDetails:function(index){

			var def =$q.defer();
			$http({
				url:'json/posts.json' ,
				method:'GET'

			}).then(function(res){
				// console.log(res);
				if(res.data.length){
						def.resolve(res.data[index])

				}else{
					def.reject('there is no data ')
				}

			},function(err){
				def.reject(err);
			})
			return def.promise ;

		},
		goingevent:function(event_id){
          console.log("from factory",event_id);
          var def =$q.defer();
          $http({
            url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/event/'+event_id+'/goingevent',
            method:'POST',
            data:event_id

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
		}


})
