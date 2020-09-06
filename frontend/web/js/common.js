// JavaScript Document
   baseurl =  "/";
   
   $(window).scroll(function () {
                    var body = $("html, body");

                    var threshold = 90;
                    if ($(window).scrollTop() <= threshold)
                        $('#static_cnt').removeClass('dropup');
                    else
                        $('#static_cnt').addClass('dropup').addClass('fadeInDown animated m3');
                });
        
        
                jQuery(document).ready(function () {
                    $(window).scroll(function () {

                        var body = $("html, body");

                        var threshold = 90;
                        if ($(window).scrollTop() <= threshold)
                            $('#static_cnts').removeClass('dropup');

                        else
                            $('#static_cnts').addClass('dropup');

                    });


                });



                jQuery(window).scroll(function () {
                    var scrlTop = jQuery(window).scrollTop();


                    $window = jQuery(window);

                    function myanimations(doelement, doclass) {
                        $element = jQuery(doelement);

                        $element.each(function () {
                            $thisone = jQuery(this);
                            if ($thisone.offset().top + 200 < ($window.height() + $window.scrollTop()) &&
                                    ($thisone.offset().top + $element.outerHeight()) + 170 > $window.scrollTop())
                            {
                                $thisone.removeClass('fadeOut');
                                $thisone.addClass('animated');
                                $thisone.addClass(doclass);
                            } else {
                                $thisone.removeClass(doclass);
                                $thisone.addClass('fadeOut');
                            }
                        });
                    }

                    //        myanimations('.ui-mains h1', 'fadeInUp');
                    //        myanimations('.ui-mains p', 'fadeInUp m2');

                });

                jQuery(document).ready(function ($) {
                    $('.smobitrigger').smplmnu();
                });

       
                (function ($) {
                    $(document).ready(function () {
                        $('#cssmenu ul ul li:odd').addClass('odd');
                        $('#cssmenu ul ul li:even').addClass('even');
                        $('#cssmenu > ul > li > a').click(function () {
                            $('#cssmenu li').removeClass('active');
                            $(this).closest('li').addClass('active');
                            var checkElement = $(this).next();
                            if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                                $(this).closest('li').removeClass('active');
                                checkElement.slideUp('normal');
                            }
                            if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                                $('#cssmenu ul ul:visible').slideUp('normal');
                                checkElement.slideDown('normal');
                            }
                            if ($(this).closest('li').find('ul').children().length == 0) {
                                return true;
                            } else {
                                return false;
                            }
                        });
                    }); 
                })(jQuery);







$(".chaptertopichref").on('click',function(e){
    e.preventDefault();
    var topicid = $(this).attr('id').split('-')[1];
     $.ajax({
        url:baseurl + '?r=subjects/render-topic-by-id',
        type:'POST',
        data:{'topicView':topicid},
        success:function(data){
            $('#topicViewById-div').html(data);
            return false;
        }        
    });   
    return false;
});

// develop-1.0 //
$('.startstudy').on('click',function(e){ // Start Study button link
    e.preventDefault();  
      window.location.replace(baseurl + 'subjects/list-subjects');
    
});

$(".subject_link").on('click',function(e){  // Subject menu link list-subjects
   
    e.preventDefault(); 
    
    var subid = $(this).attr('id');
    var heading = $(this).attr('href');
    $.ajax({
        url : baseurl + 'subjects/list-subjects-by-id',
        type : 'POST',
	data : {'sub' : subid},
        beforeSend:function(){                
               $("#partialview").html('<p>Loading.....wait a second</p>');     
        },
        success : function(data) {
            
            $(subid).closest("li").addClass('active');
            $('#list_sub_heading').text(heading);             
            $("#partialview").html(data);
           return false;             
         },
         error:function(){
              $("#partialview").html('<p>Some unexpected delay.....please try later</p>');    
         }
    });
    return false;
   
});






     
        
   // Link Click 
   $(".topic_video_link").on("click",function(e){
       e.preventDefault(); 
     var topicid = $(this).attr('id');
     $.ajax({
        url : baseurl + 'chapters/topics-video',
        type : 'POST',
	data : {'topicid' : topicid},
        success : function(data) {  
           $("#topicDetails").html(data);
           jQuery(".topic_lists").addClass('topicsHide');
            jQuery(".topic_lists").removeClass('topicsshow');
           var tops = jQuery('.topic_links').offset().top;
	   jQuery('html, body').animate({scrollTop: tops-50}, 600);
           var documentWidth = $(window).width();
                if (documentWidth > 992) {
               jQuery('html, body').animate({scrollTop: 50}, 600);
            }
            return false;           
         }
    });
    return false;
   });

  ////
jQuery(document).ready(function () {
	jQuery(".topic_links a").click(function(){
                jQuery(".topic_lists").removeClass('topicsHide');
		jQuery(".topic_lists").toggleClass('topicsshow');
     
	});
	jQuery(".topic_lists .mClose").click(function(){
		jQuery(this).parent('.topic_lists').hide();
	});
	
   var documentWidth = $(window).width();
                if (documentWidth < 992) {
					//jQuery('.chapterz ul li a').click(function(){
					//	jQuery('#topicDetails').appendTo(jQuery(this).parents('.panel'));
						//var tops = jQuery('#topicDetails').offset().top;
					      // jQuery('html, body').animate({scrollTop: tops+100}, 600);
					//});
				}
});

//We Recommend and Books
        $(document).ready(function () {

            $('.quotes').slick({
                slidesToShow: 3,
                autoplay: true,
                autoplaySpeed: 4000,
                slidesToScroll: 1,
                pauseOnHover: false,
//            prevArrow: '<i id="prev_slide_3"><img src="images/prev.png"></i>',
//            nextArrow: '<i id="next_slide_3"><img src="images/next.png"></i>',
                responsive: [
                    {
                        breakpoint: 1000,
                        settings: {
                            centerMode: false,
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 800,
                        settings: {
                            centerMode: false,
                            slidesToShow: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            centerMode: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });

        });

        $(document).ready(function () {

            $('.mob-packages').slick({
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                slidesToScroll: 1,
                pauseOnHover: false,
//            prevArrow: '<i id="prev_slide_3"><img src="images/prev.png"></i>',
//            nextArrow: '<i id="next_slide_3"><img src="images/next.png"></i>',
                responsive: [
                    {
                        breakpoint: 1000,
                        settings: {
                            centerMode: false,
                            slidesToShow: 1
                        }
                    },
                    {
                        breakpoint: 800,
                        settings: {
                            centerMode: false,
                            slidesToShow: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            centerMode: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });

        });
