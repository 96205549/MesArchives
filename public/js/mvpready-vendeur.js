/* ========================================================
 *
 *
 * ======================================================== */

var mvpready_vendeur = function () {

    "use strict";

    var initNavbarNotifications = function () {
        var notifications = $('.navbar-notification');

        notifications.find('> .dropdown-toggle').click(function (e) {
            if (mvpready_core.isLayoutCollapsed()) {
                window.location = $(this).prop('href');
            }
        });

        notifications.find('.notification-list').slimScroll({height: 225, railVisible: true});
    }

    return {
        init: function () {
            // Layouts
            mvpready_core.navEnhancedInit();
            mvpready_core.navHoverInit({delay: {show: 250, hide: 350}});

            initNavbarNotifications();
            mvpready_core.initLayoutToggles();
            mvpready_core.initBackToTop();

            // Components
            mvpready_helpers.initAccordions();
            mvpready_helpers.initTooltips();
            mvpready_helpers.initLightbox();
            mvpready_helpers.initSelect();
            mvpready_helpers.initIcheck();
            mvpready_helpers.initDataTableHelper();
        }
    };

}();

$(function () {
    mvpready_vendeur.init();
});
