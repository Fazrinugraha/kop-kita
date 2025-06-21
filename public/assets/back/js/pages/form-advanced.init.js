! function(n) {
    "use strict";
    var a = function() {};
    a.prototype.initSwitchery = function() {
        n('[data-plugin="switchery"]').each(function(a, e) {
            new Switchery(n(this)[0], n(this).data())
        })
    }, a.prototype.initSelect2 = function() {
        n('[data-toggle="select2"]').select2()
    }, a.prototype.init = function() {
        this.initSwitchery(), this.initSelect2()
    }, n.Components = new a, n.Components.Constructor = a
}(window.jQuery),
function(a) {
    "use strict";
    window.jQuery.Components.init()
}(), $(function() {
    "use strict";
    
});
