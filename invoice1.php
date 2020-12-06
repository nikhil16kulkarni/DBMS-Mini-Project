<?php

include 'connection.php';

$gbid = $_GET['gbid'];
$model_name = $_GET['model_name'];
$vehicle_no = $_GET['vehicle_no'];
$mechname = $_GET['mechname'];
$phone = $_GET['phone'];
$date = $_GET['date'];
$address = $_GET['address'];
$full_name = $_GET['full_name'];
$id = $_GET['id'];

// echo $model_name;
$query = "SELECT * FROM usedparts WHERE bookid = '$gbid'";
$query1 = "SELECT quantity FROM usedparts WHERE bookid = '$gbid'";
$result = mysqli_query($con, $query);
$result1 = mysqli_query($con, $query1);
$price = 10000;

$query6 = "SELECT bookid, parts FROM usedparts WHERE bookid = '" . $gbid . "'";
$result6 = mysqli_query($con, $query6);
$row2 = mysqli_fetch_assoc($result6);
if($row2!=null)
$cart = $row2['parts'];
else 
$cart = null;
$query7 = "DELETE from appointment WHERE gbid = '$gbid'";
mysqli_query($con, $query7);

$query8 = "UPDATE mechanic set work_status = 'free' where full_name = '$mechname'";
mysqli_query($con, $query8);

$query9 = "DELETE from done_assign WHERE bookid = '$gbid'";
mysqli_query($con, $query9);
 
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>
        .total
        {
            padding: 10px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr td:nth-child(3) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            /* font-size: 45px; */
            /* line-height: 45px; */
            color: grey;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <!-- <img src="dbms/images/pic01.jpg" style="width:100%; max-width:300px;"> -->
                                <h2>Garage<br>Management<br>System</h2>
                            </td>

                            <td>
                                Invoice #: <?php echo rand()?><br>
                                Created: <?php echo date("Y-m-d"); ?><br>
                                Appointment Date: <?php echo $date; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Address:- <br>
                                Garage Management System, Inc.<br>
                                Dhankavadi, Pune
                            </td>

                            <td>
                            <?php echo $full_name; ?>.<br>
                            <?php echo $address; ?><br>
                            <?php echo $phone; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Payment Method
                </td>

                <td>
                    Cash
                </td>
            </tr>

            <!-- <tr class="details" > -->
            <!-- <td>
                    Cash
                </td>
                
                <td>
                    1000
                </td> -->
            <!-- </tr> -->
        </table>
        <table id="dataTable">
            <tr class="heading">
                <td>
                    Item
                </td>

                <td>
                    Quantity
                </td>

                <td>
                    Price
                </td>
            </tr>
        
        </table>
        <h4 class="total" style="text-align: right;" id="disp"></h4>
        <div>
                <div class="container">
                    <div class="col-3">
                        <button class="btn btn-primary" onclick="location.href='http://localhost/dbms/dashcu.php?id=<?php echo $id?>'">
                            Pay Bill
                        </button>
                    </div>
                </div>
            
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            var cart = JSON.parse('<?php echo $cart; ?>');
            var price;
            var sum = 0;


            for (var i = 0; i < cart.length; ++i) {
                /*console.log(cart[i].partName);*/
                if (cart[i].partName == 'engine') {
                    price = 100000;
                } else if (cart[i].partName == 'tyres') {
                    price = 20000;
                } else if (cart[i].partName == 'steering') {
                    price = 20000;
                }
                else
                {
                    price = 10000;
                }
                const html = `
                  
                    <tr class="item">
                      <td>${cart[i].partName}</td>
                      <td>${cart[i].qty}</td>
                        <td>${price*cart[i].qty}</td>
                    </tr>
                  
      `;
                sum += price * cart[i].qty;
                document.getElementById('dataTable').innerHTML += html;
                const html2 = `Total : ${sum}`;
                document.getElementById("disp").innerHTML = html2;
            }


        })
    </script>
</body>

</html>