angular.module('myApp').factory("Email",function($q,$http,$rootScope){

    return {

        contact_us:function(complaint){

			var def =$q.defer();
			$http({
				url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/contact_us' ,
				method:'POST',
                data: complaint
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
    }

});
