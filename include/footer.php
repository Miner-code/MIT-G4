            </div>
            <div class="w-100 bg-grey-light d-flex justify-content-center footer">
                <a href="https://github.com/Miner-code/MIT-G4" target="_blank" class="m-4"><i class="fa-brands fa-github grey-dark" style="font-size: 3em;"></i></a>
            </div>
        </main>
    </div>
</div>
<script type="text/javascript">

// * Gestion nav-link active 
var current = window.location;
var listLink = document.querySelectorAll('.nav-item a');
var listIcon = document.querySelectorAll('.nav-item a div');
var listSpan = document.querySelectorAll('.nav-item a span');
console.log(listLink);
for (i = 0; i < listLink.length; i++){
    if(listLink[i].href == current){
        listLink[i].className = "nav-link d-flex align-items-center active";
        listIcon[i].className = "grey-light";
        listSpan[i].className = "grey-light";
    }
}
</script>
