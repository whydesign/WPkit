(()=>{"use strict";const e=window.wp.blocks,t=window.wp.element,a=window.wp.blockEditor,r=window.wp.components,l=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"wpkit/form","title":"Contact Form","description":"This block displays a Contact Form","category":"widgets","icon":"email","editorScript":"file:./build/index.js","editorStyle":"file:./assets/style.css","render":"file:./render.php","example":{"attributes":{"backgroundColor":"#000000","opacity":0.8,"padding":30,"textColor":"#FFFFFF","radius":10,"title":"Contact Form"}}}');(0,e.registerBlockType)(l,{edit:function(e){let{attributes:l,setAttributes:s}=e;return(0,t.createElement)("div",(0,a.useBlockProps)(),(0,t.createElement)(r.PanelBody,null,(0,t.createElement)("form",{class:"uk-form-stacked"},(0,t.createElement)("div",{class:"uk-margin"},(0,t.createElement)("label",{class:"uk-form-label",for:"form-stacked-text"},"Name"),(0,t.createElement)("div",{class:"uk-form-controls"},(0,t.createElement)("input",{class:"uk-input",type:"text",placeholder:"Name","aria-label":"Input",required:!0}))),(0,t.createElement)("div",{class:"uk-margin"},(0,t.createElement)("label",{class:"uk-form-label",for:"form-stacked-text"},"E-Mail"),(0,t.createElement)("div",{class:"uk-form-controls"},(0,t.createElement)("input",{class:"uk-input",type:"text",placeholder:"E-Mail","aria-label":"Input",required:!0}))),(0,t.createElement)("div",{class:"uk-margin"},(0,t.createElement)("label",{class:"uk-form-label",for:"form-stacked-text"},"Nachricht"),(0,t.createElement)("div",{class:"uk-form-controls"},(0,t.createElement)("textarea",{class:"uk-textarea",rows:"5",placeholder:"Nachricht","aria-label":"Textarea",required:!0}))),(0,t.createElement)("div",{class:"uk-margin"},(0,t.createElement)("label",null,(0,t.createElement)("input",{class:"uk-checkbox",type:"checkbox",required:!0})," Ich stimme der Verarbeitung meiner Daten lt. Datenschutzerklärung zu.")),(0,t.createElement)("div",{class:"uk-margin"},(0,t.createElement)("button",{class:"uk-button uk-button-primary",type:"submit"},"Submit")))))},save:()=>null,attributes:{text:{type:"string"},content:{type:"string",default:""}}})})();