

var myApp =angular.module("myApp",["ngRoute"]);


myApp.config(function($routeProvider) {
    $routeProvider
        .when("/", {
            templateUrl : "views/import_excel.blade.php",
            controller:"CRUDController"
        })


        .otherwise({
            template : "<h1>None</h1><p>Nothing has been selected</p>"
        });

});

myApp.controller("CRUDController", function ($scope ,$http,$filter ) {
    //***************************load
    $scope.data = [];

    $scope.loadImport = function () {

        $http.get('/import')

            .then(function success(e) {
                console.log(e);
                $scope.data = e.data.data;

            });
    };
    $scope.loadImport();



    $scope.import = function () {
        var payload = new FormData();
        var files = document.getElementById('select_file').files[0];
        payload.append('select_file',files);
        $scope.successMsg = [];
        $http({
            method: 'POST',
            url: '/import',
            data: payload,
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined},
            dataType: 'json',
        }).then(function successCallback(response) {
            console.log(response);
            // $scope.successMsg = e.data.successMsg;
            alert(response.data.successMsg);
            alert('Submit Success');
            // $scope.recordSucess(response);
            $scope.loadImport();
        }, function errorCallback(response) {
            console.log(response);

            alert('Submit rror');
            // $scope.recordErrors(response);

            $scope.loadImport();

        });
    }
    // $scope.recordErrors = function (error) {
    //     $scope.errors = [];
    //     if (error.data.errors.select_file) {
    //         $scope.errors.push(error.data.errors.select_file[0]);
    //     }
    // }
    // $scope.recordSucess = function (error) {
    //     $scope.success = [];
    //     if (error.data.success.select_file) {
    //         $scope.success.push(error.data.success.select_file[0]);
    //     }
    // }
});


//
// @if($message = Session::get('success'))
// <div class="alert alert-success alert-block">
//     <button type="button" class="close" data-dismiss="alert">×</button>
// <strong>{{ $message }}</strong>
// </div>
// @endif
