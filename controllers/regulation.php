<?php
include 'checkloginstatus.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Quy Định</title>
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
</head>

<body>
    <a href="../index.php" class="float-right border border-success m-3 p-2">Về màn hình chính</a>
    <div class="container mt-5">
        <h2 class="d-inline-block border border-success p-2 mb-4">Danh Sách Các Quy Định Hiện Có</h2>
    </div>
    <div class="container mt-5" style="display: flex;">
        <h3 class="text-center" style="flex: 1">BẢNG THAM SỐ</h3>    
        <h3 class="text-center" style="flex: 1">BẢNG MÔN HỌC</h3>
    </div>
</body>

</html>
<?php
include 'connectdb.php';

$sql = "SELECT * FROM  THAMSO";
$result = $conn->query($sql);

// Table THAMSO
if ($result->num_rows > 0) {
    echo "
    <br>
    <div class='container' style='display: flex'>
    <table class='table table-bordered table-hover' style='width: 50%; margin-right:1%'>
    <thead>
    <tr class='table-secondary'>
        <th style='vertical-align: middle; text-align: center;'>Mã Tham Số</th>
        <th style='vertical-align: middle; text-align: center;'>Tên Tham Số</th>
        <th style='vertical-align: middle; text-align: center;'>Giá Trị</th>
        <th style='vertical-align: middle; text-align: center;'>Ghi Chú</th>
    </tr>
    </thead>
    <tbody>
    ";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "
    <tr>
        <td style='vertical-align: middle; text-align: center;'>" . $row['mathamso'] . "</td>
        <td style='vertical-align: middle; text-align: center;'>" . $row['tenthamso'] . "</td>
        <td style='vertical-align: middle; text-align: center;'>" . $row['giatri'] . "</td>
        <td style='vertical-align: middle; text-align: center;'>" . $row['ghichu'] . "</td>
    </tr>
    ";
    }
    echo"
    </tbody>
    </table>
    ";
} else {
    echo "0 results";
}

// Table MONHOC
$sql = "SELECT * FROM  MONHOC";
$result = $conn->query($sql);
$stt = 0;

if ($result->num_rows > 0) {
    echo "
    <table class='table table-bordered table-hover' style='width: 50%; margin-left:1%'>
    <thead>
    <tr class='table-secondary'>
        <th style='vertical-align: middle; text-align: center;'>STT</th>
        <th style='vertical-align: middle; text-align: center;'>Mã Môn Học</th>
        <th style='vertical-align: middle; text-align: center;'>Tên Môn Học</th>
    </tr>
    </thead>
    <tbody>
    ";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $stt++;
        echo "
    <tr>
        <td style='vertical-align: middle; text-align: center;'>" . $stt . "</td>
        <td style='vertical-align: middle; text-align: center;'>" . $row['mamonhoc'] . "</td>
        <td style='vertical-align: middle; text-align: center;'>" . $row['tenmonhoc'] . "</td>
    </tr>
    ";
    }
    echo"
    </tbody>
    </table>
    </div>
    ";
} else {
    echo "0 results";
}
$conn->close();

// Form edit regulation
echo "
    <div class='container mt-5' style='display: flex;'>
        <h3 style='flex: 1; margin-right: 1%'>SỬA BẢNG THAM SỐ</h3>    
        <h3 style='flex: 1; margin-left: 1%'>SỬA BẢNG MÔN HỌC</h3>
    </div>
    <br>
    <div class='container' style='display: flex;'>
        <form action='editregulation.php' method='POST' style='flex: 1; margin-right: 1%'>
            <input type='hidden' name='action' value='editRegulation'>
            <label for='mathamso' style='min-width: 92px'>Mã Tham Số: </label>
            <input type='text' name='mathamso' required/>
            <br>
            <label for='giatri' style='min-width: 92px'>Giá Trị: </label>
            <input type='text' name='giatri' required/>
            <br>
            <input type='submit' class='btn btn-primary' style='padding: 1.7px' value='Cập Nhật'>
        </form>
        <div class='editsubject' style='flex: 1; margin-left: 1%'>
            <form action='editregulation.php' method='POST'>
                <input type='hidden' name='action' value='deleteSubject'>
                <label style='min-width: 23%'>Xóa Môn Học: </label>
                <input type='text' name='mamonhoc' style='width: 18%' placeholder='Mã môn học' required/>
                <input type='submit' class='btn btn-primary' style='padding: 1.7px' value='Cập Nhật'>
            </form>
            <form action='editregulation.php' method='POST'>
                <input type='hidden' name='action' value='increaseSubject'>
                <label style='min-width: 23%'>Thêm Môn Học: </label>
                <input type='text' name='tenmonhoc' style='width: 18%' placeholder='Tên môn học' required/>
                <input type='text' name='mamonhoc' style='width: 18%' placeholder='Mã môn học' required/>
                <input type='submit' class='btn btn-primary' style='padding: 1.7px; text-align: right' value='Cập Nhật'>
            </form>
            <form action='editregulation.php' method='POST'>
                <input type='hidden' name='action' value='editSubject'>
                <label style='min-width: 23%'>Sửa Tên Môn Học: </label>
                <input type='text' name='mamonhoc' style='width: 18%' placeholder='Mã môn học' required/>
                <input type='text' name='tenmonhoc' style='width: 18%' placeholder='Tên môn học' required/>
                <input type='submit' class='btn btn-primary' style='padding: 1.7px' value='Cập Nhật'>
            </form>
        </div>
    </div>
    <footer class='text-center m-4' style='padding-top: 5%'>Copyright &copy 2021 University Of Information And Technology. </footer>
    "
?>

<!-- 
    Detail Form: 
     - Form edit Regulation: 123 - 132
     - Form edit Subject: 
        + delete: 134 - 139
        + increase: 140 - 146
        + edit: 147 - 153
-->