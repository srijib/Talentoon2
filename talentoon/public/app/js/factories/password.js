angular.module('myApp').factory("Password",function($q,$http,$rootScope){

return {

		forget_password:function(email){
			var def =$q.defer();
			$http({
				url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/password/email' ,
				method:'POST',
				data: email
			}).then(function(res){
				console.log("ana saaaaaaaaaa7",res.data);

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

	}


})
