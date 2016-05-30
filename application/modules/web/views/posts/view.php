<style>
  .news-info {
    margin: 0.5em 0;
    padding: 0.5em;
    background: #FBFBFB;
  }
  .news-info-logo { margin-right: 0.5em; }
</style>
<div class="col-md-8">
  <div class="row">
    <div class="col-md-12">
      <h1><?php echo $news->title ?></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php echo $news->content ?>
    </div>
  </div>
  <div class="row news-info">
    <span class="glyphicon glyphicon-user news-info-logo"></span>
    <span class="news-info-logo"><?php echo (is_null($writer_info)) ? "Penulis Terlupakan" : $writer_info['fullname'] ?></span>
    <span class="glyphicon glyphicon-time news-info-logo"></span>
    <span class="news-info-logo"><?php echo $news->created ?></span>
  </div>
</div>
<div class="col-md-4">
  <!-- TODO To be filled with latest news etc. -->
</div>
