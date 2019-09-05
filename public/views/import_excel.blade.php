<!DOCTYPE html>
<html>
<head>
    <title>Import Excel File in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="app.js"></script>

</head>
<body ng-app="myApp" ng-controller="CRUDController">
<br />

<div class="container">
    <h3 align="center">Import Excel File in Laravel</h3>
    <br />

                <div class="alert alert-danger" ng-if="errors.length > 0"  class="close" data-dismiss="alert" aria-label="Close">

                    <div ng-repeat="error in errors"><i class="material-icons">close</i> {{ error }}</div>

                </div>

    <fieldset class="border" style="width: 85%;margin: auto">
        <legend class="w-auto">Import   </legend>
    <form method="post" enctype="multipart/form-data"
    >
        <input type="hidden" name="token" value="{{ csrf_token() }}">

        <div class="form-group">

            <table class="table">
                <tr>
                    <td width="40%" align="right"><label>Select File for Upload</label></td>
                    <td width="30">
                        <input type="file"  ng-model="select_file" id="select_file" name="select_file" />
                    </td>
                    <td width="30%" align="left">
                        <input type="submit" name="upload" ng-click="import()" class="btn btn-primary" value="Upload">
                    </td>
                </tr>
                <tr>
                    <td width="40%" align="right"></td>
                    <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                    <td width="30%" align="left"></td>
                </tr>
            </table>
        </div>
    </form>
    </fieldset>

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
