<!DOCTYPE html>
<html>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid gray;
  text-align: left;
  padding: 12px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</style>
<body>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>child email</th>
            <th>IMEI</th>
        </tr>
    </thead>
    <tbody>
        @foreach($branchs as $key => $branch)
        <tr>
            <td>
                {{ $key + 1 }}
            </td>
            <td>
                <div>{{ $branch->ar_name }}</div>
                <div>{{ $branch->en_name }}</div>
            </td>
            <td>
                {{ $branch->email }}
            </td>
            <td>
                {{ $branch->plain_password }}
            </td>
            <td>
                {{ $branch->child_email }}
            </td>
            <td>
                {{ $branch->imei }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
