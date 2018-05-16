
<div class="requestForm">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/icon.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/thirdparty/easyui/jquery.easyui.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/triune.css" />


    <div style="margin:5px 0;"></div>
    <div class="easyui-panel" title="Create Request" style="width:100%;max-width:50%;padding:5px 5px;"> 
        <form id="ff" class="easyui-form" method="post" data-options="novalidate:true">
            <div style="margin-bottom:5px">
                <div style="margin-bottom:1px" class="two-column">
                    <input class="easyui-textbox" name="requestDescription" id="requestDescription" style="width:100%;height:100px" data-options="prompt:'DESCRIPTION:', multiline:true ,required:true">

                </div>


                <div style="margin-bottom:1px" >
                    <input class="easyui-combobox" name="jobClassification" id="jobClassification" style="width:70%" prompt="JOB CLASSIFICATION:" data-options="
                            url:'getjobClassification',
                            method:'get',
                            valueField:'jobClassification',
                            textField:'jobClassification',
                            onSelect: function(rec){
                                var url = 'getjobClassification?jobClassification='+rec.jobClassification;
                                console.log( $('#jobClassification').attr('prompt'));
                
                            },
                            panelHeight:'auto',
                            required:true
                            ">
                </div>

            </div>

            <div style="margin-bottom:1px" class="two-column">
                <input class="easyui-datebox" prompt="DATE NEEDED:" id="dateNeeded" data-options="formatter:myformatter,parser:myparser,required:true" style="width:80%;">

            </div>

        </form>
        <div style="text-align:center;padding:5px 0">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Submit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
        </div>
    </div>

   <div id="error-messages"> </div>
   <div id="dialog"> </div>
  
   <div id="dlg" class="easyui-dialog" title="Job Request Confirmation" style="width:800px;height:300px;padding:10px"
            data-options="
                modal: true,
                closed: true,
                buttons: [{
                    text:'Confirmed',
                    iconCls:'icon-ok',
                    handler:function(){
                        var requestDescription = $('input#requestDescription').val();
                        var jobClassification = $('input#jobClassification').val();
                        var dateNeeded = $('input#dateNeeded').val();
                        insertDataViaAJAX(requestDescription, jobClassification, dateNeeded);
                        $('#dlg').dialog('close');
                    }
                },{
                    text:'Cancel',
                    handler:function(){
                        $('#dlg').dialog('close');
                    }
                }]
            ">
            <div id="request-confirmation"> </div>
    </div>    
    
	<script src="<?php echo base_url();?>assets/scripts/triuneictjrs.js"></script>


</div>