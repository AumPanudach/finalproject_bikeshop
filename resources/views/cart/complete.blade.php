<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<style>
body {
font-family: "Garuda", sans-serif;
}
table tr th {
padding: 5px;
background-color: #f7f7f7;
}
table tr td {
padding: 5px;
}
</style>
</head>
<body>

<table border="0" width="100%">
    <tr>
        <td colspan="2" align="center">
            <h1>ใบสั่งซื้อ</h1>
            <h2>(Purchase Order)</h2>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%">
                <tr>
                    <td width="30%"><strong>ชื่อลูกค้า:</strong></td>
                    <td>{{ $cust_name }}</td>
                </tr>
                <tr>
                    <td><strong>อีเมล์:</strong></td>
                    <td>{{ $cust_email }}</td>
                </tr>
                <tr>
                    <td><strong>เบอร์โทร:</strong></td>
                    <td>{{ $cust_phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td valign="top"><strong>ที่อยู่จัดส่ง:</strong></td>
                    <td>
                        @if(isset($cust_address_no) && $cust_address_no)
                            {{ $cust_address_no }} 
                            @if(isset($cust_address_road) && $cust_address_road)
                                ถนน{{ $cust_address_road }}
                            @endif
                            <br>
                            @if(isset($cust_address_subdistrict) && $cust_address_subdistrict)
                                ตำบล/แขวง{{ $cust_address_subdistrict }}
                            @endif
                            @if(isset($cust_address_district) && $cust_address_district)
                                อำเภอ/เขต{{ $cust_address_district }}
                            @endif
                            @if(isset($cust_address_province) && $cust_address_province)
                                จังหวัด{{ $cust_address_province }}
                            @endif
                            @if(isset($cust_address_postcode) && $cust_address_postcode)
                                {{ $cust_address_postcode }}
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table border="0" width="100%">
                <tr>
                    <td width="40%"><strong>เลขที่:</strong></td>
                    <td>{{ $po_no }}</td>
                </tr>
                <tr>
                    <td><strong>วันที่:</strong></td>
                    <td>{{ $po_date }}</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <table border="1" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <th>ลําดับ </th>
                    <th>ชื่อสินค้า </th>
                    <th>ราคา/หน่วย</th>
                    <th>จํานวน</th>
                    <th>รวมเงิน</th>
                </tr>


                @foreach ($cart_items as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c['name'] }}</td>
                        <td align="right">{{ number_format($c['price'], 0) }}</td>
                        <td align="right">{{ number_format($c['qty'], 0) }}</td>
                        <td align="right">{{ number_format($c['price'] * $c['qty'], 0) }}</td>
                    </tr>
                @endforeach


            </table>
        </td>
    </tr>

    <tr>
        <td>
            <h4>หมายเหตุ</h4>
            <ul>
                <li>ชําระเงินโดยโอนเข้าบัญชีXXX ธนาคาร YYY สาขา ZZZ (ออมทรัพย)์</li>
                <li>กรุณาชําระเงินภายใน 7 วัน หลังจากที่สั่งซื้อ</li>
                <li>ชําระเงินแล้วส่งหลักฐานมาที่ sales@bikeshop.com หรือ LINE: @bikeshop</li>
            </ul>
        </td>
        <td align="right"><strong>จํานวนเงินรวมทั้งสิ้น</strong>
            <h1>{{ $total_amount }} บาท
            </h1>
        </td>

    </tr>
</table>
</body>
</html>