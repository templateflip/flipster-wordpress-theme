<?php 

$color_body_bg = esc_attr(shamrock_get_option('color_body_bg'));
$color_txt = esc_attr(shamrock_get_option('color_txt'));
$color_h = esc_attr(shamrock_get_option('color_h'));
$color_acc = esc_attr(shamrock_get_option('color_acc'));
$color_cat = esc_attr(shamrock_get_option('color_cat'));
$color_meta = esc_attr(shamrock_get_option('color_meta'));

?>

body,
.main-navigation ul ul {
	background: <?php echo $color_body_bg; ?>;
}
a{
	color: <?php echo $color_acc; ?>;
}
.site-navigation-wrapper{
    border-top: 1px solid <?php echo shamrock_hex2rgba($color_meta, 0.3); ?>;
    border-bottom: 1px solid <?php echo shamrock_hex2rgba($color_meta, 0.3); ?>;
}
.entry-content a:not(.more-link){
	color: <?php echo $color_txt; ?>;
	background: -webkit-gradient(linear, 50% 100%, 50% 0%, color-stop(50%, <?php echo $color_body_bg; ?>), color-stop(50%, <?php echo $color_acc; ?>));
	background: -moz-linear-gradient(bottom, <?php echo $color_body_bg; ?> 50%, <?php echo $color_acc; ?> 50%);
	background: -webkit-linear-gradient(bottom, <?php echo $color_body_bg; ?> 50%, <?php echo $color_acc; ?> 50%);
	background: linear-gradient(to top, <?php echo $color_body_bg; ?> 50%, <?php echo $color_acc; ?> 50%);	
	background-repeat: repeat-x;
	background-size: 2px 2px;
	background-position: 0 100%;
	text-shadow: 2px 0 <?php echo $color_body_bg; ?>, 0px 2px <?php echo $color_body_bg; ?>, -2px 0 <?php echo $color_body_bg; ?>, 0 -2px <?php echo $color_body_bg; ?>;
}
body,
.site-header .site-title a,
.smr-nofimg .smr-post.has-post-thumbnail .entry-title a,
.smr-nofimg .smr-post.has-post-thumbnail .entry-header .entry-title,
.sidebar a,
.archive-head p,
.smr-prev-next a,
.smr-nav-search button.smr-search-submit,
.sidebar .smr-search-form .smr-search-submit{
	color: <?php echo $color_txt; ?>;
}
.has-post-thumbnail .entry-meta .meta-item, 
.has-post-thumbnail .entry-meta span, 
.has-post-thumbnail .entry-meta a{
	color: rgba(255,255,255,0.7);
}
.has-post-thumbnail .entry-meta a:hover{
	color: #FFF;
}
.main-navigation li:after{
	background: <?php echo $color_acc; ?>;
}
.smr-pagination a,
.entry-meta a:hover,
.sidebar a:hover,
.sidebar li:before,
.entry-content a:hover,
.entry-title a:hover,
.comment-list .comment-reply-link,
.smr-author-box .smr-author-link,
.sub-menu li:hover > a,
.smr-nofimg .smr-post.has-post-thumbnail .entry-title a:hover,
.smr-nofimg .has-post-thumbnail .entry-meta a:hover,
.smr-post.format-video .entry-header .entry-title a:hover,
.smr-post.format-gallery .entry-header .entry-title a:hover,
.smr-post.format-audio .entry-header .entry-title a:hover,
.smr-post.format-image .entry-header .entry-title a:hover,
.smr-post.format-video .entry-header .entry-meta a:hover,
.smr-post.format-audio .entry-header .entry-meta a:hover,
.smr-post.format-gallery .entry-header .entry-meta a:hover,
.smr-post.format-image .entry-header .entry-meta a:hover,
.sidebar .tagcloud a:hover,
.entry-footer .meta-tags a:hover,
.smr-prev-next a:hover,
.site-footer a:hover{
	color: <?php echo $color_acc; ?>;	
}
.sidebar .tagcloud a:hover,
.entry-footer .meta-tags a:hover,
.smr-pagination a,
.smr-pagination .page-numbers.current,
.comment-list .comment-reply-link,
.smr-author-box .smr-author-link,
.more-link,
.smr-pagelinks-nav a,
.mks_autor_link_wrap a{
	border: 1px solid <?php echo shamrock_hex2rgba($color_acc, 0.7); ?>
}
.smr-pagination a:hover,
.smr-pagination .page-numbers.current{
	background: <?php echo $color_acc; ?>;
}
.smr-format-action,
.smr-format-action:hover,
.comment-list .comment-reply-link:hover,
.smr-author-box .smr-author-link:hover,
.entry-content .more-link:hover,
.smr-pagelinks-nav a:hover,
.mks_autor_link_wrap a:hover{
	color: #FFF;
	background: <?php echo $color_acc; ?>;
}
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4,
.h5,
.h6,
.entry-title a,
.main-navigation a,
.smr-nav-social a,
.smr-nav-search button.smr-search-submit,
.site-header .site-title a,
.smr-post.format-video .entry-header .entry-title,
.smr-post.format-gallery .entry-header .entry-title,
.smr-post.format-audio .entry-header .entry-title,
.smr-post.format-image .entry-header .entry-title,
.smr-post.format-video .entry-header .entry-title a,
.smr-post.format-gallery .entry-header .entry-title a,
.smr-post.format-audio .entry-header .entry-title a,
.smr-post.format-image .entry-header .entry-title a{
	color: <?php echo $color_h; ?>;
}
.post-categories a{
	background: <?php echo $color_cat; ?>;
}
.entry-meta .meta-item, .entry-meta span, .entry-meta a,
.comment-metadata a,
.entry-footer .meta-tags a,
.smr-nofimg .has-post-thumbnail .entry-meta .meta-item, 
.smr-nofimg .has-post-thumbnail .entry-meta span, 
.smr-nofimg .has-post-thumbnail .entry-meta a,
.smr-post.format-video .entry-header .entry-meta *,
.smr-post.format-audio .entry-header .entry-meta *,
.smr-post.format-gallery .entry-header .entry-meta *,
.smr-post.format-image .entry-header .entry-meta *,
.tagcloud a,
.post-date,
.sidebar .comment-author-link,
.rss-date{
	color: <?php echo $color_meta; ?>;
}
.smr-resp-separator{
	background: <?php echo shamrock_hex2rgba($color_meta, 0.3); ?>;
}
input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
textarea,
select,
.widget select{
	border: 1px solid <?php echo shamrock_hex2rgba($color_meta, 0.7); ?>	
}
.entry-footer .meta-tags a,
blockquote,
.smr-post{
	border-color: <?php echo shamrock_hex2rgba($color_meta, 0.3); ?>;
}

.comment-form .form-submit .submit,
.mks_autor_link_wrap a,
button, html input[type="button"], 
input[type="reset"], 
input[type="submit"]{
	border: 1px solid <?php echo shamrock_hex2rgba($color_acc, 0.7); ?>;
	color: <?php echo $color_acc; ?>;
}
hr{
	border-top: 1px solid <?php echo shamrock_hex2rgba($color_meta, 0.3); ?>;
}
.error404 .entry-content .smr-search-form .smr-search-submit,
.not-found .smr-search-form .smr-search-submit{
	color: <?php echo $color_txt; ?>;
	background: transparent;	
}
.comment-form .form-submit .submit:hover,
button:hover,
html input[type="button"]:hover, 
input[type="reset"]:hover, 
input[type="submit"]:hover{
	color: #FFF;
	background: <?php echo $color_acc; ?>;
}
.site-footer a{
	color: <?php echo $color_body_bg; ?>;
}
.mobile-nav{
	background: <?php echo $color_acc; ?>;	
}



@media (max-width: 620px){
.smr-post.has-post-thumbnail .entry-header .entry-title, .smr-post.has-post-thumbnail .entry-header .entry-title a{
	color: <?php echo $color_h; ?>;	
}
.has-post-thumbnail .entry-meta .meta-item, .has-post-thumbnail .entry-meta span, .has-post-thumbnail .entry-meta a{
	color: <?php echo $color_meta; ?>;
}
.has-post-thumbnail .entry-meta a:hover{
	color: <?php echo $color_acc; ?>;
}
}