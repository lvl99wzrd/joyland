(function ($) {
  // Set default colors
  let editorBgColor = '#ffffff'
  let editorTextColor = '#000000'

  // Get content background field
  const contentBgColor = acf.getField('field_5f7cb780e5023')
  const contentColor = acf.getField('field_5f7cb7a2e5024')

  function setEditorBgColor() {
    $('.editor-styles-wrapper').get(0).style.setProperty('--editor-bg-color', editorBgColor)
  }
  
  function setEditorTextColor() {
    $('.editor-styles-wrapper').get(0).style.setProperty('--editor-text-color', editorTextColor)
  }

  if (contentBgColor.val()) {
    editorBgColor = contentBgColor.val()
  }

  if (contentColor.val()) {
    editorTextColor = contentColor.val()
  }

  contentBgColor.on('change', function () {
    editorBgColor = contentBgColor.val()
    setEditorBgColor()
  })

  contentColor.on('change', function () {
    editorTextColor = contentColor.val()
    setEditorTextColor()
  })

  // Set background and text color on load
  $(window).on('load', function () {
    setEditorBgColor()
    setEditorTextColor()
  })
})(jQuery)
