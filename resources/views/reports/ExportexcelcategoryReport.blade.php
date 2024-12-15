<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Category Report</title>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user"></i>Exported by: {{ Auth::user()->email }}
          <br>
          <i class="fa fa-user"></i>Exported Date: {{ Carbon::now()->currentDateTime}}
        </a>
    </li>
    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Afacad&display=swap');
         body{
            font-family: 'Afacad', sans-serif;
         } */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }


        @font-face {
            font-family: "source_sans_proregular";
            src: local("Source Sans Pro"), url("fonts/sourcesans/sourcesanspro-regular-webfont.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;

        }
        body{
            font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
            font-size: 12px;
        }

    </style>
  </head>
  <body>
    <div class="header"><div class="row"><div class="col-md-3"><img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/assets/img/131507_hacker_administrator_system_sys_hack_icon.png'))); ?>" width="80" style=""> </div><div class="col-md-3">Summary of report based on Category</div></div></div>
    {{-- <div class="header"><img src="{{ asset('admin_assets/images/228-2280680_yourlogo-icon-your-logo-goes-here-hd-png.png') }}" width="60px" height="60px" >Attendance Report</div> --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Category</th>
                <th>Date Created</th>
                <th>Archive Code</th>
                <th>Project Title</th>
                <th>Department</th>
                <th>Curriculum</th>
                <th>Status</th>
                <th>Rank</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $row)

            <tr>

              <td>{{ $row->archives_id }}</td>
              <td style="text-transform: capitalize;">{{ $row->type }}</td>
              <td>{{ $row->category }}</td>
              <td>{{ $row->created_at }}</td>
              <td>{{ $row->archive_code }}</td>
              <td>{{ $row->title }}</td>
              <td>{{ $row->department_name }}</td>
              <td>{{ $row->curriculum_name }}</td>
              <td>
                @if($row->archives_status == 1)
                   <span class="badge bg-success">Approved</span>
                @elseif($row->archives_status == 0)
                    <span class="badge bg-danger">Rejected</span>
                @else
                   <span class="badge bg-warning">Pending</span>
                @endif
              </td>
              <td>{{ $row->count_rank }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
