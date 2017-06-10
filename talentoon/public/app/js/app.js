angular.module('myApp',["ngRoute","pascalprecht.translate"]) ;

angular.module("myApp").run(function($rootScope,$location){

    AOS.init();
  // $rootScope.searchPosts=  function(){
  //   $location.url('/search');
});
// ,"angularModalService
