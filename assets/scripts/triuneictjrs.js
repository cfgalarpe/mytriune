function submitForm(){
    $('#ff').form('submit',{
        onSubmit:function(){
            var validForm =  $(this).form('enableValidation').form('validate');
            if(!validForm) {
                return validForm;
            } else {
                var requestDescription = $('#requestDescription').val();
                var jobClassification = $('#jobClassification').val();
                var dateNeeded = $('#dateNeeded').val();
                checkDataViaAJAX(requestDescription, jobClassification, dateNeeded);
            }

        }
    });
}


function checkDataViaAJAX(requestDescription, jobClassification, dateNeeded) {
    //console.log(locationCode + " - " + floor + " " + roomNumber + " " + projectTitle + " " + scopeOfWorks + " " + projectJustification + " " + dateNeeded);
    jQuery.ajax({
        url: "setRequestICT",
        data:'requestDescription='+requestDescription+'&jobClassification='+jobClassification+'&dateNeeded='+dateNeeded,
        type: "POST",
        success:function(data){
            console.log(data);
            var resultValue = $.parseJSON(data);
            if(resultValue['success'] == 1) {
                clearErrorMessages();

                requestDescription = resultValue['requestDescription'];
                jobClassification = resultValue['jobClassification'];
                dateNeeded = resultValue['dateNeeded'];


                $.ajax({
                    url: 'ictjrs/getCreateConfirmation',
                    data: 'requestDescription='+requestDescription+'&jobClassification='+jobClassification+'&dateNeeded='+dateNeeded,
                    type: "POST",
                    success: function(response) {
                        $('#request-confirmation').html(response);
                        $('#dlg').dialog('open');
                        console.log("the request is successful!");
                    },
                                
                    error: function(error) {
                        console.log('the page was NOT loaded', error);
                        $('.content1').html(error);
                    },
                                
                    complete: function(xhr, status) {
                        console.log("The request is complete!");
                    }
                });


            } else {
                var obj = $.parseJSON(data);
                var dateNeeded = obj['dateNeeded'];
                var jobClassification = obj['jobClassification'];
                var requestDescription = obj['requestDescription'];
                var jobClassificationNotExist = obj['jobClassificationNotExist'];

                $notExistMessage = '';
                if(locationCodeNotExist != undefined) {
                    $notExistMessage =  $notExistMessage + jobClassificationNotExist + "<br>";
                } 
                if(dateNeeded != undefined) {
                    $notExistMessage =  $notExistMessage + dateNeeded + "<br>";
                } 
                if(jobClassification != undefined) {
                    $notExistMessage =  $notExistMessage + jobClassification + "<br>";
                } 
                if(requestDescription != undefined) {
                    $notExistMessage =  $notExistMessage + requestDescription + "<br>";
                } 
                $('div#error-messages').html($notExistMessage);
                return false;
            }
        },
        error:function (){}
    }); //jQuery.ajax({
} //function checkDataViaAJAX


function insertDataViaAJAX(requestDescription, jobClassification, dateNeeded) {
    console.log(requestDescription + " - " + jobClassification + " " + dateNeeded);
    jQuery.ajax({
        url: "insertRequestICT",
        data:'requestDescription='+requestDescription+'&jobClassification='+jobClassification+'&dateNeeded='+dateNeeded,
        type: "POST",
        success:function(data){
            var resultValue = $.parseJSON(data);
            if(resultValue['success'] == 1) {
                $('div.requestForm').remove();
                displayRequestNumber(resultValue['ID']);
                return true;
            } else {
                return false;
            }
        },
        error:function (){}
    }); //jQuery.ajax({
} //function insertDataViaAJAX


function displayRequestNumber(ID, userName) {
    jQuery.ajax({
        url: 'ictjrs/getCreatedRequest',
        data: 'ID='+ID,
        type: "POST",
        success: function(response) {
            $('.content1').html(response);
            console.log("the request is successful for content1!");
        },
                    
        error: function(error) {
            console.log('the page was NOT loaded', error);
            $('.content1').html(error);
        },
                    
        complete: function(xhr, status) {
            console.log("The request is complete!");
        }
    }); //jQuery.ajax({
}


function clearForm(){
    console.log($('#ff').form());
    $('#ff').form('clear');
}

function clearErrorMessages() {
    $('div#error-messages').html('');
}


function myformatter(date){
    var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
function myparser(s){
    if (!s) return new Date();
    var ss = (s.split('-'));
    var y = parseInt(ss[0],10);
    var m = parseInt(ss[1],10);
    var d = parseInt(ss[2],10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
        return new Date(y,m-1,d);
    } else {
        return new Date();
    }
}
