<?php

$musicUrl = htmlspecialchars($_GET["musicUrl"]);
$images = $_GET["images"];
$profile_image = htmlspecialchars($_GET["profile_image"]);
$property = htmlspecialchars($_GET["property"]);
$line_1 = htmlspecialchars($_GET["line_1"]);
$line_2 = htmlspecialchars($_GET["line_2"]);
$line_3 = htmlspecialchars($_GET["line_3"]);
$fps = htmlspecialchars($_GET['framerate'])/100; // Frames per second

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Identity by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
			  rel="stylesheet">
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
		<!--[if lte IE 8]><script>
		(function(l,f){function m(){var a=e.elements;return"string"==typeof a?a.split(" "):a}function i(a){var b=n[a[o]];b||(b={},h++,a[o]=h,n[h]=b);return b}function p(a,b,c){b||(b=f);if(g)return b.createElement(a);c||(c=i(b));b=c.cache[a]?c.cache[a].cloneNode():r.test(a)?(c.cache[a]=c.createElem(a)).cloneNode():c.createElem(a);return b.canHaveChildren&&!s.test(a)?c.frag.appendChild(b):b}function t(a,b){if(!b.cache)b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag();
			a.createElement=function(c){return!e.shivMethods?b.createElem(c):p(c,a,b)};a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/\w+/g,function(a){b.createElem(a);b.frag.createElement(a);return'c("'+a+'")'})+");return n}")(e,b.frag)}function q(a){a||(a=f);var b=i(a);if(e.shivCSS&&!j&&!b.hasCSS){var c,d=a;c=d.createElement("p");d=d.getElementsByTagName("head")[0]||d.documentElement;c.innerHTML="x<style>article,aside,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}</style>";
			c=d.insertBefore(c.lastChild,d.firstChild);b.hasCSS=!!c}g||t(a,b);return a}var k=l.html5||{},s=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,r=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,j,o="_html5shiv",h=0,n={},g;(function(){try{var a=f.createElement("a");a.innerHTML="<xyz></xyz>";j="hidden"in a;var b;if(!(b=1==a.childNodes.length)){f.createElement("a");var c=f.createDocumentFragment();b="undefined"==typeof c.cloneNode||
				"undefined"==typeof c.createDocumentFragment||"undefined"==typeof c.createElement}g=b}catch(d){g=j=!0}})();var e={elements:k.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup main mark meter nav output progress section summary time video",version:"3.6.2",shivCSS:!1!==k.shivCSS,supportsUnknownElements:g,shivMethods:!1!==k.shivMethods,type:"default",shivDocument:q,createElement:p,createDocumentFragment:function(a,b){a||(a=f);if(g)return a.createDocumentFragment();
			for(var b=b||i(a),c=b.frag.cloneNode(),d=0,e=m(),h=e.length;d<h;d++)c.createElement(e[d]);return c}};l.html5=e;q(f)})(this,document);
		</script><![endif]-->

		<style>
		      @charset "UTF-8";@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:300);body,html{height:100%}body,body:after{background-color:#fff}b,label,strong{color:#313f47}.select-wrapper,.select-wrapper:before,article,aside,body:after,details,figcaption,figure,footer,header,hgroup,label,menu,nav,section{display:block}a,abbr,acronym,address,applet,article,aside,audio,b,big,blockquote,body,canvas,caption,center,cite,code,dd,del,details,dfn,div,dl,dt,em,embed,fieldset,figcaption,figure,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,html,i,iframe,img,ins,kbd,label,legend,li,mark,menu,nav,object,ol,output,p,pre,q,ruby,s,samp,section,small,span,strike,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,tt,u,ul,var,video{margin:0;padding:0;border:0;font:inherit;vertical-align:baseline}form,form>.field,ol,p,ul{margin:0 0 1.5em}blockquote,q{quotes:none}blockquote:after,blockquote:before,q:after,q:before{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{-webkit-text-size-adjust:none;background-image:url(.images/overlay.png),-moz-linear-gradient(60deg,rgba(255,165,150,.5) 5%,rgba(0,228,255,.35)),url('https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=<?= $images[0] ?>&w=1500&h=1000&fill-to-fit=d8d8d8');background-image:url(.images/overlay.png),-webkit-linear-gradient(60deg,rgba(255,165,150,.5) 5%,rgba(0,228,255,.35)),url('https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=<?= $images[0] ?>&w=1500&h=1000&fill-to-fit=d8d8d8');background-image:url(.images/overlay.png),-ms-linear-gradient(60deg,rgba(255,165,150,.5) 5%,rgba(0,228,255,.35)),url('https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=<?= $images[0] ?>&w=1500&h=1000&fill-to-fit=d8d8d8');background-image:url(.images/overlay.png),linear-gradient(60deg,rgba(255,165,150,.5) 5%,rgba(0,228,255,.35)),url('https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=<?= $images[0] ?>&w=1500&h=1000&fill-to-fit=d8d8d8');background-repeat:repeat,no-repeat,no-repeat;background-size:100px 100px,cover,cover;background-position:top left,center center,bottom center;background-attachment:fixed,fixed,fixed}*,:after,:before{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}body.is-loading *,body.is-loading :after,body.is-loading :before{-moz-animation:none!important;-webkit-animation:none!important;-ms-animation:none!important;animation:none!important;-moz-transition:none!important;-webkit-transition:none!important;-ms-transition:none!important;transition:none!important}body:after{content:'';position:fixed;top:0;left:0;width:100%;height:inherit;opacity:0;z-index:1;background-image:url(.images/overlay.png),-moz-linear-gradient(60deg,rgba(255,165,150,.5) 5%,rgba(0,228,255,.35));background-image:url(.images/overlay.png),-webkit-linear-gradient(60deg,rgba(255,165,150,.5) 5%,rgba(0,228,255,.35));background-image:url(.images/overlay.png),-ms-linear-gradient(60deg,rgba(255,165,150,.5) 5%,rgba(0,228,255,.35));background-image:url(.images/overlay.png),linear-gradient(60deg,rgba(255,165,150,.5) 5%,rgba(0,228,255,.35));background-repeat:repeat,no-repeat;background-size:100px 100px,cover;background-position:top left,center center;-moz-transition:opacity 1.75s ease-out;-webkit-transition:opacity 1.75s ease-out;-ms-transition:opacity 1.75s ease-out;transition:opacity 1.75s ease-out}body.is-loading:after{opacity:1}body,input,select,textarea{color:#414f57;font-family:"Source Sans Pro",Helvetica,sans-serif;font-size:14pt;font-weight:300;line-height:2;letter-spacing:.2em;text-transform:uppercase}a,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color:inherit;text-decoration:none}@media screen and (max-width:1680px){body,input,select,textarea{font-size:11pt}}@media screen and (max-width:480px){body,html{min-width:320px}body,input,select,textarea{font-size:10pt;line-height:1.75}}a{-moz-transition:color .2s ease,border-color .2s ease;-webkit-transition:color .2s ease,border-color .2s ease;-ms-transition:color .2s ease,border-color .2s ease;transition:color .2s ease,border-color .2s ease}a:before{-moz-transition:color .2s ease,text-shadow .2s ease;-webkit-transition:color .2s ease,text-shadow .2s ease;-ms-transition:color .2s ease,text-shadow .2s ease;transition:color .2s ease,text-shadow .2s ease}a:hover{color:#ff7496}em,i{font-style:italic}h1,h2,h3,h4,h5,h6{color:#313f47;line-height:1.5;margin:0 0 .75em}h1{font-size:1.85em;letter-spacing:.22em;margin:0 0 .525em}h2{font-size:1.25em}h3,h4,h5,h6{font-size:1em}@media screen and (max-width:480px){h1{font-size:1.65em}}sub,sup{font-size:.8em;position:relative}sub{top:.5em}sup{top:-.5em}hr{border:0;border-bottom:solid 1px #c8cccf;margin:3em 0}form>.field>:last-child{margin-bottom:0}label{font-size:.9em;margin:0 0 .75em}input[type=text],input[type=password],input[type=email],input[type=tel],select,textarea{-moz-appearance:none;-webkit-appearance:none;-ms-appearance:none;appearance:none;border-radius:4px;border:1px solid #c8cccf;color:inherit;display:block;outline:0;padding:0 1em;text-decoration:none;width:100%}input[type=text]:invalid,input[type=password]:invalid,input[type=email]:invalid,input[type=tel]:invalid,select:invalid,textarea:invalid{box-shadow:none}input[type=text]:focus,input[type=password]:focus,input[type=email]:focus,input[type=tel]:focus,select:focus,textarea:focus{border-color:#ff7496}.select-wrapper{text-decoration:none;position:relative}.select-wrapper:before{content:"";-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;font-style:normal;font-weight:400;text-transform:none!important;color:#c8cccf;height:2.75em;line-height:2.75em;pointer-events:none;position:absolute;right:0;text-align:center;top:0;width:2.75em}.select-wrapper select::-ms-expand{display:none}input[type=text],input[type=password],input[type=email],select{height:2.75em}textarea{padding:.75em 1em}input[type=checkbox],input[type=radio]{-moz-appearance:none;-webkit-appearance:none;-ms-appearance:none;appearance:none;display:block;float:left;margin-right:-2em;opacity:0;width:1em;z-index:-1}input[type=checkbox]+label,input[type=radio]+label{text-decoration:none;color:#414f57;cursor:pointer;display:inline-block;font-size:1em;font-weight:300;padding-left:2.4em;padding-right:.75em;position:relative}.icon:before,input[type=checkbox]+label:before,input[type=radio]+label:before,ul.icons li a:before{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;font-style:normal;font-weight:400;text-transform:none!important}input[type=checkbox]+label:before,input[type=radio]+label:before{border:1px solid #c8cccf;content:'';display:inline-block;height:1.65em;left:0;line-height:1.58125em;position:absolute;text-align:center;top:.15em;width:1.65em}#main,#main .avatar,.icon,ul.icons li a{position:relative}input[type=checkbox]:checked+label:before,input[type=radio]:checked+label:before{color:#ff7496;content:'\f00c'}#main .avatar:before,#wrapper:before{content:''}input[type=checkbox]:focus+label:before,input[type=radio]:focus+label:before{border-color:#ff7496}input[type=checkbox]+label:before{border-radius:4px}input[type=radio]+label:before,ul.icons li a{border-radius:100%}::-webkit-input-placeholder{color:#616f77!important;opacity:1}:-moz-placeholder{color:#616f77!important;opacity:1}::-moz-placeholder{color:#616f77!important;opacity:1}:-ms-input-placeholder{color:#616f77!important;opacity:1}.formerize-placeholder{color:#616f77!important;opacity:1}.icon{text-decoration:none;border-bottom:none}.icon>.label{display:none}ol{list-style:decimal;padding-left:1.25em}ol li{padding-left:.25em}ul{list-style:disc;padding-left:1em}ul.actions,ul.alt,ul.icons{list-style:none}ul li{padding-left:.5em}ul.alt{padding-left:0}ul.alt li{border-top:solid 1px #c8cccf;padding:.5em 0}ul.alt li:first-child{border-top:0;padding-top:0}ul.icons{cursor:default;padding-left:0;margin-top:-.675em}ul.icons li{display:inline-block;padding:.675em .5em}ul.icons li a{text-decoration:none;display:block;width:3.75em;height:3.75em;border:1px solid #c8cccf;line-height:3.75em;overflow:hidden;text-align:center;text-indent:3.75em;white-space:nowrap}ul.icons li a:before{color:#fff;text-shadow:1.25px 0 0 #c8cccf,-1.25px 0 0 #c8cccf,0 1.25px 0 #c8cccf,0 -1.25px 0 #c8cccf;position:absolute;top:0;left:0;width:inherit;height:inherit;font-size:1.85rem;line-height:inherit;text-align:center;text-indent:0}ul.icons li a:hover:before{text-shadow:1.25px 0 0 #ff7496,-1.25px 0 0 #ff7496,0 1.25px 0 #ff7496,0 -1.25px 0 #ff7496}ul.icons li a:hover{border-color:#ff7496}@media screen and (max-width:480px){ul.icons li a:before{font-size:1.5rem}}ul.actions{cursor:default;padding-left:0}ul.actions li{display:inline-block;padding:0 .75em 0 0;vertical-align:middle}ul.actions li:last-child{padding-right:0}dl{margin:0 0 1.5em}dl dt{display:block;margin:0 0 .75em}dl dd{margin-left:1.5em}.button,button,input[type=submit],input[type=reset],input[type=button]{-moz-appearance:none;-webkit-appearance:none;-ms-appearance:none;appearance:none;-moz-transition:background-color .2s ease-in-out,border-color .2s ease-in-out,color .2s ease-in-out;-webkit-transition:background-color .2s ease-in-out,border-color .2s ease-in-out,color .2s ease-in-out;-ms-transition:background-color .2s ease-in-out,border-color .2s ease-in-out,color .2s ease-in-out;transition:background-color .2s ease-in-out,border-color .2s ease-in-out,color .2s ease-in-out;display:inline-block;height:2.75em;line-height:2.75em;padding:0 1.5em;background-color:transparent;border-radius:4px;border:1px solid #c8cccf;color:#414f57!important;cursor:pointer;text-align:center;text-decoration:none;white-space:nowrap}#footer,#main{cursor:default;text-align:center}.button:hover,button:hover,input[type=submit]:hover,input[type=reset]:hover,input[type=button]:hover{border-color:#ff7496;color:#ff7496!important}.button.icon,button.icon,input[type=submit].icon,input[type=reset].icon,input[type=button].icon{padding-left:1.35em}.button.icon:before,button.icon:before,input[type=submit].icon:before,input[type=reset].icon:before,input[type=button].icon:before{margin-right:.5em}.button.fit,button.fit,input[type=submit].fit,input[type=reset].fit,input[type=button].fit{display:block;width:100%;margin:0 0 .75em}.button.small,button.small,input[type=submit].small,input[type=reset].small,input[type=button].small{font-size:.8em}.button.big,button.big,input[type=submit].big,input[type=reset].big,input[type=button].big{font-size:1.35em}.button.disabled,.button:disabled,button.disabled,button:disabled,input[type=submit].disabled,input[type=submit]:disabled,input[type=reset].disabled,input[type=reset]:disabled,input[type=button].disabled,input[type=button]:disabled{-moz-pointer-events:none;-webkit-pointer-events:none;-ms-pointer-events:none;pointer-events:none;opacity:.5}#main{max-width:100%;min-width:27em;padding:4.5em 3em 3em;background:#fff;border-radius:4px;opacity:.95;-moz-transform-origin:50% 50%;-webkit-transform-origin:50% 50%;-ms-transform-origin:50% 50%;transform-origin:50% 50%;-moz-transform:rotateX(0);-webkit-transform:rotateX(0);-ms-transform:rotateX(0);transform:rotateX(0);-moz-transition:opacity 1s ease,-moz-transform 1s ease;-webkit-transition:opacity 1s ease,-webkit-transform 1s ease;-ms-transition:opacity 1s ease,-ms-transform 1s ease;transition:opacity 1s ease,transform 1s ease}#main .avatar{display:block;margin-bottom:1.5em}#main .avatar img{display:block;margin:0 auto;border-radius:100%;box-shadow:0 0 0 1.5em #fff}#main .avatar:before{display:block;position:absolute;top:50%;left:-3em;width:calc(100% + 6em);height:1px;z-index:-1;background:#c8cccf}@media screen and (max-width:480px){#main{min-width:0;width:100%;padding:4em 2em 2.5em}#main .avatar:before{left:-2em;width:calc(100% + 4em)}}body.is-loading #main{opacity:0;-moz-transform:rotateX(15deg);-webkit-transform:rotateX(15deg);-ms-transform:rotateX(15deg);transform:rotateX(15deg)}#footer{-moz-align-self:-moz-flex-end;-webkit-align-self:-webkit-flex-end;-ms-align-self:-ms-flex-end;align-self:flex-end;width:100%;padding:1.5em 0 0;color:rgba(255,255,255,.75)}#footer .copyright{margin:0;padding:0;font-size:.9em;list-style:none}#footer .copyright li{display:inline-block;margin:0 0 0 .45em;padding:0 0 0 .85em;border-left:solid 1px rgba(255,255,255,.5);line-height:1}#footer .copyright li:first-child{border-left:0}#wrapper{display:-moz-flex;display:-webkit-flex;display:-ms-flex;display:flex;-moz-align-items:center;-webkit-align-items:center;-ms-align-items:center;align-items:center;-moz-justify-content:space-between;-webkit-justify-content:space-between;-ms-justify-content:space-between;justify-content:space-between;-moz-flex-direction:column;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-moz-perspective:1000px;-webkit-perspective:1000px;-ms-perspective:1000px;perspective:1000px;position:relative;min-height:100%;padding:1.5em;z-index:2}#wrapper>*{z-index:1}#wrapper:before{display:block}@media screen and (max-width:360px){#wrapper{padding:.75em}}body.is-ie #wrapper{height:100%}
		</style>
		<noscript>
			<style>
				body:after{display:none}#main{-moz-transform:none!important;-webkit-transform:none!important;-ms-transform:none!important;transform:none!important;opacity:1!important}
			</style>
		</noscript>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class="avatar" id="button">
                                <div class="thin" style="color:#c7c7c7; font-size: 12px;">
                                    CREATING THE VIDEO... <br />
                                </div>
								<div class="preloader-wrapper active">
									<div class="spinner-layer spinner-red-only">
										<div class="circle-clipper left">
											<div class="circle"></div>
										</div><div class="gap-patch">
											<div class="circle"></div>
										</div><div class="circle-clipper right">
											<div class="circle"></div>
										</div>
									</div>
								</div>
							</span>
                            <h1>SPEED: <?= $fps ?>fps</h1>
                            <p><?= $property ?></p>
						</header>
					</section>
				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; ListingZen</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script>
			!function(a){"use strict";a.matchMedia=a.matchMedia||function(a){var b,c=a.documentElement,d=c.firstElementChild||c.firstChild,e=a.createElement("body"),f=a.createElement("div");return f.id="mq-test-1",f.style.cssText="position:absolute;top:-100em",e.style.background="none",e.appendChild(f),function(a){return f.innerHTML='&shy;<style media="'+a+'"> #mq-test-1 { width: 42px; }</style>',c.insertBefore(e,d),b=42===f.offsetWidth,c.removeChild(e),{matches:b,media:a}}}(a.document)}(this),function(a){"use strict";function b(){v(!0)}var c={};a.respond=c,c.update=function(){};var d=[],e=function(){var b=!1;try{b=new a.XMLHttpRequest}catch(c){b=new a.ActiveXObject("Microsoft.XMLHTTP")}return function(){return b}}(),f=function(a,b){var c=e();c&&(c.open("GET",a,!0),c.onreadystatechange=function(){4!==c.readyState||200!==c.status&&304!==c.status||b(c.responseText)},4!==c.readyState&&c.send(null))},g=function(a){return a.replace(c.regex.minmaxwh,"").match(c.regex.other)};if(c.ajax=f,c.queue=d,c.unsupportedmq=g,c.regex={media:/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi,keyframes:/@(?:\-(?:o|moz|webkit)\-)?keyframes[^\{]+\{(?:[^\{\}]*\{[^\}\{]*\})+[^\}]*\}/gi,comments:/\/\*[^*]*\*+([^/][^*]*\*+)*\//gi,urls:/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,findStyles:/@media *([^\{]+)\{([\S\s]+?)$/,only:/(only\s+)?([a-zA-Z]+)\s?/,minw:/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,maxw:/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,minmaxwh:/\(\s*m(in|ax)\-(height|width)\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/gi,other:/\([^\)]*\)/g},c.mediaQueriesSupported=a.matchMedia&&null!==a.matchMedia("only all")&&a.matchMedia("only all").matches,!c.mediaQueriesSupported){var h,i,j,k=a.document,l=k.documentElement,m=[],n=[],o=[],p={},q=30,r=k.getElementsByTagName("head")[0]||l,s=k.getElementsByTagName("base")[0],t=r.getElementsByTagName("link"),u=function(){var a,b=k.createElement("div"),c=k.body,d=l.style.fontSize,e=c&&c.style.fontSize,f=!1;return b.style.cssText="position:absolute;font-size:1em;width:1em",c||(c=f=k.createElement("body"),c.style.background="none"),l.style.fontSize="100%",c.style.fontSize="100%",c.appendChild(b),f&&l.insertBefore(c,l.firstChild),a=b.offsetWidth,f?l.removeChild(c):c.removeChild(b),l.style.fontSize=d,e&&(c.style.fontSize=e),a=j=parseFloat(a)},v=function(b){var c="clientWidth",d=l[c],e="CSS1Compat"===k.compatMode&&d||k.body[c]||d,f={},g=t[t.length-1],p=(new Date).getTime();if(b&&h&&q>p-h)return a.clearTimeout(i),i=a.setTimeout(v,q),void 0;h=p;for(var s in m)if(m.hasOwnProperty(s)){var w=m[s],x=w.minw,y=w.maxw,z=null===x,A=null===y,B="em";x&&(x=parseFloat(x)*(x.indexOf(B)>-1?j||u():1)),y&&(y=parseFloat(y)*(y.indexOf(B)>-1?j||u():1)),w.hasquery&&(z&&A||!(z||e>=x)||!(A||y>=e))||(f[w.media]||(f[w.media]=[]),f[w.media].push(n[w.rules]))}for(var C in o)o.hasOwnProperty(C)&&o[C]&&o[C].parentNode===r&&r.removeChild(o[C]);o.length=0;for(var D in f)if(f.hasOwnProperty(D)){var E=k.createElement("style"),F=f[D].join("\n");E.type="text/css",E.media=D,r.insertBefore(E,g.nextSibling),E.styleSheet?E.styleSheet.cssText=F:E.appendChild(k.createTextNode(F)),o.push(E)}},w=function(a,b,d){var e=a.replace(c.regex.comments,"").replace(c.regex.keyframes,"").match(c.regex.media),f=e&&e.length||0;b=b.substring(0,b.lastIndexOf("/"));var h=function(a){return a.replace(c.regex.urls,"$1"+b+"$2$3")},i=!f&&d;b.length&&(b+="/"),i&&(f=1);for(var j=0;f>j;j++){var k,l,o,p;i?(k=d,n.push(h(a))):(k=e[j].match(c.regex.findStyles)&&RegExp.$1,n.push(RegExp.$2&&h(RegExp.$2))),o=k.split(","),p=o.length;for(var q=0;p>q;q++)l=o[q],g(l)||m.push({media:l.split("(")[0].match(c.regex.only)&&RegExp.$2||"all",rules:n.length-1,hasquery:l.indexOf("(")>-1,minw:l.match(c.regex.minw)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:l.match(c.regex.maxw)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}v()},x=function(){if(d.length){var b=d.shift();f(b.href,function(c){w(c,b.href,b.media),p[b.href]=!0,a.setTimeout(function(){x()},0)})}},y=function(){for(var b=0;b<t.length;b++){var c=t[b],e=c.href,f=c.media,g=c.rel&&"stylesheet"===c.rel.toLowerCase();e&&g&&!p[e]&&(c.styleSheet&&c.styleSheet.rawCssText?(w(c.styleSheet.rawCssText,e,f),p[e]=!0):(!/^([a-zA-Z:]*\/\/)/.test(e)&&!s||e.replace(RegExp.$1,"").split("/")[0]===a.location.host)&&("//"===e.substring(0,2)&&(e=a.location.protocol+e),d.push({href:e,media:f})))}x()};y(),c.update=y,c.getEmValue=u,a.addEventListener?a.addEventListener("resize",b,!1):a.attachEvent&&a.attachEvent("onresize",b)}}(this);
			</script><![endif]-->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
				var data = {
					musicUrl: "<?= $musicUrl ?>",
					urls: <?= json_encode($images, JSON_FORCE_OBJECT) ?>,
					profile_image: "<?= $profile_image ?>",
					property: "<?= $property ?>",
					line_1: "<?= $line_1 ?>",
					line_2: "<?= $line_2 ?>",
					line_3: "<?= $line_3 ?>",
					fps: <?= $fps ?>
				};
				console.log(data)

				$.post('/images/ffmpeg-image-to-video/imageToVideo.php', data, function(response) {
                    var res = JSON.parse(response)
                    console.log(res)
                    $("#button").html("<a href='https://shootinglacloud.com/images/ffmpeg-image-to-video/"+res.link+"' class='btn-floating btn-large waves-effect waves-light red' download><i class='material-icons large'>file_download</i></a>")
                    console.log('images/ffmpeg-image-to-video/'+res.link)
//                    window.location.href = '/images/ffmpeg-image-to-video/'+res.link
				}).error(function(data) {
					console.log(data)
				});


			</script>
	</body>
</html>
