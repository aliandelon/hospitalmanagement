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
            return false;           
         }
    });
    return false;
   });

  
  