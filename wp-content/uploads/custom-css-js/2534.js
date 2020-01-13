<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(document).ready(function($){
		$('a').click(function(){
			var url = $(this).attr('href');
			var hostname= $('<a>').prop('href',url).prop('hostname');
			var domain = document.domain;
			if (hostname!=domain) {
				var answer = confirm("Leave From this page");
				if (answer){
                    window.open(url, '_blank');
				}
				else{
					alert("Thanks for sticking around!");
					return false;
				}
			}
			
		});
	});

</script>
<!-- end Simple Custom CSS and JS -->
