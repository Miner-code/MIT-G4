<script type="text/javascript">

//* Gestion navbar page active 

var current = window.location;
var val = document.getElementsByTagName('a');
for (i = 0; i < val.length; i++){
    if(val[i].className == "nav-link"){
        if(val[i].href == current){
        val[i].className = "nav-link active";
        }
    }
}
</script>
