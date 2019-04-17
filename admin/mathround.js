$(document).ready(function fuk() {
    /* $(".test").on('input', function () { */
        $(".test").blur(function(){
       var score = this.value;
       var boxid = this.id;
       var gane1 = parseFloat($("#gane1_"+boxid).text());
       var gane2 = parseFloat($("#gane2_"+boxid).text());
       var gane3 = parseFloat($("#gane3_"+boxid).text());
       var gane4 = parseFloat($("#gane4_"+boxid).text());
       var gane5 = parseFloat($("#gane5_"+boxid).text());
       //alert(score)
       var koon = $("#koon"+boxid).text()
       if ( score != "" ){
           if (isNaN(score)){
            alert("กรุณากรอกเฉพาะตัวเลข")
            $("#"+boxid).val("")
            $("#box2_"+boxid).val("")
            $("#box_"+boxid).val("")
           }
           else{
       if(gane1 < gane5){
        if(score <= gane1){
            var scorekoon = 1;
        }
        else if(score <= gane2 && score > gane1){
            var scorekoon = 1+((score-gane1)/(gane2-gane1));
        }
        else if(score <= gane3 && score > gane2){
            var scorekoon = 2+((score-gane2)/(gane2-gane1));
        }
        else if(score <= gane4 && score > gane3){
            var scorekoon = 3+((score-gane3)/(gane2-gane1));
        }
        else if(score <= gane5 && score > gane4){
            var scorekoon = 4+((score-gane4)/(gane2-gane1));
        }
        else{
            var scorekoon = 5;
        }
       }
       else{
        if(score <= gane5){
            var scorekoon = 5;
        }
        else if(score <= gane4 && score > gane5){
            var scorekoon = 5-((score-gane5)/(gane4-gane5));
        }
        else if(score <= gane3 && score > gane4){
            var scorekoon = 4-((score-gane4)/(gane4-gane5));
        }
        else if(score <= gane2 && score > gane3){
            var scorekoon = 3-((score-gane3)/(gane4-gane5));
        }
        else if(score <= gane1 && score > gane2){
            var scorekoon = 2-((score-gane2)/(gane4-gane5));
        }
        else {
            var scorekoon = 1;
        }   
       }
       /* var scorekoon = parseFloat(scorekoon).toFixed(2) */
       var scorekoon = Math.round(scorekoon * 100) / 100
       var newscore = (scorekoon*koon)/100;
       /* var newscore = parseFloat(newscore).toFixed(2) */
       var newscore = Math.round(newscore * 100) / 100
        $("#box2_"+boxid).val(newscore)
        $("#box_"+boxid).val(scorekoon)
       }
       }
       else{
        $("#box2_"+boxid).val("")
        $("#box_"+boxid).val("")
       }
    });
    /* $(".test").on('input', function (){ */
        $(".test").blur(function(){
        var kor = this.classList[2]
        var sum = 0;
        var sum2 = 0;
        var percent = $("#percent_"+kor).val();
        var maxscore = $("#maxscore_"+kor).val();

        $('.'+kor).each(function(){
            var boxid = this.id;
            if($("#box2_"+boxid).val() != ""){
           sum += parseFloat($("#box2_"+boxid).val());
           sum2 = (sum*percent)/maxscore;
            }
        });
/*         sum = parseFloat(sum).toFixed(2)
        sum2 = parseFloat(sum2).toFixed(2) */
        sum = Math.round(sum * 100) / 100  // result .12
        sum2 = Math.round(sum2 * 100) / 100  // result .12
        $("#box3_"+kor).val(sum)
        $("#box4_"+kor).val(sum2)
        var sum3 = parseFloat($("#box3_1").val() || 0)+parseFloat($("#box3_2").val() || 0)
        +parseFloat($("#box3_3").val() || 0)+parseFloat($("#box3_4").val() || 0)
        var sum4 = parseFloat($("#box4_1").val() || 0)+parseFloat($("#box4_2").val() || 0)
        +parseFloat($("#box4_3").val() || 0)+parseFloat($("#box4_4").val() || 0)
/*         sum3 = parseFloat(sum3).toFixed(2)
        sum4 = parseFloat(sum4).toFixed(2) */
        sum3 = Math.round(sum3 * 100) / 100  // result .12
        sum4 = Math.round(sum4 * 100) / 100  // result .12
        $("#box5").val(sum3)
        $("#box6").val(sum4)

        //alert(sum)
        //alert(kor)
    });
    /*$(".test").keyup(function(){
        var sum = 0;
        var kor = this.classList[2]
        $('.'+kor).each(function(){
            if(this.value != ""){
           sum += parseFloat(this.value);
            }
        });
        sum = parseFloat(sum).toFixed(2)
        alert(sum)
        //alert(kor)
    });*/
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