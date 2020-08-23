!function(){"use strict";var n=tinymce.util.Tools.resolve("tinymce.PluginManager"),t=tinymce.util.Tools.resolve("tinymce.dom.RangeUtils"),e=tinymce.util.Tools.resolve("tinymce.util.Tools"),o=function(n){return!n},r=function(n){return n.getAttribute("id")||n.getAttribute("name")||""},a=function(n){return function(n){return n&&"a"===n.nodeName.toLowerCase()}(n)&&!n.getAttribute("href")&&""!==r(n)},i=function(n){var o=n.dom;t(o).walk(n.selection.getRng(),function(n){e.each(n,function(n){var t;a(t=n)&&!t.firstChild&&o.remove(n,!1)})})},c=function(n){return n.dom.getParent(n.selection.getStart(),"a:not([href])")},u=function(n,t){var e=c(n);e?function(n,t,e){e.removeAttribute("name"),e.id=t,n.addVisual(),n.undoManager.add()}(n,t,e):function(n,t){n.undoManager.transact(function(){(function(n){return n.getParam("allow_html_in_named_anchor",!1,"boolean")})(n)||n.selection.collapse(!0),n.selection.isCollapsed()?n.insertContent(n.dom.createHTML("a",{id:t})):(i(n),n.formatter.remove("namedAnchor",null,null,!0),n.formatter.apply("namedAnchor",{value:t}),n.addVisual())})}(n,t),n.focus()},l=function(n){var t=function(n){var t=c(n);return t?r(t):""}(n);n.windowManager.open({title:"Anchor",size:"normal",body:{type:"panel",items:[{name:"id",type:"input",label:"ID",placeholder:"example"}]},buttons:[{type:"cancel",name:"cancel",text:"Cancel"},{type:"submit",name:"save",text:"Save",primary:!0}],initialData:{id:t},onSubmit:function(t){(function(n,t){return/^[A-Za-z][A-Za-z0-9\-:._]*$/.test(t)?(u(n,t),!0):(n.windowManager.alert("Id should start with a letter, followed only by letters, numbers, dashes, dots, colons or underscores."),!1)})(n,t.getData().id)&&t.close()}})},d=function(n){n.addCommand("mceAnchor",function(){l(n)})},s=function(n){return function(n){return n&&o(n.attr("href"))&&!o(n.attr("id")||n.attr("name"))}(n)&&!n.firstChild},m=function(n){return function(t){for(var e=0;e<t.length;e++){var o=t[e];s(o)&&o.attr("contenteditable",n)}}},f=function(n){n.on("PreInit",function(){n.parser.addNodeFilter("a",m("false")),n.serializer.addNodeFilter("a",m(null))})},h=function(n){n.formatter.register("namedAnchor",{inline:"a",selector:"a:not([href])",remove:"all",split:!0,deep:!0,attributes:{id:"%value"},onmatch:function(n,t,e){return a(n)}})},g=function(n){n.ui.registry.addToggleButton("anchor",{icon:"bookmark",tooltip:"Anchor",onAction:function(){return n.execCommand("mceAnchor")},onSetup:function(t){return n.selection.selectorChangedWithUnbind("a:not([href])",t.setActive).unbind}}),n.ui.registry.addMenuItem("anchor",{icon:"bookmark",text:"Anchor...",onAction:function(){return n.execCommand("mceAnchor")}})};n.add("anchor",function(n){f(n),d(n),g(n),n.on("PreInit",function(){h(n)})})}();