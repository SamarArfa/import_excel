<!DOCTYPE html>
<html>
<head>
    <title>Import Excel File in Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
    <script src="app.js"></script>


</head>
<body ng-app="myApp" ng-controller="CRUDController">
<br />

<div class="container">

    <div class="container-fluid">


        <div id="excelView">


            <fieldset  style="width:40em" class="border p-3 m-3">
                <legend  class="w-auto" style="color:#000000;font-weight:bold; text-align: left">Payments statement</legend>
                <form method="post" enctype="multipart/form-data">
                    <div>
                        <label>Select File for Upload</label>

                        <input type="file"  ng-model="select_file" id="select_file" name="select_file" />

                        <input type="submit" name="upload" ng-click="import()" class="btn btn-primary" value="Upload">

                        <span class="text-muted">.xls, .xslx</span>

        </div>
    </form>
            </fieldset>
        </div>
    </div>

    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Data</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>batch_number</th>
                        <th>date_of_batch</th>
                        <th>sponsor_number</th>

                    </tr>
                        <tr ng-repeat="(index,row) in data">

                            <td>{{ row.batch_number }}</td>
                            <td>{{ row.date_of_batch }}</td>
                            <td>{{ row.sponsor_number }}</td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
