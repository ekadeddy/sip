// $(document).ready(function() {
//     myFunction();
// });


function myFunction() {
    alert('comeon');
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
}