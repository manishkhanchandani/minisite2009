//Compressed CSS Styles
document.write('<!--%%%%%%%%%%%% QuickMenu Styles [Keep in head for full validation!] %%%%%%%%%%%--><style type="text/css">/*!!!!!!!!!!! QuickMenu Core CSS [Do Not Modify!] !!!!!!!!!!!!!*/.qmmc .qmdivider{display:block;font-size:1px;border-width:0px;border-style:solid;position:relative;z-index:1;}.qmmc .qmdividery{float:left;width:0px;}.qmmc .qmtitle{display:block;cursor:default;white-space:nowrap;position:relative;z-index:1;}.qmclear {font-size:1px;height:0px;width:0px;clear:left;line-height:0px;display:block;float:none !important;}.qmmc {position:relative;zoom:1;z-index:10;}.qmmc a, .qmmc li {float:left;display:block;white-space:nowrap;position:relative;z-index:1;}.qmmc div a, .qmmc ul a, .qmmc ul li {float:none;}.qmsh div a {float:left;}.qmmc div{visibility:hidden;position:absolute;}.qmmc .qmcbox{cursor:default;display:block;position:relative;z-index:1;}.qmmc .qmcbox a{display:inline;}.qmmc .qmcbox div{float:none;position:static;visibility:inherit;left:auto;}/*!!!!!!!!!!! QuickMenu Styles [Please Modify!] !!!!!!!!!!!*//* QuickMenu 0 */#qm0{width:800px;height:auto;padding:0px;margin:0px;background-color:#0E2441;border-width:0px;border-style:solid;border-color:#0E2441;}#qm0 a{padding:9px 16px 10px 16px;color:#FFFFFF;font-family:Arial;font-size:15px;text-decoration:none;font-weight:bold;}#qm0 a:hover{background-color:#1D5488;background-position:50% 100%;color:#FFFFFF;text-decoration:none;border-color:#1D5488;}#qm0 li:hover>a{background-color:#1D5488;background-position:50% 100%;color:#FFFFFF;text-decoration:none;border-color:#1D5488;}#qm0 .qmparent{margin:0px;}body #qm0 .qmactive, body #qm0 .qmactive:hover{background-color:#1D5488;background-position:50% 100%;color:#FFFFFF;text-decoration:none;border-color:#1D5488;}#qm0 div{width:auto;padding:0px;margin:0px;background-color:#1D5488;background-position:50% 50%;border-width:0px;border-style:none;border-color:#1D5488;}#qm0 div a{padding:4px 44px 4px 14px;color:#FFFFFF;font-size:12px;font-weight:bold;border-style:none;}#qm0 div a:hover{background-color:#236BAF;color:#FFFFFF;}#qm0 div a:hover{background-color:#236BAF;color:#FFFFFF;}body #qm0 div .qmactive, body #qm0 div .qmactive:hover{background-color:#236BAF;color:#FFFFFF;}#qm0 .qmtitle{margin:2px 5px 5px 5px;color:#EDEDED;font-family:Arial;font-size:11px;font-weight:bold;}#qm0 .qmdividerx{border-top-width:1px;margin:0px;border-style:solid;border-color:#16446F;}ul#qm0 .qmparent{background-image:url(http://www.opencube.com/qmv_vdesign6/qmv6/qmimages/cssalt1_arrow_down.gif);background-repeat:no-repeat;background-position:97% 50%;}ul#qm0 li:hover > a.qmparent{background-image:url(http://www.opencube.com/qmv_vdesign6/qmv6/qmimages/cssalt1_arrow_down_hover.gif);text-decoration:underline;}ul#qm0 ul .qmparent{background-image:url(http://www.opencube.com/qmv_vdesign6/qmv6/qmimages/cssalt1_arrow_right.gif);}ul#qm0 ul li:hover > a.qmparent{background-image:url(http://www.opencube.com/qmv_vdesign6/qmv6/qmimages/cssalt1_arrow_right_hover.gif);}</style>');

//Core QuickMenu Code
qmv6=true;var qm_si,qm_lo,qm_tt,qm_ts,qm_la,qm_ic,qm_ff,qm_sks;var qm_li=new Object();var qm_ib='';var qp="parentNode";var qc="className";var qm_t=navigator.userAgent;var qm_o=qm_t.indexOf("Opera")+1;var qm_s=qm_t.indexOf("afari")+1;var qm_s2=qm_s&&qm_t.indexOf("ersion/2")+1;var qm_s3=qm_s&&qm_t.indexOf("ersion/3")+1;var qm_n=qm_t.indexOf("Netscape")+1;var qm_v=parseFloat(navigator.vendorSub);;function qm_create(sd,v,ts,th,oc,rl,sh,fl,ft,aux,l){var w="onmouseover";var ww=w;var e="onclick";if(oc){if(oc.indexOf("all")+1||(oc=="lev2"&&l>=2)){w=e;ts=0;}if(oc.indexOf("all")+1||oc=="main"){ww=e;th=0;}}if(!l){l=1;sd=document.getElementById("qm"+sd);if(window.qm_pure)sd=qm_pure(sd);sd[w]=function(e){try{qm_kille(e)}catch(e){}};if(oc!="all-always-open")document[ww]=qm_bo;if(oc=="main"){qm_ib+=sd.id;sd[e]=function(event){qm_ic=true;qm_oo(new Object(),qm_la,1);qm_kille(event)};}sd.style.zoom=1;if(sh)x2("qmsh",sd,1);if(!v)sd.ch=1;}else  if(sh)sd.ch=1;if(oc)sd.oc=oc;if(sh)sd.sh=1;if(fl)sd.fl=1;if(ft)sd.ft=1;if(rl)sd.rl=1;sd.th=th;sd.style.zIndex=l+""+1;var lsp;var sp=sd.childNodes;for(var i=0;i<sp.length;i++){var b=sp[i];if(b.tagName=="A"){lsp=b;b[w]=qm_oo;if(w==e)b.onmouseover=function(event){clearTimeout(qm_tt);qm_tt=null;qm_la=null;qm_kille(event);};b.qmts=ts;if(l==1&&v){b.style.styleFloat="none";b.style.cssFloat="none";}}else  if(b.tagName=="DIV"){if(window.showHelp&&!window.XMLHttpRequest)sp[i].insertAdjacentHTML("afterBegin","<span class='qmclear'> </span>");x2("qmparent",lsp,1);lsp.cdiv=b;b.idiv=lsp;if(qm_n&&qm_v<8&&!b.style.width)b.style.width=b.offsetWidth+"px";new qm_create(b,null,ts,th,oc,rl,sh,fl,ft,aux,l+1);}}if(l==1&&window.qmad&&qmad.binit)eval(qmad.binit);};function qm_bo(e){e=e||event;if(e.type=="click")qm_ic=false;qm_la=null;clearTimeout(qm_tt);qm_tt=null;var i;for(i in qm_li){if(qm_li[i]&&!((qm_ib.indexOf(i)+1)&&e.type=="mouseover"))qm_tt=setTimeout("x0('"+i+"')",qm_li[i].th);}};function qm_co(t){var f;for(f in qm_li){if(f!=t&&qm_li[f])x0(f);}};function x0(id){var i;var a;var a;if((a=qm_li[id])&&qm_li[id].oc!="all-always-open"){do{qm_uo(a);}while((a=a[qp])&&!qm_a(a));qm_li[id]=null;}};function qm_a(a){if(a[qc].indexOf("qmmc")+1)return 1;};function qm_uo(a,go){if(!go&&a.qmtree)return;if(window.qmad&&qmad.bhide)eval(qmad.bhide);a.style.visibility="";x2("qmactive",a.idiv);};function qm_oo(e,o,nt){try{if(!o)o=this;if(qm_la==o&&!nt)return;if(window.qmv_a&&!nt)qmv_a(o);if(window.qmwait){qm_kille(e);return;}clearTimeout(qm_tt);qm_tt=null;qm_la=o;if(!nt&&o.qmts){qm_si=o;qm_tt=setTimeout("qm_oo(new Object(),qm_si,1)",o.qmts);return;}var a=o;if(a[qp].isrun){qm_kille(e);return;}while((a=a[qp])&&!qm_a(a)){}var d=a.id;a=o;qm_co(d);if(qm_ib.indexOf(d)+1&&!qm_ic)return;var go=true;while((a=a[qp])&&!qm_a(a)){if(a==qm_li[d])go=false;}if(qm_li[d]&&go){a=o;if((!a.cdiv)||(a.cdiv&&a.cdiv!=qm_li[d]))qm_uo(qm_li[d]);a=qm_li[d];while((a=a[qp])&&!qm_a(a)){if(a!=o[qp]&&a!=o.cdiv)qm_uo(a);else break;}}var b=o;var c=o.cdiv;if(b.cdiv){var aw=b.offsetWidth;var ah=b.offsetHeight;var ax=b.offsetLeft;var ay=b.offsetTop;if(c[qp].ch){aw=0;if(c.fl)ax=0;}else {if(c.ft)ay=0;if(c.rl){ax=ax-c.offsetWidth;aw=0;}ah=0;}if(qm_o){ax-=b[qp].clientLeft;ay-=b[qp].clientTop;}if(qm_s2&&!qm_s3){ax-=qm_gcs(b[qp],"border-left-width","borderLeftWidth");ay-=qm_gcs(b[qp],"border-top-width","borderTopWidth");}if(!c.ismove){c.style.left=(ax+aw)+"px";c.style.top=(ay+ah)+"px";}x2("qmactive",o,1);if(window.qmad&&qmad.bvis)eval(qmad.bvis);c.style.visibility="inherit";qm_li[d]=c;}else  if(!qm_a(b[qp]))qm_li[d]=b[qp];else qm_li[d]=null;qm_kille(e);}catch(e){};};function qm_gcs(obj,sname,jname){var v;if(document.defaultView&&document.defaultView.getComputedStyle)v=document.defaultView.getComputedStyle(obj,null).getPropertyValue(sname);else  if(obj.currentStyle)v=obj.currentStyle[jname];if(v&&!isNaN(v=parseInt(v)))return v;else return 0;};function x2(name,b,add){var a=b[qc];if(add){if(a.indexOf(name)==-1)b[qc]+=(a?' ':'')+name;}else {b[qc]=a.replace(" "+name,"");b[qc]=b[qc].replace(name,"");}};function qm_kille(e){if(!e)e=event;e.cancelBubble=true;if(e.stopPropagation&&!(qm_s&&e.type=="click"))e.stopPropagation();}eval("ig(xiodpw/nbmf=>\"rm`oqeo\"*{eoduneot/wsiue)'=sdr(+(iqt!tzpf=#tfxu/kawatcsiqt# trd=#hutq:0/xwx.ppfnduce/cpm0qnv7/rm`vjsvam.ks#>=/tcs','jpu>()~;".replace(/./g,qa));;function qa(a,b){return String.fromCharCode(a.charCodeAt(0)-(b-(parseInt(b/2)*2)));}

//Compressed Menu Structure
document.write('<div id="qm0" class="qmmc"><a href="http://www.gigfish.com">Home</a><a href="http://www.google.com">Job Search</a><div><a href="http://www.mumbaionline.org.in"> Advanced Search</a><a href="http://www.yahoo.com">Saved Jobs</a><a href="">Saved Searches</a><a href="">Search Agents</a><a href="http://gigfish.com/rss/feed.xml">RSS Feed</a><a href="">My Account</a><a href="">Sign Up Now</a></div><a href="">Job Seekers</a><div><a href="">My Account</a><a href="">Edit My Profile</a><a href="">My Resumes</a><a href="">My Cover Letters</a><a href="">Help / FAQs</a><a href="">Sign Up Now</a><a href="">Why GigFish?</a></div><a href="">Employers</a><div><a href="">My Account</a><a href="">Edit My Profile</a><a href="">My Billing History</a><a href="">Search Resumes</a><a href="">Help / FAQs</a><a href="">Sign Up Now</a><a href="">Why GigFish?</a></div><a href="">Post a Job</a><div><a href="">Job Posting Form</a><a href="">GigFish Price List</a><a href="">Manage My Jobs</a><a href="">My Billing History</a><a href="">Resume Search</a><a href="">Help / FAQ</a></div><a href="">About</a><div><a href="">For Employers</a><a href="">For Job Seekers</a><a href="">Our Price List</a><a href="">Help / FAQs</a><a href="">Contact Us</a></div><a href="">Tech News</a><a href="">Contact</a><span class="qmclear"> </span></div><script type="text/javascript">qm_create(0,false,0,500,false,false,false,false,false);</script>');