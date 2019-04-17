$(document).ready(function fuk() {
    $(".num").on('input', function () {
       var score = this.value;
       var boxid = this.id;
       var academic = parseFloat($("#academic").text());
       var nurse = parseFloat($("#nurse").text());
       var dentist = parseFloat($("#dentist").text());
       var other = parseFloat($("#other").text());
       //var gane5 = parseFloat($("#gane5_"+boxid).text());
       //alert(score)
       var koon = $("#koon"+boxid).text()
       if ( score != "" ){
           if (isNaN(score)){
            alert("กรุณากรอกเฉพาะตัวเลข")
            $("#"+boxid).val("")
           }
           else{
            var total = academic + nurse + dentist + other;
            alert(total);
       }
    }});
});
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}
function exportTableToCSV(filename) {

    var csv = ["\ufeff"];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}