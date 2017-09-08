<style>
.asanocf-wrapper {
  margin: 10px 20px 0 2px;
}

.asanocf-panel {
  position: relative;
  overflow: auto;
  margin: 16px 0;
  padding: 23px;
  border: 1px solid #e5e5e5;
  box-shadow: 0 1px 1px rgba(0,0,0,.04);
  background: #fff;
  font-size: 13px;
  line-height: 2.1em;
  box-sizing: border-box;
  flex-grow: 1;
}

.asanocf-row {
  display: flex;
  justify-content: space-between;
}

.asanocf-half {
  width: 49%;
}

.asanocf-video {
  width: 400px;
  height: 200px;
}

.asanocf-center {
  display: flex;
  justify-content: center;
}

.asanocf-video-container {
  display: flex;
}

.asanocf-shortcode-container {
  display: flex;
}

.asanocf-shortcode-container input {
  flex-grow: 1;
  margin-right: 10px;
}

.asanocf-links {
  text-align: center;
  margin-top: 35px;
}

.asanocf-links a {
  width: 200px;
  margin-bottom: 10px !important;
}

.asanocf-links .asanocf-link-signout {
  background-color: #d9534f;
  border-color: #d9534f;
  box-shadow: 0 1px 0 #d9534f;
  text-shadow: none;
  margin-top: 15px;
}

.asanocf-links .asanocf-link-signout:hover {
  background-color: #c9302c;
  border-color: #c12e2a;
  box-shadow: 0 1px 0 #c12e2a;
}
</style>

<script>
jQuery(function() {
  var $ = jQuery
  
  $('[name="shortcode"]').on('focus', function() {
    $(this).select()
  })
  
  $('.asanocf-copy-shortcode').on('click', function() {
    $('[name="shortcode"]').select()
    document.execCommand("Copy")
  })
  
  $('.asanocf-link-signout').on('click', function() {
    $.post(window.location.href, { action: 'signout' }, function() {
      window.location.reload()
    })
  })
})
</script>

<div class="asanocf-wrapper">
  <div class="asanocf-row">
    <div class="asanocf-half">
      <div class="asanocf-panel">
        <p class="description">Copy this shortcode and paste it into your post:</p>
        
        <div class="asanocf-shortcode-container">
          <input type="text" value="[asano-contact-form]" name="shortcode">
          <button class="button-secondary asanocf-copy-shortcode">copy</button>
        </div>
      </div>
      
      <div class="asanocf-panel">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        </p>
        
        <div class="asanocf-links">
          <div class="asanocf-link">
            <a href="http://asano.dk/" target="_blank" class="button-secondary">Give us feedback</a>
          </div>
          
          <div class="asanocf-link">
            <a href="http://asano.dk/" target="_blank" class="button-secondary">Download iOS app</a>
          </div>
          
          <div class="asanocf-link">
            <a href="http://asano.dk/" target="_blank" class="button-secondary">Download Android app</a>
          </div>
          
          <div class="asanocf-link">
            <a class="button-primary asanocf-link-signout">Sign out</a>
          </div>
          
        </div>
      </div>
    </div>
    
    <div class="asanocf-half asanocf-video-container">
      <div class="asanocf-panel">
        <div class="asanocf-center">
          <iframe class="asanocf-video" src="https://www.youtube.com/embed/-wRdGVfU44w?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>


