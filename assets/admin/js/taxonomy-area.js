(function ($) {
  $('#lineups-sortable').sortable({
    placeholder: "lineup__placeholder"
  })
  $('#lineups-sortable').on('sortchange', function(event, ui) {
    console.log(event, ui)
  })
})(jQuery)
