angular.module('talentoon').factory("Home",function($q,$http,$rootScope){

return {

		getTopPosts:function(){

			var def =$q.defer();
			$http({
				url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/mostLikeabe' ,
				headers:{
			'Authorization':'Bearer: '+ $rootScope.token
				 },
				method:'GET'

			}).then(function(res){
				console.log(res)
				console.log('y bashrrrrr',res.data.posts);
				if(res.data.posts){
					def.resolve(res.data.posts)
				}else{
					def.reject('there is no data ')
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
            url:'http://127.0.0.1:8000/api/allworkshops' ,
						headers:{
					'Authorization':'Bearer: '+ $rootScope.token
						 },
            method:'GET'

        }).then(function(res){
            console.log('gggfff',res);
            if(res.data){
                console.log(res.data);
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
				headers:{
			'Authorization':'Bearer: '+ $rootScope.token
				 },
				method:'GET'

			}).then(function(res){
				console.log('gggfff',res);
				if(res.data){
					console.log(res.data);
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
		push:function(apikey,id){

			var def =$q.defer();
			$http({
				url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/push' ,
			// 	headers:{
			// 'Authorization':'Bearer'+ $rootScope.token
			// 	 },
				method:'POST',
				data:{"apikey":apikey,"id":id}


			}).then(function(res){
				// console.log(res);

				if(res.data){
						def.resolve(res.data)

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
