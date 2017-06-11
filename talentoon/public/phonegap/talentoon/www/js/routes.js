angular.module('talentoon').config(function($stateProvider,$httpProvider,$sceDelegateProvider) {
  //for secuity to make sure that this url is secure or not
  $sceDelegateProvider.resourceUrlWhitelist([
     // Allow same origin resource loads.
     'self',
     // Allow loading from our assets domain.  Notice the difference between * and **.
     'http://172.16.3.77:8000/**'
   ]);  $stateProvider
    //
    .state('app', {
      url: '/app',
      templateUrl: 'templates/app.html',
      controller: 'app',
      abstract: true
    })


    .state('landing', {
      url: '',
      templateUrl: 'templates/landing.html',
    //   controller: 'home',
    })

    .state('app.home', {
      url: '/home',
      views: {
     "pageContent": {
      templateUrl: 'templates/home.html',
      controller: 'homec',
    }}
    })

    .state('login', {
      url: '/login',
      templateUrl: 'templates/login.html',
      controller: 'login'
    })

    .state('register', {
      url: '/register',
      templateUrl: 'templates/register.html',
      controller: 'register'
    })

    .state('app.about', {
      url: '/about',
      views: {
        "pageContent": {
          templateUrl: "templates/about.html"
        }
      }
    })

    .state('app.categories', {
      url: '/categories',
      views: {
        "pageContent": {
          templateUrl: "templates/categories.html",
          controller: "categories"
        }
      }
    })

    .state('app.categorieselements', {
      url: '/category/:category_id',
      views: {
        "pageContent": {
          templateUrl: "templates/categorieselement.html",
          controller: "oneCategory"
        }
      }
    })
    .state('app.singlepost', {
      url: '/category/:category_id/posts/:post_id',
      views: {
        "pageContent": {
          templateUrl: "templates/singlepost.html",
          controller: "oneCategory"
        }
      }
    })



        .state('app.addpost', {
          url: '/category/:category_id/addpost',
          views: {
            "pageContent": {
              templateUrl: "templates/addpost.html",
              controller: "addpost"
            }
          }
        })

        .state('app.myprofile', {
          url: '/myprofile',
          views: {
            "pageContent": {
              templateUrl: "templates/userprofile.html",
              controller: "userprofile"
            }
          }
        })




})
