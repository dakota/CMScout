(function(F){if(/1\.(0|1|2)\.(0|1|2)/.test(F.fn.jquery)||/^1.1/.test(F.fn.jquery)){alert("blockUI requires jQuery v1.2.3 or later!  You are using v"+F.fn.jquery);return }F.blockUI=function(M){C(window,M)};F.unblockUI=function(M){G(window,M)};F.fn.block=function(M){return this.each(function(){if(F.css(this,"position")=="static"){this.style.position="relative"}if(F.browser.msie){this.style.zoom=1}C(this,M)})};F.fn.unblock=function(M){return this.each(function(){G(this,M)})};F.blockUI.version=2.09;F.blockUI.defaults={message:"<h1>Please wait...</h1>",css:{padding:0,margin:0,width:"30%",top:"40%",left:"35%",textAlign:"center",color:"#000",border:"3px solid #aaa",backgroundColor:"#fff",cursor:"wait"},overlayCSS:{backgroundColor:"#000",opacity:"0.6"},baseZ:1000,centerX:true,centerY:true,allowBodyStretch:true,constrainTabKey:true,fadeOut:400,focusInput:true,applyPlatformOpacityRules:true,onUnblock:null};var D=F.browser.msie&&/MSIE 6.0/.test(navigator.userAgent);var B=null;var E=[];function C(O,M){var X=(O==window);var P=M&&M.message!==undefined?M.message:undefined;M=F.extend({},F.blockUI.defaults,M||{});M.overlayCSS=F.extend({},F.blockUI.defaults.overlayCSS,M.overlayCSS||{});var W=F.extend({},F.blockUI.defaults.css,M.css||{});P=P===undefined?M.message:P;if(X&&B){G(window,{fadeOut:0})}if(P&&typeof P!="string"&&(P.parentNode||P.jquery)){var R=P.jquery?P[0]:P;var V={};F(O).data("blockUI.history",V);V.el=R;V.parent=R.parentNode;V.display=R.style.display;V.position=R.style.position;V.parent.removeChild(R)}var Y=M.baseZ;var U=(F.browser.msie)?F('<iframe class="blockUI" style="z-index:'+Y+++';border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="javascript:false;"></iframe>'):F('<div class="blockUI" style="display:none"></div>');var T=F('<div class="blockUI blockOverlay" style="z-index:'+Y+++';cursor:wait;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>');var Q=X?F('<div class="blockUI blockMsg blockPage" style="z-index:'+Y+';position:fixed"></div>'):F('<div class="blockUI blockMsg blockElement" style="z-index:'+Y+';display:none;position:absolute"></div>');if(P){Q.css(W)}if(!M.applyPlatformOpacityRules||!(F.browser.mozilla&&/Linux/.test(navigator.platform))){T.css(M.overlayCSS)}T.css("position",X?"fixed":"absolute");if(F.browser.msie){U.css("opacity","0.0")}F([U[0],T[0],Q[0]]).appendTo(X?"body":O);var a=F.browser.msie&&(!F.boxModel||F("object,embed",X?null:O).length>0);if(D||a){if(X&&M.allowBodyStretch&&F.boxModel){F("html,body").css("height","100%")}if((D||!F.boxModel)&&!X){var b=J(O,"borderTopWidth"),S=J(O,"borderLeftWidth");var Z=b?"(0 - "+b+")":0;var N=S?"(0 - "+S+")":0}F.each([U,T,Q],function(c,e){var d=e[0].style;d.position="absolute";if(c<2){X?d.setExpression("height",'document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + "px"'):d.setExpression("height",'this.parentNode.offsetHeight + "px"');X?d.setExpression("width",'jQuery.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"'):d.setExpression("width",'this.parentNode.offsetWidth + "px"');if(N){d.setExpression("left",N)}if(Z){d.setExpression("top",Z)}}else{if(M.centerY){if(X){d.setExpression("top",'(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"')}d.marginTop=0}}})}Q.append(P).show();if(P&&(P.jquery||P.nodeType)){F(P).show()}I(1,O,M);if(X){B=Q[0];E=F(":input:enabled:visible",B);if(M.focusInput){setTimeout(L,20)}}else{A(Q[0],M.centerX,M.centerY)}}function G(O,P){var N=O==window;var Q=F(O).data("blockUI.history");P=F.extend({},F.blockUI.defaults,P||{});I(0,O,P);var M=N?F("body").children().filter(".blockUI"):F(".blockUI",O);if(N){B=E=null}if(P.fadeOut){M.fadeOut(P.fadeOut);setTimeout(function(){H(M,Q,P,O)},P.fadeOut)}else{H(M,Q,P,O)}}function H(M,P,O,N){M.each(function(Q,R){if(this.parentNode){this.parentNode.removeChild(this)}});if(P&&P.el){P.el.style.display=P.display;P.el.style.position=P.position;P.parent.appendChild(P.el);F(P.el).removeData("blockUI.history")}if(typeof O.onUnblock=="function"){O.onUnblock(N,O)}}function I(M,Q,R){var P=Q==window,O=F(Q);if(!M&&(P&&!B||!P&&!O.data("blockUI.isBlocked"))){return }if(!P){O.data("blockUI.isBlocked",M)}var N="mousedown mouseup keydown keypress click";M?F(document).bind(N,R,K):F(document).unbind(N,K)}function K(P){if(P.keyCode&&P.keyCode==9){if(B&&P.data.constrainTabKey){var O=E;var N=!P.shiftKey&&P.target==O[O.length-1];var M=P.shiftKey&&P.target==O[0];if(N||M){setTimeout(function(){L(M)},10);return false}}}if(F(P.target).parents("div.blockMsg").length>0){return true}return F(P.target).parents().children().filter("div.blockUI").length==0}function L(M){if(!E){return }var N=E[M===true?E.length-1:0];if(N){N.focus()}}function A(Q,M,S){var R=Q.parentNode,P=Q.style;var N=((R.offsetWidth-Q.offsetWidth)/2)-J(R,"borderLeftWidth");var O=((R.offsetHeight-Q.offsetHeight)/2)-J(R,"borderTopWidth");if(M){P.left=N>0?(N+"px"):"0"}if(S){P.top=O>0?(O+"px"):"0"}}function J(M,N){return parseInt(F.css(M,N))||0}})(jQuery);