jQuery(document).ready(function(){
var counts = jQuery("#blog_count").html();
var count = counts.split(',');
var count1 = (load_more_posts_var.counts);
var count2 = (load_more_posts_var.blog_count);
var $container = jQuery('.masonry1');
var totalPosts= parseInt(count[1]);
var view_post = parseInt(count[0]);
var totalPosts = parseInt(count1);
var view_post = parseInt(count2);
var show_after = 1+parseInt(view_post);
var j;
var i;
var totPost = totalPosts;
j = i = totalPosts- view_post; //  Show only 3 posts
for(totalPosts; i>=1; i--,totalPosts--){
	jQuery('#row-'+totalPosts).hide();
}
if(totPost<=view_post){
	jQuery('.post-btn1').hide();
} else if(totPost>=show_after){
	jQuery('.post-btn1').show();
}
function getItemElement(id) {
  var elem = document.createElement('div');
  elem.className = 'cls-'+id+' col-md-4 col-sm-4';
  return elem;
}
jQuery(".append-button").click(function(){
	var showPosts = view_post;
	while(!showPosts==0 && totalPosts < totPost ){
	var plusOne = totalPosts+1;
	var elems = getItemElement(totalPosts+1);
	
	 var Html = jQuery('#row-'+plusOne).html();
	 jQuery('#row-'+plusOne).remove();
	 jQuery(elems).append(Html);
	 $container.append( elems );
	 if(showPosts%3==0){
		jQuery('.cls-'+totalPosts).after('<div class="clearfix"></div>');
	 }
	 showPosts--;
	 totalPosts++;
	}
	if(totPost==totalPosts)
	{
	jQuery('.post-btn1').hide();
	}
});
});