(function() {

function page_like(url, html_el) {
    ga('send', 'event', 'Facebook', 'like', url);
}
function page_dislike(url, html_el) {
    ga('send', 'event', 'Facebook', 'unlike', url);
}
function page_comment(response) { 
    ga('send', 'event', 'Facebook', 'commented', response.href);
}
function page_uncomment(response) { 
    ga('send', 'event', 'Facebook', 'uncomment', response.href);
}
function fb_ga_glue_events() {
    FB.Event.subscribe('edge.create', page_like);
    FB.Event.subscribe('edge.remove', page_dislike);
    FB.Event.subscribe('comment.create', page_comment);
    FB.Event.subscribe('comment.remove', page_uncomment);
}

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {
    $('#facebook-jssdk').load(function() { FB.XFBML.parse(); fb_ga_glue_events(); });
    return;
  }
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=1206212556115950";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

(function($){
    $(document).ready(function($) {
        window.wayp = $('.widget.fb-lazy-likebox').waypoint(function(direction) {
            var el = $(this.element).find('.lazy-likebox-placeholder');
            el.addClass('fb-page');
            var elid = this.element.id;
            this.destroy();
            FB.XFBML.parse();
            fb_ga_glue_events();
        }, { offset: 'bottom-in-view' });
    });
})(jQuery);

}());
