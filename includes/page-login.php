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
}

.asanocf-row {
  display: flex;
  justify-content: space-between;
}

.asanocf-half {
  width: 49%;
}

.asanocf-center {
  display: flex;
  justify-content: center;
}

.asanocf-h1 {
  margin-top: 0;
}

.asanocf-h1-center {
  margin-top: 0;
  text-align: center;
}

.asanocf-video {
  width: 400px;
  height: 200px;
}

.asanocf-input {
  width: 250px;
}

.asanocf-error-message {
  display: none;
  margin-left: 10px;
  color: #e06464;
}

.asanocf-loading {
  display: none;
  vertical-align: middle;
  margin-left: 5px;
}
</style>

<script>
jQuery(function() {
  var API_HOST = 'http://api.asanoapp.com',
      $ = jQuery,
      useDefaultSubmit = false
  
  $('.asanocf-form').on('submit', function(event) {
    if (useDefaultSubmit) return
    
    var email = $('[name="email"]').val(),
        password = $('[name="password"]').val()
        
    event.preventDefault()
    $('.asanocf-error-message').hide()
    $('.asanocf-loading').show()
    
    $.post(API_HOST + '/token', {
      grant_type: 'password',
      username: email,
      password: password
    })
    .done(function(data) {
      $('[name="id"]').val(data.access_token)
      
      $.ajax({
        url: API_HOST + '/api/vendors/getvendorbytoken',
        headers: {
          'Authorization': 'Bearer ' + data.access_token
        }
      })
      .done(function(data) {
        useDefaultSubmit = true
        $('[name="id"]').val(data.Id)
        $('.asanocf-form').trigger('submit')
      })
      .fail(function() {
        showError('Service isn\'t available. Please contact support.')
      })
    })
    .fail(function(xhr) {
      var message
      
      try {
        message = JSON.parse(xhr.responseText).error_description
      } catch(e) {
        message = 'Service isn\'t available. Please contact support.'
      }
      
      showError(message)
    })
  })
  
  function showError(message) {
    $('.asanocf-loading').hide()
    $('.asanocf-error-message').text(message).fadeIn()
    
    setTimeout(function() {
      $('.asanocf-error-message').fadeOut()
    }, 3000)
  }
})
</script>

<div class="asanocf-wrapper">
  <div class="asanocf-row">
    <div class="asanocf-panel asanocf-half">
      <h1 class="asanocf-h1">Sign in to AsanoApp</h1>
      
      <form class="asanocf-form" method="post">
        <input type="hidden" name="id">
        
        <p>
          <label class="asanocf-form-control">
            <span>Email</span>
            <br>
            <input class="asanocf-input" type="text" name="email">
          </label>
        </p>
        
        <p>
          <label>
            <span>Password</span>
            <br>
            <input class="asanocf-input" type="password" name="password">
          </label>
        </p>
        
        <button type="submit" class="button-primary">Sign in</button>
        <img class="asanocf-loading" src="/wp-admin/images/loading.gif">
        <span class="asanocf-error-message"></span>
      </form>
      
      <p>
        <a href="http://asano.dk/" target="_blank">Don't have an AsanoApp account? Get it now!</a>
      </p>
    </div>
    
    <div class="asanocf-panel asanocf-half">
      <div class="asanocf-center">
        <iframe class="asanocf-video" src="https://www.youtube.com/embed/-wRdGVfU44w?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
  
  <div class="asanocf-panel">
    <h1 class="asanocf-h1-center">Why do you need to sign in?</h1>
    <ol>
      <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
      <li>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
      <li>Et harum quidem rerum facilis est et expedita distinctio.</li>
    </ol>
  </div>
</div>

