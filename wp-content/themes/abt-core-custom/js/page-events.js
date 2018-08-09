(function ($) {

  "use strict";
  var theme_dir = "/wp-content/themes/abt-core-custom/";

  function events_toggle() {
    // Hide the grid by default
    $('.social-grid').hide();

    // Toggle grid/calendar with buttons
    $('#events-toolbar button').click(function() {

      if (!$(this).is('.active')) {
        $('#events-toolbar button.active').removeClass('active');
        $(this).addClass('active');
        $('.social-grid').toggle();
        $('#events-calendar').toggle();
      }

    });
  }

  $(document).ready(function () {
    events_toggle();
  });

})(jQuery);
