//navigation
var lastId,
    topMenu = $(".top-nav,#nav-home ul"),
    scrollDown = $(".scroll-down"),
    topMenuHeight = topMenu.outerHeight()+15,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).parent().not('.custom-link').children().attr("href"));
      if (item.length) { return item; }
    });

// Bind click handler to menu items

menuItems.add(scrollDown).click(function(e){
	var href = this.hash,
	offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+55;
  	$('html, body').stop().animate({ 
      scrollTop: offsetTop
  	}, 3000, 'easeInOutExpo');
  	e.preventDefault();
});

$('.home-link a,#mini-link').add(scrollDown).click(function(e) {
	var href = this.hash,
	offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight;
  	$('html, body').stop().animate({ 
      scrollTop: offsetTop
  	}, 3000, 'easeInOutExpo');
  	e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;
   
   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";
   
   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("active")
         .end().filter("[href=#"+id+"]").parent().addClass("active");
   }                   
});

// sticky menu
var stickyHeaderTop = 100;

jQuery(window).scroll(function(){
	if( jQuery(window).scrollTop() > stickyHeaderTop ) {
        jQuery('header').fadeIn(500);
    } else {
        jQuery('header').fadeOut(500);
    }
});

function notify(type,data){
  if($('.notification').size()>0)
    $('.notification').remove();
  var notif = $('<div class="alert notification notification-'+type+'"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'+data+'</strong></div>');
  $('body').append(notif);
  notif.fadeIn(500).delay(3000).fadeOut();
}

function validate(){
  var name = $("#your_name").val();
  var team = $("#team_name").val();
  var email = $("#your_email").val();
  var phone = $("#you_phone").val();
  var captcha = $("#captcha").val();
  if(name=="" || email=="" || team=="" || phone=="" || captcha==""){
    notify('error','Please fill in all the details.');
    return false;
  }
  return true;
}

jQuery(document).ready(function($) {
	$('section').last().addClass('last-section');	
	$('ul.nav-tabs li').first().addClass('active');
	$('.tab-pane').first().addClass('active').addClass('in');
	$(".swipebox").swipebox( {
		hideBarsDelay : 0
	});
  $("#reg_form").on("submit",function(){
    if(!validate()){
      return false;
    }
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      dataType: 'json',
      success: function(response){
        if(response.type=="success"){
          $("#reg_form").hide();
        }else if(response.type=="error"){
          $("#captcha-img").attr("src","/captcha");
          $("#captcha").val("");
        }
        notify(response.type,response.data);
      }
    });
    return false;
  });
});
