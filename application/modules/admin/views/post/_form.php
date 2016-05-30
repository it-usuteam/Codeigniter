<style>
  .app-form input[type=text], .app-form input[type=password], .app-form input[type=number], .app-form textarea, .app-form select {
    border: 1px solid #777;
    padding: 10px;
    color: #333;
    background: #FFF;
    width: 100%;
  }
  .app-form .title {
    font-size: 1.5em;
  }
  .app-form input[type=text], .app-form input[type=password], .app-form input[type=number], .app-form textarea, .app-form select, #contentField ~ div, .app-form button {
    margin: 7.5px auto;
  }
  .app-form label {
    display: block;
  }
  .app-form input[type=checkbox] + label {
    margin-left: 1em;
    display: inline-block;
  }
  .app-form button {
    background: #D88407;
    color: #F0F0F0;
    border:0;
    border-radius: 0;
    padding: 10px;
  }
  .app-form .cke_top {
    background: #EEE;
  }
  .app-form .cke_button {
    background: #FFF;
  }
  .box-square {
    margin-top: 10px;
    padding: 15px;
    background: #F3F3F3;
    color: #333;
  }
</style>
<script src="<?php echo base_url() ?>/resources/framework/ckeditor/ckeditor.js"></script>
<form class="app-form" method=POST name='createForm' action="<?php echo site_url('admin/posts/create') ?>">
  <div class="col-md-9">
    <input type=text name='title' required class='title' placeholder="Enter a new title here...">
    <textarea name='content' id='contentField'></textarea>
    <script>
      CKEDITOR.replace('contentField');
      $(document).ready( function() {
        $('button[type=reset]').click(function() { CKEDITOR.instances.contentField.setData(''); });
        $('form[name=createForm]').submit(function(event) {
          event.preventDefault();
          var button = $($('form[name=createForm] button[type=submit]')[0]).focus();
          var buttonText = $(button).html();
          button.popover('disable');
          $(button).html("Processing...");
          CKEDITOR.instances.contentField.updateElement();
          $.ajax({
            url: $('form[name=createForm]').attr('action'),
            method: $('form[name=createForm]').attr('method'),
            data: $('form[name=createForm]').serialize(),
            dataType: 'text',
            timeout: 60000,
          }).done(function(rv) { // rv => return value
            if(Boolean(rv) == true) {
                location.href = "<?php echo site_url('admin/posts/index') ?>";
            } else {
              $(button).popover({
                content: "Something wrong with the process, please contact administrator and save your work.",
                placement: "bottom",
                trigger: 'focus'
              });
              $($(button)[0]).focus();
                // location.href = "";
              }
              console.log(rv);
          }).fail(function(rv) { // rv => return value
              $(button).popover({
                content: "Something wrong with the process, please contact administrator and save your work. (" + rv.statusText + ")",
                placement: "bottom",
                trigger: 'focus'
              });
              $(button).focus();
              $(button).html(buttonText);
          });
        });
      });
    </script>
  </div>
  <div class="col-md-3 box-square">
    <div class="row">
      <div class="col-md-12">
      <button type=submit>Create</button>
      <button type=reset style="float: right;">Reset</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 box-square">
        <label>Slug (http://<?php echo site_url('web/post/view') ?>/post/ )</label>
        <input type=text name='slug' required>
        <label>Publish</label>
        <select name='post_status'>
          <option value=1>Yes</option>
          <option value=0>No</option>
        </select>
        <label>Allow Comments</label>
        <select name='comment_status'>
          <option value=1>Yes</option>
          <option value=0>No</option>
        </select>
        <label>Password</label>
        <input type=password name='pass'>
        <label>Category</label>
        <div>
          <?php
            foreach($category as $model) {
              echo "<input type=checkbox name='category[{$model->id}]' value='{$model->id}'>";
              echo "<label>{$model->name}</label>";
            }
           ?>
        </div>
      </div>
    </div>
  </div>
</form>
