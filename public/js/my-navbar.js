// -- code for everything in the nav and search bar starts here
// controls the dropdown menu
$(document).ready(function () {
    $('#demo').dropit();
    $('#demo1').dropit();

    $('#demo').dropit({
        action: 'click', // The open action for the trigger
        submenuEl: 'ul', // The submenu element
        triggerEl: 'a', // The trigger element
        triggerParentEl: 'li', // The trigger parent element
        afterLoad: function () {}, // Triggers when plugin has loaded
        beforeShow: function () {}, // Triggers before submenu is shown
        afterShow: function () {}, // Triggers after submenu is shown
        beforeHide: function () {}, // Triggers before submenu is hidden
        afterHide: function () {} // Triggers before submenu is hidden
    });
});
(function ($) {

    $.fn.dropit = function (method) {

        var methods = {

            init: function (options) {
                this.dropit.settings = $.extend({}, this.dropit.defaults, options);
                return this.each(function () {
                    var $el = $(this),
                            el = this,
                            settings = $.fn.dropit.settings;
                    // Hide initial submenus
                    $el.addClass('dropit')
                            .find('>' + settings.triggerParentEl + ':has(' + settings.submenuEl + ')').addClass('dropit-trigger')
                            .find(settings.submenuEl).addClass('dropit-submenu').hide();
                    // Open on click
                    $el.off(settings.action).on(settings.action, settings.triggerParentEl + ':has(' + settings.submenuEl + ') > ' + settings.triggerEl + '', function () {

                        // Close click menu's if clicked again
                        if (settings.action == 'click' && $(this).parents(settings.triggerParentEl).hasClass('dropit-open')) {
                            document.getElementById("m1").style.border = "none";
                            document.getElementById("m1").style.padding = "10px";
                            document.getElementById("m2").style.border = "none";
                            document.getElementById("m2").style.padding = "10px";
                            settings.beforeHide.call(this);
                            $(this).parents(settings.triggerParentEl).removeClass('dropit-open').find(settings.submenuEl).hide();
                            settings.afterHide.call(this);
                            return false;
                        }

                        // Hide open menus
                        settings.beforeHide.call(this);
                        $('.dropit-open').removeClass('dropit-open').find('.dropit-submenu').hide();
                        settings.afterHide.call(this);
                        // Open this menu
                        settings.beforeShow.call(this);
                        $(this).parents(settings.triggerParentEl).addClass('dropit-open').find(settings.submenuEl).show();
                        settings.afterShow.call(this);
                        return false;
                    });
                    // Close if outside click
                    $(document).on('click', function () {
                        settings.beforeHide.call(this);
                        $('.dropit-open').removeClass('dropit-open').find('.dropit-submenu').hide();
                        settings.afterHide.call(this);
                        document.getElementById("m1").style.border = "none";
                        document.getElementById("m1").style.padding = "10px";
                        document.getElementById("m2").style.border = "none";
                        document.getElementById("m2").style.padding = "10px";
                    });
                    // If hover
                    if (settings.action == 'mouseenter') {
                        $el.on('mouseleave', '.dropit-open', function () {
                            settings.beforeHide.call(this);
                            $(this).removeClass('dropit-open').find(settings.submenuEl).hide();
                            settings.afterHide.call(this);
                        });
                    }
                    settings.afterLoad.call(this);
                });
            }

        };
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method "' + method + '" does not exist in dropit plugin!');
        }

    };
    $.fn.dropit.defaults = {
        action: 'click', // The open action for the trigger
        submenuEl: 'ul', // The submenu element
        triggerEl: 'a', // The trigger element
        triggerParentEl: 'li', // The trigger parent element
        afterLoad: function () {}, // Triggers when plugin has loaded
        beforeShow: function () {}, // Triggers before submenu is shown
        afterShow: function () {}, // Triggers after submenu is shown
        beforeHide: function () {}, // Triggers before submenu is hidden
        afterHide: function () {} // Triggers before submenu is hidden
    };
    $.fn.dropit.settings = {};
})(jQuery);

// controls the icon for the mobile menu
function menu2() {
    const element1 = document.getElementById("m2");
    const cssObj = window.getComputedStyle(element1, null);
    const m2 = cssObj.getPropertyValue("padding");
    if (m2 === '10px') {
        document.getElementById("m2").style.padding = "8px";
        document.getElementById("m2").style.border = "2px solid red";
        $(".search-box").hide();
        $("#search-icon").css("border", "none");
        $("#search-icon").css("padding", "10px");
        document.getElementById("m1").style.border = "none";
        document.getElementById("m1").style.padding = "10px";
        // $("#m1").css("border", "red");
    } else {
        document.getElementById("m2").style.border = "none";
    }

}

// Controls the Icon for user on the nav bar
function menu1() {
    const element1 = document.getElementById("m1");
    const cssObj = window.getComputedStyle(element1, null);
    const m1 = cssObj.getPropertyValue("padding");
    if (m1 == '10px') {
        document.getElementById("m1").style.padding = "8px";
        document.getElementById("m1").style.border = "2px solid red";
        $(".search-box").hide();
        $("#search-icon").css("border", "none");
        $("#search-icon").css("padding", "10px");
        document.getElementById("m2").style.border = "none";
        document.getElementById("m2").style.padding = "10px";
        // $("#m1").css("border", "red");
    } else {
        document.getElementById("m1").style.border = "none";
    }
}

// for the dropdown search bar
function searchBar() {
    const element1 = document.getElementById("search");
    const cssObj = window.getComputedStyle(element1, null);
    const bb = cssObj.getPropertyValue("display");
    if (bb === "none") {
        var element = document.getElementById("search");
        $(".search-box").css("display", "block");
        $("#search-icon").css("padding", "8px");
        $("#search-icon").css("border", "2px solid red");
    } else {
        $(".search-box").hide();
        $("#search-icon").css("border", "none");
        $("#search-icon").css("padding", "10px");
    }
}
// -- everything for the nav and search bar ends here --