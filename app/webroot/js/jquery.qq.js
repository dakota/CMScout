/*!
 * qq - v1.3 - 3/12/2009
 * http://benalman.com/
 * 
 * Copyright (c) 2009 "Cowboy" Ben Alman
 * Licensed under the MIT license
 * http://benalman.com/about/license/
 */

(function($) {
  
  var queues = [],
    
    // A convenient shortcut.
    aps = Array.prototype.slice,
    
    // Internal plugin method references.
    p_qqStart,
    p_qqAdd;
  
  $.qq = function( id, params ) {
    var obj,
      defaults;
    
    if ( typeof id !== 'number' ) {
      params = id;
      id = null;
    }
    
    if ( id ) {
      $.extend( get_obj( id ), params );
      
    } else {
      defaults = {
        delay: 0,
        queue: [],
        oneach: null,
        ondone: null,
        paused: false,
        
        id: queues.length + 1,
        running: false,
        timeout_id: null
      };
      
      obj = $.extend( {}, defaults, params );
      id = queues.push( obj );
      
      if ( !obj.paused ) {
        p_qqStart( id );
      }
    }
    
    return id;
  };
  
  $.qqAdd = p_qqAdd = function() {
    var args = aps.call( arguments ),
      id = args.shift(),
      obj = get_obj( id );
    
    if ( obj ) {
      obj.queue = obj.queue.concat( args );
      
      if ( !obj.paused ) {
        p_qqStart( id );
      }
      
      return id;
    }
    
    return false;
  };
  
  $.fn.qqAdd = function( id ) {
    p_qqAdd( id, this.get() );
    return this;
  };
  
  $.fn.qqAddEach = function( id ) {
    p_qqAdd.apply( $, [ id ].concat( this.get() ) );
    return this;
  };
  
  $.qqPause = function( id ) {
    var obj = get_obj( id );
    
    if ( obj ) {
      stop_queue( obj );
      
      obj.paused = true;
      
      return id;
    }
    
    return false;
  };
  
  $.qqStart = p_qqStart = function( id ) {
    var item,
      obj = get_obj( id );
    
    if ( obj ) {
      obj.paused = false;
      
      if ( !obj.queue.length ) {
        return id;
      }
      
      if ( !obj.running ) {
        obj.running = true;
        
        (function(){
          if ( !obj.queue.length ) {
            stop_queue( obj );
            obj.ondone && obj.ondone();
            return;
          }
          
          item = obj.queue.shift();
          if ( obj.oneach && obj.oneach( item ) === false ) {
            obj.queue.unshift( item );
          }
          
          if ( typeof obj.delay === 'number' && obj.delay >= 0 ) {
            obj.timeout_id = setTimeout( arguments.callee, obj.delay );
          }
        })();
      }
      
      return id;
    }
    
    return false;
  };
  
  $.qqClear = function( id ) {
    var obj = get_obj( id );
    
    if ( obj ) {
      stop_queue( obj );
      
      obj.queue = [];
      
      return id;
    }
    return false;
  };
  
  $.qqNext = function( id, item ) {
    var obj = get_obj( id );
    
    if ( obj ) {
      if ( obj.paused ) {
        return false;
      }
      
      if ( item ) {
        obj.queue.unshift( item );
      }
      
      obj.running = false;
      
      if ( !obj.queue.length ) {
        stop_queue( obj );
        obj.ondone && obj.ondone();
      }
      
      return p_qqStart( id );
    }
    return false;
  };
  
  function get_obj( id ) {
    return typeof id === 'number' && queues[id - 1];
  };
  
  function stop_queue( obj ) {
    obj.timeout_id && clearTimeout( obj.timeout_id );
    
    obj.timeout_id = null;
    obj.running = false;
  };
  
})(jQuery);