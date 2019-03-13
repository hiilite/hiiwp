(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
	typeof define === 'function' && define.amd ? define(factory) :
	(global.cssScrollSnapPolyfill = factory());
}(this, (function () { 'use strict';

/*!
 * Polyfill.js - v0.1.0
 *
 * Copyright (c) 2015 Philip Walton <http://philipwalton.com>
 * Released under the MIT license
 *
 * Date: 2015-06-21
 */
!function(a,b,c){"use strict";function d(a){return a.replace(/^\s+|\s+$/g,"")}function e(a,b){var c,d=0;if(!a||!b)return!1;for(;c=b[d++];)if(a===c)return!0;return!1}function f(a){return j.test(a)}function g(a){var b,c=0;for(this._rules=[];b=a[c++];)this._rules.push(new h(b));}function h(a){this._rule=a;}function i(a){return this instanceof i?(this._options=a, a.keywords||(this._options={keywords:a}), this._promise=[], this._getStylesheets(), this._downloadStylesheets(), this._parseStylesheets(), this._filterCSSByKeywords(), this._buildMediaQueryMap(), this._reportInitialMatches(), void this._addMediaListeners()):new i(a)}var j=RegExp("^"+String({}.valueOf).replace(/[.*+?\^${}()|\[\]\\]/g,"\\$&").replace(/valueOf|for [^\]]+/g,".+?")+"$"),k=function(){var a=b.getElementsByTagName("base")[0],c=/^([a-zA-Z:]*\/\/)/;return function(b){var d=!c.test(b)&&!a||b.replace(RegExp.$1,"").split("/")[0]===location.host;return d}}(),l={matchMedia:a.matchMedia&&a.matchMedia("only all").matches,nativeMatchMedia:f(a.matchMedia)},m=function(){function b(a){for(var b,c=0;b=a[c++];)i[b]||e(b,j)||j.push(b);}function c(){if(0===m.readyState||4===m.readyState){var a;(a=j[0])&&d(a), a||g();}}function d(a){l++, m.open("GET",a,!0), m.onreadystatechange=function(){4!=m.readyState||200!=m.status&&304!=m.status||(i[a]=m.responseText,j.shift(),c());}, m.send(null);}function f(a){for(var b,c=0,d=0;b=a[c++];)i[b]&&d++;return d===a.length}function g(){for(var a;a=k.shift();)h(a.urls,a.fn);}function h(a,b){for(var c,d=[],e=0;c=a[e++];)d.push(i[c]);b.call(null,d);}var i={},j=[],k=[],l=0,m=function(){var b;try{b=new a.XMLHttpRequest;}catch(c){b=new a.ActiveXObject("Microsoft.XMLHTTP");}return b}();return{request:function(a,d){k.push({urls:a,fn:d}), f(a)?g():(b(a),c());},clearCache:function(){i={};},_getRequestCount:function(){return l}}}(),n={_cache:{},clearCache:function(){n._cache={};},parse:function(a,b){function c(){return g(/^\{\s*/)}function e(){return g(/^\}\s*/)}function f(){var b,c=[];for(h(), i(c);"}"!=a.charAt(0)&&(b=y()||z());)c.push(b), i(c);return c}function g(b){var c=b.exec(a);if(c)return a=a.slice(c[0].length), c}function h(){g(/^\s*/);}function i(a){a=a||[];for(var b;b=j();)a.push(b);return a}function j(){if("/"==a[0]&&"*"==a[1]){for(var b=2;"*"!=a[b]||"/"!=a[b+1];)++b;b+=2;var c=a.slice(2,b-2);return a=a.slice(b), h(), {comment:c}}}function k(){var a=g(/^([^{]+)/);if(a)return d(a[0]).split(/\s*,\s*/)}function l(){var a=g(/^(\*?[\-\w]+)\s*/);if(a&&(a=a[0], g(/^:\s*/))){var b=g(/^((?:'(?:\\'|.)*?'|"(?:\\"|.)*?"|\([^\)]*?\)|[^};])+)\s*/);if(b)return b=d(b[0]), g(/^[;\s]*/), {property:a,value:b}}}function m(){for(var a,b=[];a=g(/^(from|to|\d+%|\.\d+%|\d+\.\d+%)\s*/);)b.push(a[1]), g(/^,\s*/);return b.length?{values:b,declarations:x()}:void 0}function o(){var a=g(/^@([\-\w]+)?keyframes */);if(a){var b=a[1],a=g(/^([\-\w]+)\s*/);if(a){var d=a[1];if(c()){i();for(var f,h=[];f=m();)h.push(f), i();if(e()){var j={name:d,keyframes:h};return b&&(j.vendor=b), j}}}}}function p(){var a=g(/^@supports *([^{]+)/);if(a){var b=d(a[1]);if(c()){i();var h=f();if(e())return{supports:b,rules:h}}}}function q(){var a=g(/^@media *([^{]+)/);if(a){var b=d(a[1]);if(c()){i();var h=f();if(e())return{media:b,rules:h}}}}function r(){var a=g(/^@page */);if(a){var b=k()||[],d=[];if(c()){i();for(var f;f=l()||s();)d.push(f), i();if(e())return{type:"page",selectors:b,declarations:d}}}}function s(){var a=g(/^@([a-z\-]+) */);if(a){var b=a[1];return{type:b,declarations:x()}}}function t(){return w("import")}function u(){return w("charset")}function v(){return w("namespace")}function w(a){var b=g(new RegExp("^@"+a+" *([^;\\n]+);\\s*"));if(b){var c={};return c[a]=d(b[1]), c}}function x(){var a=[];if(c()){i();for(var b;b=l();)a.push(b), i();if(e())return a}}function y(){return o()||q()||p()||t()||u()||v()||r()}function z(){var a=k();if(a)return i(), {selectors:a,declarations:x()}}return b&&n._cache[b]?n._cache[b]:(a=a.replace(/\/\*[\s\S]*?\*\//g,""), n._cache[b]=f())},filter:function(a,b){function c(a,b){return a||b?a?a.concat(b):[b]:void 0}function e(a){null==a.media&&delete a.media, null==a.supports&&delete a.supports, k.push(a);}function f(a,b){if(b)for(var c=b.length;c--;)if(a.indexOf(b[c])>=0)return!0}function g(a,b){for(var c,e,f,g,h=/\*/,i=0;c=b[i++];)if(e=c.split(":"), f=new RegExp("^"+d(e[0]).replace(h,".*")+"$"), g=new RegExp("^"+d(e[1]).replace(h,".*")+"$"), f.test(a.property)&&g.test(a.value))return!0}function h(a,c,d){return b.selectors&&f(a.selectors.join(","),b.selectors)?(e({media:c,supports:d,selectors:a.selectors,declarations:a.declarations}), !0):void 0}function i(a,c,d){if(b.declarations)for(var f,h=0;f=a.declarations[h++];)if(g(f,b.declarations))return e({media:c,supports:d,selectors:a.selectors,declarations:a.declarations}), !0}function j(a,b,d){for(var e,f=0;e=a[f++];)e.declarations?h(e,b,d)||i(e,b,d):e.rules&&e.media?j(e.rules,c(b,e.media),d):e.rules&&e.supports&&j(e.rules,b,c(d,e.supports));}var k=[];return j(a), k}},o=function(){function c(){if(f)return f;var a=b.documentElement,c=b.body,d=a.style.fontSize,e=c.style.fontSize,g=b.createElement("div");return a.style.fontSize="1em", c.style.fontSize="1em", c.appendChild(g), g.style.width="1em", g.style.position="absolute", f=g.offsetWidth, c.removeChild(g), c.style.fontSize=e, a.style.fontSize=d, f}function d(b){return a.matchMedia(b)}function e(a){var d,e,f=!1;return g=b.documentElement.clientWidth, h.test(a)&&(d="em"===RegExp.$2?parseFloat(RegExp.$1)*c():parseFloat(RegExp.$1)), i.test(a)&&(e="em"===RegExp.$2?parseFloat(RegExp.$1)*c():parseFloat(RegExp.$1)), d&&e?f=g>=d&&e>=g:(d&&g>=d&&(f=!0),e&&e>=g&&(f=!0)), {matches:f,media:a}}var f,g,h=/\(min\-width:[\s]*([\s]*[0-9\.]+)(px|em)[\s]*\)/,i=/\(max\-width:[\s]*([\s]*[0-9\.]+)(px|em)[\s]*\)/,j={};return{matchMedia:function(a){return l.matchMedia?d(a):e(a)},clearCache:function(){l.nativeMatchMedia||(g=null, j={});}}}(),p=function(){function b(a,b){var c;return function(){clearTimeout(c), c=setTimeout(a,b);}}var c=function(){var a=[];return{add:function(b,c,d){for(var e,f=0;e=a[f++];)if(e.polyfill==b&&e.mql===c&&e.fn===d)return!1;c.addListener(d), a.push({polyfill:b,mql:c,fn:d});},remove:function(b){for(var c,d=0;c=a[d++];)c.polyfill===b&&(c.mql.removeListener(c.fn), a.splice(--d,1));}}}(),d=function(b){function c(){for(var a,c=0;a=b[c++];)a.fn();}return{add:function(d,e){b.length||(a.addEventListener?a.addEventListener("resize",c,!1):a.attachEvent("onresize",c)), b.push({polyfill:d,fn:e});},remove:function(d){for(var e,f=0;e=b[f++];)e.polyfill===d&&b.splice(--f,1);b.length||(a.removeEventListener?a.removeEventListener("resize",c,!1):a.detachEvent&&a.detachEvent("onresize",c));}}}([]);return{removeListeners:function(a){l.nativeMatchMedia?c.remove(a):d.remove(a);},addListeners:function(a,e){function f(){if(l.nativeMatchMedia)for(var f in h)h.hasOwnProperty(f)&&!function(b,d){c.add(a,b,function(){e.call(a,d,b.matches);});}(h[f],f);else{var i=b(function(a,b){return function(){g(a,b);}}(a,h),a._options.debounceTimeout||100);d.add(a,i);}}function g(a,b){var c,d={};o.clearCache();for(c in b)b.hasOwnProperty(c)&&(d[c]=o.matchMedia(c).matches, d[c]!=i[c]&&e.call(a,c,o.matchMedia(c).matches));i=d;}var h=a._mediaQueryMap,i={};!function(){for(var a in h)h.hasOwnProperty(a)&&(i[a]=o.matchMedia(a).matches);}(), f();}}}();g.prototype.each=function(a,b){var c,d=0;for(b||(b=this);c=this._rules[d++];)a.call(b,c);}, g.prototype.size=function(){return this._rules.length}, g.prototype.at=function(a){return this._rules[a]}, h.prototype.getDeclaration=function(){for(var a,b={},c=0,d=this._rule.declarations;a=d[c++];)b[a.property]=a.value;return b}, h.prototype.getSelectors=function(){return this._rule.selectors.join(", ")}, h.prototype.getMedia=function(){return this._rule.media.join(" and ")}, i.prototype.doMatched=function(a){return this._doMatched=a,this._resolve(),this}, i.prototype.undoUnmatched=function(a){return this._undoUnmatched=a,this._resolve(),this}, i.prototype.getCurrentMatches=function(){for(var a,b,c=0,d=[];a=this._filteredRules[c++];)b=a.media&&a.media.join(" and "),(!b||o.matchMedia(b).matches)&&d.push(a);return new g(d)}, i.prototype.destroy=function(){this._undoUnmatched&&(this._undoUnmatched(this.getCurrentMatches()),p.removeListeners(this));}, i.prototype._defer=function(a,b){a.call(this)?b.call(this):this._promise.push({condition:a,callback:b});}, i.prototype._resolve=function(){for(var a,b=0;a=this._promise[b];)a.condition.call(this)?(this._promise.splice(b,1),a.callback.call(this)):b++;}, i.prototype._getStylesheets=function(){var a,c,d,f,g,h,i,j=0,l=[];if(this._options.include){for(c=this._options.include;a=c[j++];)if(d=b.getElementById(a)){if("STYLE"===d.nodeName){i={text:d.textContent},l.push(i);continue}if(d.media&&"print"==d.media)continue;if(!k(d.href))continue;i={href:d.href},d.media&&(i.media=d.media),l.push(i);}}else{for(c=this._options.exclude,f=b.getElementsByTagName("link");d=f[j++];)d.rel&&"stylesheet"==d.rel&&"print"!=d.media&&k(d.href)&&!e(d.id,c)&&(i={href:d.href},d.media&&(i.media=d.media),l.push(i));for(h=b.getElementsByTagName("style"),j=0;g=h[j++];)i={text:g.textContent},l.push(i);}return this._stylesheets=l}, i.prototype._downloadStylesheets=function(){for(var a,b=this,c=[],d=0;a=this._stylesheets[d++];)c.push(a.href);m.request(c,function(a){for(var c,d=0;c=a[d];)b._stylesheets[d++].text=c;b._resolve();});}, i.prototype._parseStylesheets=function(){this._defer(function(){return this._stylesheets&&this._stylesheets.length&&this._stylesheets[0].text},function(){for(var a,b=0;a=this._stylesheets[b++];)a.rules=n.parse(a.text,a.url);});}, i.prototype._filterCSSByKeywords=function(){this._defer(function(){return this._stylesheets&&this._stylesheets.length&&this._stylesheets[0].rules},function(){for(var a,b,c=[],d=0;a=this._stylesheets[d++];)b=a.media,b&&"all"!=b&&"screen"!=b?c.push({rules:a.rules,media:a.media}):c=c.concat(a.rules);this._filteredRules=n.filter(c,this._options.keywords);});}, i.prototype._buildMediaQueryMap=function(){this._defer(function(){return this._filteredRules},function(){var a,b,c=0;for(this._mediaQueryMap={};b=this._filteredRules[c++];)b.media&&(a=b.media.join(" and "),this._mediaQueryMap[a]=o.matchMedia(a));});}, i.prototype._reportInitialMatches=function(){this._defer(function(){return this._filteredRules&&this._doMatched},function(){this._doMatched(this.getCurrentMatches());});}, i.prototype._addMediaListeners=function(){this._defer(function(){return this._filteredRules&&this._doMatched&&this._undoUnmatched},function(){p.addListeners(this,function(a,b){for(var c,d=0,e=[],f=[];c=this._filteredRules[d++];)c.media&&c.media.join(" and ")==a&&(b?e:f).push(c);e.length&&this._doMatched(new g(e)),f.length&&this._undoUnmatched(new g(f));});});}, i.modules={DownloadManager:m,StyleManager:n,MediaManager:o,EventManager:p}, i.constructors={Ruleset:g,Rule:h}, a.Polyfill=i;}(window,document);

const NONE = 'none';
const START = 'start';
const END = 'end';
const CENTER = 'center';
const LENGTH_PERCENTAGE_REGEX = /(\d+)(px|vh|vw|%)/g;

/**
 * constraint to jumping to the next snap-point.
 * when scrolling further than SNAP_CONSTRAINT snap-points,
 * but the current distance is less than 1-0.18 (read: 18 percent),
 * the snap-will go back to the closer snap-point.
 */
const CONSTRAINT_DECIMAL = 0.18;
/**
 * time in ms after which scrolling is considered finished.
 * the scroll timeouts are timed with this.
 * whenever a new scroll event is triggered, the previous timeout is deleted.
 * @type {Number}
 */
const SCROLL_TIMEOUT = 45;

/**
 * time for the smooth scrolling
 * @type {Number}
 */
const SCROLL_TIME = 350;

/**
 * doMatched is a callback for Polyfill to fill in the desired behaviour.
 * @param  {array} rules rules found for the polyfill
 */
function doMatched(rules) {
  // iterate over rules
  rules.each((rule) => {

    const elements = document.querySelectorAll(rule.getSelectors());
    const declaration = rule.getDeclaration();

    // iterate over elements
    [].forEach.call(elements, (el) => {
      // set up the behaviour
      setUpElement(el, declaration);
    });
  });
}

/**
 * unDomatched is a callback for polyfill to undo any polyfilled behaviour
 * @param  {Object} rules
 */
function undoUnmatched(rules) {
  // iterate over rules
  rules.each((rule) => {
    const elements = document.querySelectorAll(rule.getSelectors());

    // iterate over elements
    [].forEach.call(elements, (el) => {
      // tear down the behaviour
      tearDownElement(el);
    });
  });
}

/**
 * set up an element for scroll-snap behaviour
 * @param {Object} el           HTML element
 * @param {Object} declaration  CSS declarations
 */
function setUpElement(el, declaration) {
  // if this is a scroll-snap element in a scroll snap container, attach to the container only.
  if (typeof declaration['scroll-snap-align'] !== 'undefined') {
    // save declaration
    el.scrollSnapAlignment = parseScrollSnapAlignment(declaration);

    return attachToScrollParent(el)
  }

  // if the scroll snap attributes are applied on the body/html tag, use the doc for scroll events.
  const tag = el.tagName;
  if (tag.toLowerCase() == "body" ||
      tag.toLowerCase() == "html") {
    el = document;
  }

  // add the event listener
  el.addEventListener('scroll', handler, false);

  // set up scroll padding
  el.scrollPadding = parseScrollPadding(declaration);

  // save declaration
  // if (typeof declaration['scroll-snap-destination'] !== 'undefined') {
  //   el.snapLengthUnit = parseSnapCoordValue(declaration);
  // } else {
  //   el.snapLengthUnit = parseSnapPointValue(declaration);
  // }

  // init possible elements
  el.snapElements = [];
}

/**
 * tear down an element. remove all added behaviour.
 * @param  {Object} el DomElement
 */
function tearDownElement(el) {
  // if the scroll snap attributes are applied on the body/html tag, use the doc for scroll events.
  const tag = el.tagName;

  if (tag.toLowerCase() == "body" ||
      tag.toLowerCase() == "html") {
    el = document;
  }

  document.removeEventListener('scroll', handler, false);
  el.removeEventListener('scroll', handler, false);

  el.snapLengthUnit = null;
  el.snapElements = [];
}

/**
 * parse snap alignment values.
 * @param  {Object} declaration
 * @return {Object}
 */
function parseScrollSnapAlignment(declaration) {
  const { 'scroll-snap-align': snapAlign } = declaration;
  let xAlign = NONE;
  let yAlign = NONE;

  if (typeof snapAlign !== 'undefined') {
    // calculate scroll snap align
    const parts = snapAlign.split(' ');
    xAlign = parts[0];
    yAlign = parts.length > 1 ? parts[1] : xAlign;
  }

  return {
    x: xAlign,
    y: yAlign
  }
}

function parseLengthPercentage(strValue) {
  // regex to parse lengths
  const result = LENGTH_PERCENTAGE_REGEX.exec(strValue);
  // if result is null return default values
  if (result === null) return { value: 0, unit: 'px' }

  const [_, value, unit] = result;
  return { value: parseInt(value, 10), unit }
}

/**
 * parse scroll padding values.
 * @param  {Object} declaration
 * @return {Object}
 */
function parseScrollPadding(declaration) {
  const {
    'scroll-padding': scrollPadding,
    'scroll-padding-top': scrollPaddingTop,
    'scroll-padding-right': scrollPaddingRight,
    'scroll-padding-bottom': scrollPaddingBottom,
    'scroll-padding-left': scrollPaddingLeft
  } = declaration;
  let paddingTop = { value: 0, unit: 'px' };
  let paddingRight = { value: 0, unit: 'px' };
  let paddingBottom = { value: 0, unit: 'px' };
  let paddingLeft = { value: 0, unit: 'px' };

  if (typeof scrollPadding !== 'undefined') {
    // regex to parse lengths
    const parts = scrollPadding.split(' ');
    parts.forEach((part, i) => {
      const value = parseLengthPercentage(part);
      switch (i) {
        case 0:
          paddingTop = value;
          paddingRight = value;
          paddingBottom = value;
          paddingLeft = value;
          break;
        case 1:
          paddingRight = value;
          paddingLeft = value;
          break;
        case 2:
          paddingBottom = value;
          break;
        case 3:
          paddingLeft = value;
          break;
        default:
      }
    });
  }

  if (typeof scrollPaddingTop !== 'undefined') {
    paddingTop = parseLengthPercentage(scrollPaddingTop);
  }
  if (typeof scrollPaddingRight !== 'undefined') {
    paddingRight = parseLengthPercentage(scrollPaddingRight);
  }
  if (typeof scrollPaddingBottom !== 'undefined') {
    paddingBottom = parseLengthPercentage(scrollPaddingBottom);
  }
  if (typeof scrollPaddingLeft !== 'undefined') {
    paddingLeft = parseLengthPercentage(scrollPaddingLeft);
  }

  return {
    top: paddingTop,
    right: paddingRight,
    bottom: paddingBottom,
    left: paddingLeft,
  }
}

/**
 * attach a child-element onto a scroll-container
 * @param  {Object} el
 */
function attachToScrollParent(el) {
  var attach = el;
  // iterate over parent elements
  for ( ; el && el !== document; el = el.parentNode ) {
    if (typeof el.snapElements !== 'undefined') {
      el.snapElements.push(attach);
    }
  }
}


/**
 * the last created timeOutId for scroll event timeouts.
 * @type int
 */
let timeOutId = null;

/**
 * starting point for current scroll
 * @type length
 */
let scrollStart = null;

/**
 * the last object receiving a scroll event
 */
let lastObj;
let lastScrollObj;

/**
 * scroll handler
 * this is the callback for scroll events.
 */
let handler = function(evt) {
  // use evt.target as target-element
  lastObj = evt.target;
  lastScrollObj = getScrollObj(lastObj);

  // if currently animating, stop it. this prevents flickering.
  if (animationFrame) {
    // cross browser
    if (!cancelAnimationFrame(animationFrame)) {
      clearTimeout(animationFrame);
    }
  }

  // if a previous timeout exists, clear it.
  if (timeOutId) {
    // we only want to call a timeout once after scrolling..
    clearTimeout(timeOutId);
  } else {
    // save new scroll start
    scrollStart = {
      y: lastScrollObj.scrollTop,
      x: lastScrollObj.scrollLeft
    };
  }

  /* set a timeout for every scroll event.
   * if we have new scroll events in that time, the previous timeouts are cleared.
   * thus we can be sure that the timeout will be called 50ms after the last scroll event.
   * this means a huge improvement in speed, as we just assign a timeout in the scroll event, which will be called only once (after scrolling is finished)
   */
  timeOutId = setTimeout(handlerDelayed, SCROLL_TIMEOUT);
};

/**
 * a delayed handler for scrolling.
 * this will be called by setTimeout once, after scrolling is finished.
 */
let handlerDelayed = function() {
  // if we don't move a thing, we can ignore the timeout: if we did, there'd be another timeout added for scrollStart+1.
  if (scrollStart.y == lastScrollObj.scrollTop && scrollStart.x == lastScrollObj.scrollLeft) {
    // ignore timeout
    return;
  }

  // detect direction of scroll. negative is up, positive is down.
  let direction = {
    y: (scrollStart.y - lastScrollObj.scrollTop > 0) ? -1 : 1,
    x: (scrollStart.x - lastScrollObj.scrollLeft > 0) ? -1 : 1
  };
  let snapPoint;

  if (typeof lastScrollObj.snapElements !== 'undefined' && lastScrollObj.snapElements.length > 0) {
    snapPoint = getNextElementSnapPoint(lastScrollObj, lastObj, direction);
  }

  // before doing the move, unbind the event handler (otherwise it calls itself kinda)
  lastObj.removeEventListener('scroll', handler, false);

  // smoothly move to the snap point
  smoothScroll(lastScrollObj, snapPoint, function() {
    // after moving to the snap point, rebind the scroll event handler
    lastObj.addEventListener('scroll', handler, false);
  });

  // we just jumped to the snapPoint, so this will be our next scrollStart
  if (!isNaN(snapPoint.x) || !isNaN(snapPoint.y)) {
    scrollStart = snapPoint;
  }
};


var currentIteratedObj = null;
var currentIteration = 0;

function toPx(value, unit, containerEl) {
  if (unit && unit.toLowerCase() === 'vw') {
    return getWidth(document.documentElement) * (value / 100);
  }
  if (unit && unit.toLowerCase() === 'vh') {
    return getHeight(document.documentElement) * (value / 100);
  }
  if (unit && unit === '%') {
    return getWidth(containerEl) * (value / 100);
  }
  return value;
}

function getNextElementSnapPoint(scrollObj, obj, direction) {
  var l = obj.snapElements.length,
      top = scrollObj.scrollTop,
      left = scrollObj.scrollLeft,
      // decide upon an iteration direction (favor -1, as 1 is default and will be applied when there is no direction on an axis)
      primaryDirection = Math.min(direction.y, direction.x),
      snapCoords = {y: 0, x: 0};
  const { top: paddingTop, right: paddingRight, bottom: paddingBottom, left: paddingLeft } = scrollObj.scrollPadding;
  const pTop = roundByDirection(direction, toPx(paddingTop.value, paddingTop.unit, scrollObj));
  const pRight = roundByDirection(direction, toPx(paddingRight.value, paddingRight.unit, scrollObj));
  const pBottom = roundByDirection(direction, toPx(paddingBottom.value, paddingBottom.unit, scrollObj));
  const pLeft = roundByDirection(direction, toPx(paddingLeft.value, paddingLeft.unit, scrollObj));
  function adjustForPadding(value, adjustment) {
    if (currentIteration === 0 || currentIteration === l - 1) {
      return value;
    }
    return value - adjustment;
  }

  // handle use-case where scrolling to end
  if ((left > 0 && (left + getWidth(scrollObj)) === getScrollWidth(scrollObj)) || (top > 0 && (top + getHeight(scrollObj)) === getScrollHeight(scrollObj))) {
    currentIteration = l-1;
    const lastSnapElement = obj.snapElements[currentIteration];
    const lastSnapCoords = {
      x: (getLeft(lastSnapElement) - getLeft(scrollObj)) + getXSnapLength(lastSnapElement, lastSnapElement.scrollSnapAlignment.x, direction),
      y: (getTop(lastSnapElement) - getTop(scrollObj)) + getYSnapLength(lastSnapElement, lastSnapElement.scrollSnapAlignment.y, direction)
    };
    lastSnapElement.snapCoords = lastSnapCoords;
    // the for loop stopped at the last element
    return {y: stayInBounds(0, getScrollHeight(scrollObj), lastSnapCoords.y),
            x: stayInBounds(0, getScrollWidth(scrollObj), lastSnapCoords.x)};
  }


  const currentSnapElement = obj.snapElements[currentIteration];
  const currentSnapCoords = {
    x: currentIteration === 0 ? 0 : (getLeft(currentSnapElement) - getLeft(scrollObj)) + getXSnapLength(currentSnapElement, currentSnapElement.scrollSnapAlignment.x, direction) - getXSnapLength(scrollObj, currentSnapElement.scrollSnapAlignment.x, direction),
    y: currentIteration === 0 ? 0 : (getTop(currentSnapElement) - getTop(scrollObj)) + getYSnapLength(currentSnapElement, currentSnapElement.scrollSnapAlignment.y, direction) - getYSnapLength(scrollObj, currentSnapElement.scrollSnapAlignment.y, direction)
  };
  currentSnapElement.snapCoords = currentSnapCoords;
  const xThreshold = currentSnapCoords.x + (direction.x * getWidth(currentSnapElement) * CONSTRAINT_DECIMAL);
  const yThreshold = currentSnapCoords.y + (direction.y * getHeight(currentSnapElement) * CONSTRAINT_DECIMAL);



  for(var i = currentIteration + primaryDirection; i<l && i >= 0; i = i+primaryDirection) {
    currentIteratedObj = obj.snapElements[i];

    // get objects snap coords by adding obj.top + obj.snaplength.y
    snapCoords = {
      y: i === 0 ? 0 : (getTop(currentIteratedObj) - getTop(scrollObj)) + getYSnapLength(currentIteratedObj, currentIteratedObj.scrollSnapAlignment.y, direction) - getYSnapLength(scrollObj, currentIteratedObj.scrollSnapAlignment.y, direction),
      x: i === 0 ? 0 : (getLeft(currentIteratedObj) - getLeft(scrollObj)) + getXSnapLength(currentIteratedObj, currentIteratedObj.scrollSnapAlignment.x, direction) - getXSnapLength(scrollObj, currentIteratedObj.scrollSnapAlignment.x, direction)
    };

    currentIteratedObj.snapCoords = snapCoords;
    // check if object snappoint is "close" enough to scrollable snappoint

    // check if not beyond scroll threshold
    if ((direction.x === 1 ? left < xThreshold : left > xThreshold) &&
      (direction.y === 1 ? top < yThreshold : top > yThreshold)) {
      break;
    }

    const elementXThreshold = snapCoords.x + (direction.x * getWidth(currentIteratedObj) * CONSTRAINT_DECIMAL);
    const elementYThreshold = snapCoords.y + (direction.y * getHeight(currentIteratedObj) * CONSTRAINT_DECIMAL);

    // check if not scrolled past element snap point
    if ((direction.x === 1 ? left > elementXThreshold : left < elementXThreshold) ||
      (direction.y === 1 ? top > elementYThreshold : top < elementYThreshold)) {
      continue;
    }

   // ok, we found a snap point.
   currentIteration = i;
   // stay in bounds (minimum: 0, maxmimum: absolute height)
   return {y: stayInBounds(0, getScrollHeight(scrollObj), adjustForPadding(snapCoords.y, pTop)),
           x: stayInBounds(0, getScrollWidth(scrollObj), adjustForPadding(snapCoords.x, pLeft))};
  }
  // no snap found, use first or last?
  if (primaryDirection == 1 && i === l-1) {
    currentIteration = l-1;
    // the for loop stopped at the last element
    return {y: stayInBounds(0, getScrollHeight(scrollObj), snapCoords.y),
            x: stayInBounds(0, getScrollWidth(scrollObj), snapCoords.x)};
  } else if (primaryDirection == -1 && i === 0) {
    currentIteration = 0;
    // the for loop stopped at the first element
    return {y: stayInBounds(0, getScrollHeight(scrollObj), snapCoords.y),
            x: stayInBounds(0, getScrollWidth(scrollObj), snapCoords.x)};
  }
  // stay in the same place
  return {y: stayInBounds(0, getScrollHeight(scrollObj), adjustForPadding(obj.snapElements[currentIteration].snapCoords.y, pTop)),
          x: stayInBounds(0, getScrollWidth(scrollObj), adjustForPadding(obj.snapElements[currentIteration].snapCoords.x, pLeft))};
}

/**
 * ceil or floor a number based on direction
 * @param  {Number} direction
 * @param  {Number} currentPoint
 * @return {Number}
 */
function roundByDirection(direction, currentPoint) {
  if (direction === -1) {
    // when we go up, we floor the number to jump to the next snap-point in scroll direction
    return Math.floor(currentPoint);
  }
  // go down, we ceil the number to jump to the next in view.
  return Math.ceil(currentPoint);
}

/**
 * keep scrolling in bounds
 * @param  {Number} min
 * @param  {Number} max
 * @param  {Number} destined
 * @return {Number}
 */
function stayInBounds(min, max, destined) {
  return Math.max(Math.min(destined, max), min);
}


/**
 * calc length of one snap on y-axis
 * @param  {Object} declaration the parsed declaration
 * @return {Number}
 */
function getYSnapLength(obj, alignment, direction) {
  if (alignment === START) {
    return 0;
  } else if (alignment === END) {
    return getHeight(obj);
  } else if (alignment === CENTER) {
    return roundByDirection(direction, getHeight(obj) / 2);
  }
  return 0;
}

/**
 * calc length of one snap on x-axis
 * @param  {Object} declaration the parsed declaration
 * @return {Number}
 */
function getXSnapLength(obj, alignment, direction) {
  if (alignment === START) {
    return 0;
  } else if (alignment === END) {
    return getWidth(obj);
  } else if (alignment === CENTER) {
    return roundByDirection(direction, getWidth(obj) / 2);
  }
  return 0;
}

/**
 * get an elements scrollable height
 * @param  {Object} obj
 * @return {Number}
 */
function getScrollHeight(obj) {
  return obj.scrollHeight;
}

/**
 * get an elements scrollable width
 * @param  {Object} obj
 * @return {Number}
 */
function getScrollWidth(obj) {
  return obj.scrollWidth;
}

/**
 * get an elements height
 * @param  {Object} obj
 * @return {Number}
 */
function getHeight(obj) {
  return obj.offsetHeight;
}

/**
 * get an elements width
 * @param  {Object} obj
 * @return {Number}
 */
function getWidth(obj) {
  return obj.offsetWidth;
}

/**
 * get an elements height
 * @param  {Object} obj
 * @return {Number}
 */
function getLeft(obj) {
  return obj.offsetLeft + obj.clientLeft;
}

/**
 * get an elements width
 * @param  {Object} obj
 * @return {Number}
 */
function getTop(obj) {
  return obj.offsetTop + obj.clientTop;
}

/**
 * return the element scrolling values are applied to.
 * when receiving window.onscroll events, the actual scrolling is on the body.
 * @param  {Object} obj
 * @return {Object}
 */
function getScrollObj(obj) {
  // if the scroll container is body, the scrolling is invoked on window/doc.
  if (obj == document || obj == window) {
    // firefox scrolls on doc.documentElement
    if (document.documentElement.scrollTop > 0 || document.documentElement.scrollLeft > 0) {
      return document.documentElement;
    }
    // chrome scrolls on body
    return document.querySelector('body');
  }

  return obj;
}

/**
 * calc the duration of the animation proportional to the distance travelled
 * @param  {Number} start
 * @param  {Number} end
 * @return {Number}       scroll time in ms
 */
function getDuration(start, end) {
  var distance = Math.abs(start - end),
      procDist = 100 / Math.max(document.documentElement.clientHeight, window.innerHeight || 1) * distance,
      duration = 100 / SCROLL_TIME * procDist;

  if (isNaN(duration)) {
    return 0;
  }

  return Math.max(SCROLL_TIME / 1.5, Math.min(duration, SCROLL_TIME));
}

/**
 * ease in out function thanks to:
 * http://blog.greweb.fr/2012/02/bezier-curve-based-easing-functions-from-concept-to-implementation/
 * @param  {Number} t timing
 * @return {Number}   easing factor
 */
var easeInCubic = function(t) {
  return t*t*t;
};


/**
 * calculate the scroll position we should be in
 * @param  {Number} start    the start point of the scroll
 * @param  {Number} end      the end point of the scroll
 * @param  {Number} elapsed  the time elapsed from the beginning of the scroll
 * @param  {Number} duration the total duration of the scroll (default 500ms)
 * @return {Number}          the next position
 */
var position = function(start, end, elapsed, duration) {
    if (elapsed > duration) {
      return end;
    }
    return start + (end - start) * easeInCubic(elapsed / duration);
};

// a current animation frame
var animationFrame = null;

/**
 * smoothScroll function by Alice Lietieur.
 * @see https://github.com/alicelieutier/smoothScroll
 * we use requestAnimationFrame to be called by the browser before every repaint
 * @param  {Object}   obj      the scroll context
 * @param  {Number}  end      where to scroll to
 * @param  {Number}   duration scroll duration
 * @param  {Function} callback called when the scrolling is finished
 */
var smoothScroll = function(obj, end, callback) {
  var start = {y: obj.scrollTop, x: obj.scrollLeft},

      clock = Date.now(),

      // get animation frame or a fallback
      requestAnimationFrame = window.requestAnimationFrame ||
                              window.mozRequestAnimationFrame ||
                              window.webkitRequestAnimationFrame ||
                              function(fn){window.setTimeout(fn, 15);},
      duration = Math.max(getDuration(start.y, end.y), getDuration(start.x, end.x));

    // setup the stepping function
    var step = function() {

      // calculate timings
      var elapsed = Date.now() - clock;

      // change position on y-axis if result is a number.
      if (!isNaN(end.y)) {
        obj.scrollTop = position(start.y, end.y, elapsed, duration);
      }

      // change position on x-axis if result is a number.
      if (!isNaN(end.x)) {
        obj.scrollLeft = position(start.x, end.x, elapsed, duration);
      }

      // check if we are over due
      if (elapsed > duration) {
        // is there a callback?
        if (typeof callback === 'function') {
          // stop execution and run the callback
          return callback(end);
        }

        // stop execution
        return;
      }

      // use a new animation frame
      animationFrame = requestAnimationFrame(step);
    };

    // start the first step
    step();
};

var index = () => {
  /**
   * Feature detect scroll-snap-type, if it exists then do nothing (return)
   */
  if ('scrollSnapAlign' in document.documentElement.style ||
      'webkitScrollSnapAlign' in document.documentElement.style ||
      'msScrollSnapAlign' in document.documentElement.style) {
    // just return void to stop executing the polyfill.
    return
  }

  Polyfill({
    declarations: [
      'scroll-snap-type:*',
      'scroll-snap-align:*',
      'scroll-snap-padding:*'
    ]
  })
    .doMatched(doMatched)
    .undoUnmatched(undoUnmatched);
};

return index;

})));
