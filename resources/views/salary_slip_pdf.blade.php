<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pay Slip</title>
 

<style>
	
	 @page {
                margin-top: 0.3cm;
                margin-bottom: 0.5cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
                font-size: 12pt;
            }

  body {
    font-family: Arial, sans-serif;
    font-size: 10pt;
}

   
.noborder_table {
    border-left: 0;
    border-right: 0;
    border-top: 0.;
    border-bottom: 0;
    border-collapse: collapse;
}

.noborder_table  td,
.noborder_table   th {
    border-left: 0;
    border-right: 0;
    border-top: 0;
    border-bottom: 0;
}



table {
    border-left: 0.01em solid #ccc;
    border-right: 0;
    border-top: 0.01em solid #ccc;
    border-bottom: 0;
    border-collapse: collapse;
}
table td,
table th {
    border-left: 0;
    border-right: 0.01em solid #ccc;
    border-top: 0;
    border-bottom: 0.01em solid #ccc;
}

</style>


</head>

<body>
<div align="center">
  <!-- <p><img name="" src="{{asset('uploads/'.$branch[0]->BranchLogo)}}"  height="100" alt="" /></p> -->
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder_table">
  <tr>
    <th width="70%" scope="col">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder_table">
      <tr>
        <th width="50%" scope="col"><div align="left">Employee Name </div></th>
        <th width="50%" scope="col"><div align="left">:{{$salary->EmployeeName}}</div></th>
      </tr>
      <tr>
        <td width="50%"><div align="left">Designation  </div></td>
        <td width="50%"><div align="left">:{{$salary->JobTitle}}</div></td>
      </tr>
      <tr>
        <td width="50%"><div align="left">Month</div></td>
        <td width="50%">:{{$salary->MonthName}} </td>
      </tr>
    </table></th>
    <th width="30%" valign="top" scope="col" align="right"> <div align="right">Dated: {{$salary->eDate}} </div></th>
  </tr>
</table>
<br />
<table width="100%" border="1" cellpadding="0"  cellspacing="5"  >
  <tr>
    <th height="35" valign="middle" scope="col"><div align="center">Earnings</div></th>
    <th height="35" align="right" valign="middle" scope="col"><div align="center">Deduction</div></th>
  </tr>
  <tr>
    <th width="50%" valign="top" scope="col">

    	<table width="100%" border="1" cellspacing="0" cellpadding="5" class="no-border">
      <tr>
        <th width="50%" scope="col"><div align="left">Salary </div></th>
        <th width="50%" scope="col"><div align="left">{{number_format($salary->Salary)}}</div></th>
      </tr>
      <tr>
        <td width="50%"><div align="left">OT</div></td>
        <td width="50%"><div align="left">{{number_format($salary->OT)}}</div></td>
      </tr>
      <tr>
        <td width="50%"><div align="left">Comission</div></td>
        <td width="50%">{{number_format($salary->Commission)}} </td>
      </tr>
      
      <tr>
        <td width="50%">&nbsp;</td>
        <td width="50%">&nbsp;</td>
      </tr>
      <tr>
        <td width="50%">Total Addition </td>
        <td width="50%">{{number_format($salary->Salary+$salary->OT+$salary->Commission)}}</td>
      </tr>
    </table></th>
    <th width="50%" valign="top" scope="col" align="right">
    	<table width="100%" border="0" cellspacing="0" cellpadding="5" class="no-border">
      <tr>
        <th width="50%" scope="col"><div align="left">Advances </div></th>
        <th width="50%" scope="col"><div align="left">{{$salary->Advance}}</div></th>
      </tr>
      <tr>
        <td width="50%"><div align="left">Visa Deduction</div></td>
        <td width="50%"><div align="left"> {{$salary->Visa_deduction}}</div></td>
      </tr>
      <tr>
        <td width="50%">SD</td>
        <td width="50%"><div align="left"> {{$salary->SD}}</div></td>
      </tr>
      <tr>
        <td width="50%"> Training Deduction</td>
          <td width="50%"><div align="left"> {{$salary->training_deduction}}</div></td>

      </tr>
      <tr>
        <td width="50%">Salary Deduction (Security)</td>
                <td width="50%"><div align="left"> {{$salary->salary_deduction}}</div></td>

      </tr>
      <tr>
        <td width="50%">Total Deduction </td>
        <td width="50%">{{number_format($salary->Advance+$salary->SD+$salary->training_deduction+$salary->Visa_deduction+$salary->salary_deduction)}}</td>
      </tr>
      <tr>
        <td width="50%">Net Salary </td>
        <td width="50%">{{number_format($salary->NetSalary)}}</td>
      </tr>
    </table></th>
  </tr>
</table>
<p>In words : {{convert_number_to_words($salary->NetSalary)}}. </p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder_table">
  
  <tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr><tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr><tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr><tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr><tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="50%" scope="col"><div align="center">Signature of the Employee </div></th>
    <th width="50%" align="right" valign="top" scope="col"><div align="center">Director Finance</div></th>
  </tr>
</table>
 
</body>
</html>
