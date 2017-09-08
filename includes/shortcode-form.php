<style>
.asanocf-error-message {
  display: none;
  margin-left: 10px;
  color: #e06464;
  font-size: 14px;
}

.asanocf-loading {
  display: none;
  vertical-align: middle;
  margin-left: 5px;
}

.asanocf-wrapper {
  position: relative;
}

.asanocf-overlay {
  display: none;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(255, 255, 255, 0.9);
}

.asanocf-overlay-content {
  display: flex;
  text-align: center;
  flex-direction: column;
  justify-content: center;
  height: 100%;
}

.asanocf-overlay-content a {
  display: inline-block;
  font-weight: bold;
  margin-top: 5px;
  margin-bottom: 20px;
}
</style>

<script>
jQuery(function() {
  var API_HOST = 'http://api.asanoapp.com',
      $ = jQuery
  
  $('.asanocf-form').on('submit', function(event) {
    var $container = $(this).parent()
    
    event.preventDefault()
    $container.find('.asanocf-error-message').hide()
    $container.find('.asanocf-loading').show()
    
    $.post(API_HOST + '/api/lead/createlead', {
      // 'Requester.FirstName': $container.find('[name="name"]').val(),
      'Requester.PhoneNumber': $container.find('[name="phone"]').val(),
      'Requester.Email': $container.find('[name="email"]').val(),
      'VendorId': $container.find('[name="id"]').val()
    })
    .done(function(data) {
      $container.find('.asanocf-loading').hide()
      $container.find('.asanocf-overlay').fadeIn()
      $container.find('.asanocf-overlay-content a')
        .attr('href', data.RedirectUrl)
        .text(data.RedirectUrl)
    })
    .fail(function(xhr) {
      var message
      
      try {
        message = JSON.parse(xhr.responseText).Message
      } catch(e) {
        message = 'Service isn\'t available. Please contact support.'
      }
      
      $container.find('.asanocf-loading').hide()
      $container.find('.asanocf-error-message').text(message).fadeIn()
      
      setTimeout(function() {
        $container.find('.asanocf-error-message').fadeOut()
      }, 3000)
    })
  })
})
</script>

<div class="asanocf-wrapper">
  <div class="asanocf-overlay">
    <div class="asanocf-overlay-content">
      <p>
        Thanks for your message. You can follow your request at<br> <a target="_blank"></a><br>
        We have also sent an email and SMS with the link.
      </p>
    </div>
  </div>
  
  <form class="asanocf-form" method="post">
    <input type="hidden" name="id" value="<?= get_option('asanocf_id') ?>">
    
    <p>
      <label class="asanocf-form-control">
        <span>First name</span>
        <br>
        <input class="asanocf-input" type="text" name="name">
      </label>
    </p>
    
    <p>
      <label class="asanocf-form-control">
        <span>Phone number</span>
        <br>
        <input class="asanocf-input" type="text" name="phone">
      </label>
    </p>
    
    <p>
      <label class="asanocf-form-control">
        <span>Email</span>
        <br>
        <input class="asanocf-input" type="text" name="email">
      </label>
    </p>
    
    <button type="submit" class="asanocf-submit">Send message</button>
    <img class="asanocf-loading" src="/wp-admin/images/loading.gif">
    <span class="asanocf-error-message"></span>
  </form>       
</div>
