<?php
include 'checkloginstatus.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhận Bảng Điểm</title>
     <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="../css/style.css">;
    <script src="../js/javascript.js"></script>
</head>
<body>
  <a href="../index.php" class="float-right border border-success m-3 p-2">Về màn hình chính</a>
  <div class="container-fluid mt-5">
    <h2 class="p-3 d-inline-block">Xem Bảng Điểm Môn Học</h2> <br>
    <form action="getthescoreboard.php" method="POST" style="display: flex;">
        <div class="dropdown" style="margin-right: 1%">
            <button type="button" id="class" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Danh Sách Các Lớp
            </button>
            <div class="dropdown-menu">
                <?php include'generateclass.php'?>
            </div>
        </div>
        <br>
        <div class="dropdown" style="margin-right: 1%">
            <button type="button" id="subject" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Danh Sách Môn Học
            </button>
            <div class="dropdown-menu">
                <?php include'generatesubject.php'?>
            </div>
        </div>
        <br>
        <div class="dropdown" style="margin-right: 1%">
            <button type="button" id="term" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Danh Sách Học Kỳ
            </button>
            <div class="dropdown-menu">
                <?php include'generateterm.php'?>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" style="margin-right: 1%">Xem</button>
    </form>
</div>
</body>
</html>
<?php
  // if form has submited then ...
  if ( isset($_POST['malop']))
  {
    include 'connectdb.php';
    $malop = $_POST['malop'];
    $tenmonhoc =$_POST['tenmonhoc'];
    $mahocky = $_POST['mahocky'];

    $sql = "select hs.hoten, pd.diem15p, pd.diem1t, pd.diemcuoiky
    from HOCSINH hs, LOP l, PHIEUDIEM pd, HOCKY hk, MONHOC mh
    where hs.mahocsinh = pd.mahocsinh
    and pd.mahocky = hk.mahocky
    and hs.malop = l.malop
    and mh.mamonhoc = pd.mamonhoc
    and l.malop = '$malop'
    and mh.tenmonhoc = '$tenmonhoc'
    and hk.mahocky = '$mahocky';
    ";
    
    $result = $conn->query($sql);

    echo "
    <div class='container'>
    <h3 class='text-center mt-5'>Bảng điểm môn " .$tenmonhoc .", " .strtoupper($mahocky) .", lớp " .$malop ." </h3>
    <br>
    <table class='table table-bordered table-hover'>
    <thead>
    <tr class='table-secondary'>
        <th>Stt</th>
        <th>Họ tên</th>
        <th>Điểm 15 phút</th>
        <th>Điểm 1 tiết</th>
        <th>Điểm thi cuối học kỳ</th>
    </tr>
    </thead>
    <tbody>
    ";
// output data of each row
    if ($result->num_rows > 0) {
    $stt = 0;
    while($row = $result->fetch_assoc()) {
        $stt++;
        echo "<tr>";
        echo "<td>" .$stt ."</td>";
        echo "<td>" .$row['hoten'] ."</td>";
        echo "<td>" .$row['diem15p'] ."</td>";
        echo "<td>" .$row['diem1t'] ."</td>";
        echo "<td>" .$row['diemcuoiky'] ."</td>";
        echo "</tr>";
    }
    } else {
        echo "<tr>";
        echo "<td colspan='6' class='text-center'>Danh sách trống</td>";
        echo "</tr>";
    }
    echo "
    </tbody>
    </table>
    </div>
    <footer class='text-center'>Copyright &copy 2021 University Of Information And Technology. </footer>
    <br>
    ";
    $conn->close();
}
?>