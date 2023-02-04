!function(){"use strict";var e={5251:function(e,t,r){var s=r(9196),o=60103;if(60107,"function"===typeof Symbol&&Symbol.for){var a=Symbol.for;o=a("react.element"),a("react.fragment")}var n=s.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner,c=Object.prototype.hasOwnProperty,l={key:!0,ref:!0,__self:!0,__source:!0};function i(e,t,r){var s,a={},i=null,p=null;for(s in void 0!==r&&(i=""+r),void 0!==t.key&&(i=""+t.key),void 0!==t.ref&&(p=t.ref),t)c.call(t,s)&&!l.hasOwnProperty(s)&&(a[s]=t[s]);if(e&&e.defaultProps)for(s in t=e.defaultProps)void 0===a[s]&&(a[s]=t[s]);return{$$typeof:o,type:e,key:i,ref:p,props:a,_owner:n.current}}t.jsx=i,t.jsxs=i},5893:function(e,t,r){e.exports=r(5251)},9196:function(e){e.exports=window.React}},t={};function r(s){var o=t[s];if(void 0!==o)return o.exports;var a=t[s]={exports:{}};return e[s](a,a.exports,r),a.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var s in t)r.o(t,s)&&!r.o(e,s)&&Object.defineProperty(e,s,{enumerable:!0,get:t[s]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e=window.wp.blocks,t=window.wp.blockEditor,s=window.wp.components,o=window.wp.element,a=window.wp.apiFetch,n=r.n(a),c=window.wp.i18n,l=r(5893);var i=e=>{const{attributes:r,setAttributes:a}=e,[i,p]=(0,o.useState)({}),[u,d]=(0,o.useState)(""),[f,_]=(0,o.useState)(!1),{facet:y,orderby:b,order:w}=r,v=(0,t.useBlockProps)(),m=(0,o.useCallback)((async()=>{const e=await n()({path:"/elasticpress/v1/facets/taxonomies"});p(e)}),[p]);return(0,o.useEffect)(m,[m]),(0,o.useEffect)((()=>{_(!0);const e=new URLSearchParams({facet:y,orderby:b,order:w});n()({path:`/elasticpress/v1/facets/block-preview?${e}`}).then((e=>d(e))).finally((()=>_(!1)))}),[y,b,w]),(0,l.jsxs)(o.Fragment,{children:[(0,l.jsx)(t.InspectorControls,{children:(0,l.jsxs)(s.PanelBody,{title:(0,c.__)("Facet Settings","elasticpress"),children:[(0,l.jsx)(s.SelectControl,{label:(0,c.__)("Taxonomy","elasticpress"),value:y,options:[...Object.entries(i).map((([e,t])=>({label:t.label,value:e})))],onChange:e=>a({facet:e})}),(0,l.jsx)(s.RadioControl,{label:(0,c.__)("Order By","elasticpress"),help:(0,c.__)("The field used to order available options","elasticpress"),selected:b,options:[{label:(0,c.__)("Count","elasticpress"),value:"count"},{label:(0,c.__)("Name","elasticpress"),value:"name"}],onChange:e=>a({orderby:e})}),(0,l.jsx)(s.RadioControl,{label:(0,c.__)("Order","elasticpress"),selected:w,options:[{label:(0,c.__)("ASC","elasticpress"),value:"asc"},{label:(0,c.__)("DESC","elasticpress"),value:"desc"}],onChange:e=>a({order:e})})]})}),(0,l.jsxs)("div",{...v,children:[f&&(0,l.jsx)(s.Placeholder,{children:(0,l.jsx)(s.Spinner,{})}),!f&&(0,l.jsx)("div",{dangerouslySetInnerHTML:{__html:u}})]})]})},p={from:[{type:"block",blocks:["core/legacy-widget"],isMatch:({idBase:e})=>"ep-facet"===e,transform:({instance:t})=>{const{title:r=null,...s}=t.raw;return r?[(0,e.createBlock)("core/heading",{content:r}),(0,e.createBlock)("elasticpress/facet",s)]:(0,e.createBlock)("elasticpress/facet",s)}}]},u=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"title":"Facet by Taxonomy (ElasticPress)","textdomain":"elasticpress","name":"elasticpress/facet","icon":"feedback","category":"widgets","attributes":{"facet":{"type":"string","default":""},"orderby":{"type":"string","default":"count","enum":["count","name"]},"order":{"type":"string","default":"desc","enum":["desc","asc"]}},"supports":{"html":false},"editorScript":"ep-facets-block-script","style":"file:/../../../../../dist/css/facets-styles.css"}');(0,e.registerBlockType)(u,{edit:i,save:()=>{},transforms:p})}()}();