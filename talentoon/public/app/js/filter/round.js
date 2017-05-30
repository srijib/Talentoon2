angular.module('myApp').filter("round",function(){

return function(item,ops){
	
	ops=ops||2;

	return item.toFixed(ops)
}

})