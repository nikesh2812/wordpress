<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
        jQuery('.citizen-slider').slick({
            arrows:false,
			speed: 300,
            dots:true,
            autoplay:true,
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        autoplay:false,
                        dots:true
                    }
                }
                    ]
        });

jQuery(document).ready(function(){
jQuery(".visitor-counter-heading>a").removeAttr("href");
});
</script>
<!-- end Simple Custom CSS and JS -->
