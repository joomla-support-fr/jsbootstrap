var Equalizer = new Class({
initialize: function(elements,stop,prevent) {
this.elements = $$(elements);
},
equalize: function(hw) {
if(!hw) { hw = 'height'; }
var max = 0,
prop = (typeof document.body.style.maxHeight != 'undefined' ? 'min-' : '') + hw; //ie6 ftl
offset = 'offset' + hw.capitalize();
this.elements.each(function(element,i) {
var calc = element[offset];
if(calc > max) { max = calc; }
},this);
this.elements.each(function(element,i) {
element.setStyle(prop,max - (element[offset] - element.getStyle(hw).replace('px','')));
});
return max;
}
}); 