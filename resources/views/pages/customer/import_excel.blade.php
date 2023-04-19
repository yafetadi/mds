<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="/import-excel" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="file" class="form-label">Pilih file data (Excel).</label>
            <input type="file" name="file" id="file" required class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</body>

</html>