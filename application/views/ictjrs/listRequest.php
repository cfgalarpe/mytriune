

<div class="requestForm" >


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/icon.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/thirdparty/easyui/jquery.easyui.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/triune.css" />
<script type="text/javascript">
    function doSearch(){
        $('#tt').datagrid('load',{
            ID: $('#ID').val(),
            jobClassification: $('#jobClassification').val()
        });
    }
</script>   

<table id="tt" class="easyui-datagrid" style="width:100%;max-width:70%;padding:5px 5px;height:300px"
    url="getICTJRSRequestList" toolbar="#tb"
    title="New Request List" iconCls="icon-save"
    rownumbers="true" pagination="true" 
    data-options="method:'post',
    queryParams:{requestStatus:'<?php echo $requestStatus;?>'}"
    >

<thead>
    <tr>
        <th field="ID">ID</th>
        <th field="jobClassification" class="datagrid-cell-c2-jobClassification">Job Classification</th>
        <th field="requestDescription"  >Request Description</th>
        <th field="dateCreated"  align="right">Date Created</th>
        <th field="dateNeeded" align="right">Date Needed</th>
        <th field="requestStatusDescription">Request Status</th>
        <th field="userName">Requested By</th>

    </tr>
</thead>
</table>
<div id="tb" style="padding:3px">
<span>ID:</span>
<input id="ID" style="line-height:26px;border:1px solid #ccc">
<span>Job Classification:</span>
<input id="jobClassification" style="line-height:26px;border:1px solid #ccc">
<a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>

</div>
<script type="text/javascript">
$(document).ready(function(){

$('#tt').datagrid({

    onClickRow: function() {

        var row = $('#tt').datagrid('getSelected');
        $('#tt').datagrid('unselectAll');

        jQuery.ajax({
        url: 'bamjrs/getNewRequestVerification',
        data: 'ID='+row.ID,
        type: "POST",
        success: function(response) {
            $('div.requestFormLevel2').remove();

            $('.content2').append(response);
    
            console.log("the request is successful for content1!");
        },
                    
        error: function(error) {
            console.log('the page was NOT loaded', error);
            $('.content2').html(error);
        },
                    
        complete: function(xhr, status) {
            console.log("The request is complete!");
        }
    }); //jQuery.ajax({

    }

});
return false;
});
</script> 

<script>
function openNav() {
document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
document.getElementById("mySidenav").style.width = "0";
}
</script>
</div>