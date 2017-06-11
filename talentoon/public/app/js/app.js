angular.module('myApp',["ngRoute","pascalprecht.translate"]) ;

angular.module("myApp").run(function($rootScope,$location,$timeout){

    AOS.init();
  // $rootScope.searchPosts=  function(){
  //   $location.url('/search');
  // var path = $location.path()
  // if (path == '/') {
  //     alert(path)
  //
  // }else{
  //     alert('hello')
  // }
  $rootScope.$on('$routeChangeStart', function(event, next, current) {
        // console.log('event',event);
        // console.log('next',next);
        // console.log(next.$$route.originalPath);
        // console.log('current',current);
        if (next.$$route.originalPath=="/") {
                // console.log('in home');
                $rootScope.in_home = true;

        }else{
            // console.log('not in home');
            $rootScope.in_home = false;

        }
    });

});
// ,"angularModalService
