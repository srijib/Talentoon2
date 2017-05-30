angular.module('myApp').factory("showreview",function($q,$http){

return {

		getAllInitialPosts:function(mentor_id){
			var def =$q.defer();
			$http({
				url:'http://localhost:8000/api/initial_posts/'+mentor_id ,
				method:'GET',
			}).then(function(res){
				console.log("eshta",res);
				if(res.data.all_initial_posts.length){
					console.log("Mina res ",res.data);
					def.resolve(res.data.all_initial_posts)
				}else{
					def.reject('there is no data ')
				}

			},function(err){
				// console.log(err);
				def.reject(err);
			})
			return def.promise ;

		},
		storeSingleInitialReview:function(rev_data){
			var def =$q.defer();
			$http({
				url:'http://localhost:8000/api/single_review' ,
				method:'POST',
				data: rev_data
			}).then(function(res){
				console.log('form single',res.data);
				if(res.data){
					// console.log("Mina res ",res.data.all_initial_posts);
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

		}


})
