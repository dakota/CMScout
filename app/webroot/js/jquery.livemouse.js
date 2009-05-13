(function($){
        var contains = document.compareDocumentPosition ?  function(a, b){
                return a.compareDocumentPosition(b) & 16;
        } : function(a, b){
                return a !== b && (a.contains ? a.contains(b) : true);
        },
        oldLive = $.fn.live,
        oldDie = $.fn.die;

        function createEnterLeaveFn(fn, type){
                return jQuery.event.proxy(fn, function(e) {
                                if( this !== e.relatedTarget && !contains(this, e.relatedTarget) )
                                {
                                        e.type = type;
                                        fn.apply(this, arguments);
                                }
                        });
        }
        function createBubbleFn(fn, type){
                return jQuery.event.proxy(fn, function(e) {
                                var parent = this.parentNode;
                                fn.apply(this, arguments);
                                if( parent ){
                                        e.type = type;
                                        $(parent).trigger(e);
                                }
                        });
        }
        var enterLeaveTypes = {
                mouseenter: 'mouseover',
                mouseleave: 'mouseout'
        };

        $.fn.live = function(types, fn, bubble){
                var that = this;
                $.each(types.split(' '), function(i, type){
                        var proxy = fn;
                        if(bubble){
                                proxy = createBubbleFn(proxy, enterLeaveTypes[type] || type);
                        }

                        if(enterLeaveTypes[type]){
                                proxy = createEnterLeaveFn(proxy, type);
                                type = enterLeaveTypes[type];
                        }
                        oldLive.call(that, type, proxy);
                        return this;
                });
        };

        $.fn.die = function(type, fn){
                if(/mouseenter|mouseleave/.test(t.type)){
                        if(type == 'mouseenter'){
                                type = 'mouseover';
                        } else {
                                type = 'mouseout';
                        }
                }
                oldDie.call(this, type, fn);
                return this;
        };

})(jQuery); 