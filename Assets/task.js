$('#addtask').on('click', function () {
    var file_data = $('#addtaskimage').prop('files')[0];
    var new_task_date = $('#newtaskdate').val();
    var new_task_describe = $('#newtaskdescribe').val();

    if (new_task_date == '' || new_task_describe == '') {

        alert("Date Or Decription must rquired");
        return true;
    }

    if (!$('#addtaskimage').prop('files')[0]) {
        alert("Image required");
        return true;
    }
    var form_data = new FormData();
    form_data.append("type", "add");
    form_data.append("file", file_data);
    form_data.append("date", new_task_date);
    form_data.append("description", new_task_describe);

    var response = ajaxtask(form_data);
    if (response == "success") {
        setTimeout(function () {
            location.reload();
        }, 1000);
    } else {
        alert(response)
        setTimeout(function () {
            location.reload();
        }, 1000);

    };

});


function deletetask(elem){



    var rowid = elem.parentNode.parentNode.id;
    var vararray = rowid.split("row");
    var taskid = parseInt(vararray[1]);

    if (confirm("Are you sure to delete This task ?")) {
        var form_data = new FormData();
        form_data.append("type", "delete");
        form_data.append("taskid", taskid);

        var response = ajaxtask(form_data);
        document.getElementById(rowid).remove();
    }

}


function getedittask(elem){

    var rowid = elem.parentNode.parentNode.id;
    var row = elem.parentNode.parentNode;
    var vararray = rowid.split("row");
    var taskid = parseInt(vararray[1]);
    strdate = row.getElementsByClassName('date')[0].innerText;   
    newdate = strdate.split("/").reverse().join("-");
    document.getElementById("edittaskdate").value = newdate;
    picture = row.getElementsByClassName('image')[0].src;
    document.getElementById("editimg").src = picture;
    describe = row.getElementsByClassName('desc')[0].innerText;
    document.getElementById("edittaskdescribe").value = describe;
    document.getElementById("editsave").id = taskid;
    setfun = "#"+taskid;
    $(setfun).on('click',function (){
     
        
        // set var from input 
        newdate =  document.getElementById("edittaskdate").value ;
        file_data = $('#edittaskimage').prop('files')[0];
        newdesc = document.getElementById("edittaskdescribe").value ;

        //fill up object with value

        var  form_data =  new FormData();
        form_data.append("file",file_data);
        form_data.append("newdate",newdate);
        form_data.append("newdesc",newdesc);
        form_data.append("type","edit");
        form_data.append("taskid",taskid);

        console.log('console success')
        var response = ajaxtask(form_data);
        
        setTimeout(function () {
            location.reload();
        }, 1000);

    })


}


    function ajaxtask(form_data) {
        var response = "";
        $.ajax({
            url: 'taskajax.php', // <-- point to server-side PHP script 
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (php_script_response) {
                response = php_script_response
            }
        });
     
        
        return response;
    }


    function toggle(element){
        var rowid = element.parentNode.parentNode.parentNode.id;
        var vararray = rowid.split("row");
        var empid = parseInt(vararray[1]);        
        var val = element.checked;
        if(val){
            val = "active";
        }
        else
        {
            val = "deactive";
        }
        var  form_data =  new FormData();
        form_data.append("employee",empid);
        form_data.append("value",val);


        $.ajax({
            url: 'activeajax.php', // <-- point to server-side PHP script 
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,

            data: form_data,
            type: 'post',
            success: function (respose) {
                console.log(respose)
            }
        });

    }