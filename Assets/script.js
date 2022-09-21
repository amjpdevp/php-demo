
function checkId(elem) {
    var rowid = elem.parentNode.parentNode.id;
    var vararray = rowid.split("row");
    var empid = parseInt(vararray[1]);

    let text;
    if (confirm("Are You sure to Delete This Employee") == true) {
        text = "You pressed OK!";

        $.ajax({
            type: "POST",
            url: "delemp.php",
            data: {
                id: empid
            },
            cache: false,
            error: function () {
                alert("Error Found")
            }
        });

        document.getElementById(rowid).remove();

    }



}
