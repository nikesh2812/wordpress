!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=8)}({8:function(e,t,n){"use strict";function r(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}n.r(t);var o=function(){function e(t,n){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.Validation=t,this.View=n,this.errorNoticeId="TypesFieldValidation",this.errorNoticeText="undefined"==typeof toolsetTypesGutenberg?"Missing or invalid field data.":toolsetTypesGutenberg.missingOrInvalidFieldData,this.typesErrorClass=".wpt-form-error",this.typesRFGClasses=[".c-rgy__item--fields",".c-rgy--nested"],this.gutenbergMetaboxFormsClasses=[".metabox-location-normal",".metabox-location-advanced"],this.gutenbergContentClass=".edit-post-layout__content",this._registerClickOnPublishAndUpdateButton()}var t,n,o;return t=e,(n=[{key:"_registerClickOnPublishAndUpdateButton",value:function(){var e=this,t=document.querySelectorAll(".editor-post-publish-button, .editor-post-publish-panel__toggle");if(!t.length)return!1;for(var n=0;n<t.length;n++)t[n].addEventListener("click",function(t){return e.onPublishAndUpdate(t)})}},{key:"onPublishAndUpdate",value:function(e){var t=this,n=!0;this.gutenbergMetaboxFormsClasses.forEach(function(e){t.Validation.isValid(e)||(n=!1)}),n?this.View.removeNotice(this.errorNoticeId):(e.stopImmediatePropagation(),this.View.showErrorNotice(this.errorNoticeId,this.errorNoticeText),this.View.displayNestedElements(this.typesErrorClass,this.typesRFGClasses.join()),this.View.scrollToFirst(this.typesErrorClass,this.gutenbergContentClass))}}])&&r(t.prototype,n),o&&r(t,o),e}();function i(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}var a=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.legacyValidation=t}var t,n,r;return t=e,(n=[{key:"isValid",value:function(e){return this.legacyValidation._initValidation(e),this.legacyValidation.applyRules(e),!!jQuery(e).valid()}}])&&i(t.prototype,n),r&&i(t,r),e}();function s(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}var u=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.gutenbergStore=t}var t,n,r;return t=e,(n=[{key:"showErrorNotice",value:function(e,t){this.gutenbergStore.dispatch("core/notices").createErrorNotice(t,{id:e})}},{key:"removeNotice",value:function(e){this.gutenbergStore.dispatch("core/notices").removeNotice(e)}},{key:"displayNestedElements",value:function(e,t){var n=jQuery;n(e).each(function(){var e=n(this).parents(t);e.length&&e.each(function(){n(this).show()})})}},{key:"scrollToFirst",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"window",n=jQuery,r=n(e+":first");r.length&&n(t).animate({scrollTop:r.offset().top},500)}}])&&s(t.prototype,n),r&&s(t,r),e}();function l(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}n.d(t,"ToolsetTypesGutenberg",function(){return c});var c=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e)}var t,n,r;return t=e,(n=[{key:"bootstrap",value:function(){if("undefined"==typeof jQuery)return!1;if(Toolset.hooks.addFilter("types-gutenberg-is-active",function(){return"undefined"!=typeof wp&&void 0!==wp.blocks&&document.body.classList.contains("block-editor-page")}),"undefined"==typeof wptValidation)return!1;if("undefined"==typeof wp||void 0===wp.data)return!1;var e=new a(wptValidation),t=new u(wp.data);return new o(e,t),!0}}])&&l(t.prototype,n),r&&l(t,r),e}();window.addEventListener("DOMContentLoaded",function(){(new c).bootstrap()})}});