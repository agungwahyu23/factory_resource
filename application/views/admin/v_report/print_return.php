<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style type="text/css">
    p{
        margin: 5px 0 0 0;
    }
        p.footer{
        text-align: right;
        font-size: 11px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
        display: block;
    }
    .bold{
        font-weight: bold;
    }

    #footer {
    clear: both;
    position: relative;
    height: 40px;
    margin-top: -40px;
    }
    </style>
</head>
<body style="font-size: 12px">

	<p align="center">
		<span style="font-size: 18px"><b> <?= $title ?></b></span> <br>
	</p>

	<hr>

	<p>
		<table>
			<tr>
				<th align="left"> Period </th>
				<td> : <?= $period ?></td>
			</tr>
		</table>
	</p>

	<p>
		<table style="border: 1px solid black;border-collapse: collapse;font-size: 11px" width="100%">
			<tr style="margin: 5px">
				<th style="border: 1px solid black;">No</th>
				<th style="border: 1px solid black;">Date Return</th>
				<th style="border: 1px solid black;">Trx Code</th>
				<th style="border: 1px solid black;">Total TTB</th>
			</tr>

      <?php
      $no = 1;
      foreach ($data_req as $key => $value) { ?>
        <tr style="margin: 5px">
          <td style="border: 1px solid black;"><?= $no++ ?></td>
          <td style="border: 1px solid black;"><?= $value->date_return ?></td>
          <td style="border: 1px solid black;"><?= $value->no_return ?></td>
          <td style="border: 1px solid black; text-align: center;"><?= $value->tot ?></td>
        </tr>
      
      <?php } ?>
			

		</table>
	</p>

	<p class="footer">
		<small>Tim Asset</small>
	</p>


</body>
</html>