<script type="text/html" id="tmpl-pa-shortcode">
  <div class="pa-shortcode <# if ( data.options.icon ) { #>pa-shortcode-dashicon<# } #> mceItem">
    <# if ( data.options.icon ) { #>
      <div class="dashicons {{ data.options.icon }}"></div>
    <# } #>
    <strong>{{ data.options.name }}</strong>
    <# if ( data.options.description ) { #>
      <em>{{ data.options.description }}</em>
    <# } #>
  </div>
</script>
