<style>
     .table td {
          border-top: 0 !important;
          text-align: center;
     }
     .table thead td {
          font-weight: 700;
          background: #333;
          color: #EEE;
     }
     .table td[data-th=Menu] {
          width: 10%;
          text-align: center;
     }
     .table td[data-th=Menu] .glyphicon {
          margin: 0 0.5em;
     }
     button[type=submit], input[type=number]{
          color: #0F0F0F;
          border:0;
          border-radius: 0;
          padding: 5px;
          margin-left: 5px;
     }
     @media (max-width:768px) {
          /* This responsive table is based on http://codepen.io/geoffyuen/pen/FCBEg by Geoff Yuan */
          .table thead {
               display: none;
          }
          .table td:last-of-type {
               margin: 10px auto;
               border-bottom: 1px solid #777;
          }
          .table td:before {
               content: attr(data-th);
               display: block;
               font-weight: 700;
               float:left;
               vertical-align:top;
               width: 25%;
               height: 100%;
               padding: 5px;
               text-align: center;
               background: #333;
               color: #EEE;
          }
          .table td {
               display: block;
               float: left;
               clear: both;
               width: 100% !important;
               padding: 0 !important;
               text-align: justify;
          }
          .table td div {
               float:left;
               width: 70%;
               padding: 5px;
               margin: 0 2.5%;
          }
     }
</style>

<div class="container-fluid">
     <div class="row">
          <div class="col-md-12">
               <h1>Posts <a href="<?php echo site_url('admin/posts/create') ?>"><span style="font-size: 0.5em; vertical-align: middle;" class="glyphicon glyphicon-plus"></span></a></h1>
          </div>
     </div>
     <div class="row">
          <div class="col-md-12">
               <table class="box-style table">
                 <thead>
                   <td>ID</td>
                   <td>Title</td>
                   <td>Short Content</td>
                   <td>Slug</td>
                   <td>Posted</td>
                   <td>Comments</td>
                   <td>Menu</td>
                 </thead>
                    <?php
                         if($news === false) {
                           echo "<tr><td colspan=7 data-th='Status'>No data available.</td></tr>";
                         } else {
                           foreach($news as $data) {
                                echo "<tr>";
                                echo "<td data-th='ID'><div>".strip_tags(htmlspecialchars_decode($data->id, ENT_QUOTES))."</div></td>";
                                echo "<td data-th='Title'><div>".strip_tags(htmlspecialchars_decode($data->title, ENT_QUOTES))."</div></td>";
                                echo "<td data-th='Short Content'><div>".strip_tags(htmlspecialchars_decode($data->content, ENT_QUOTES))."</div></td>";
                                echo "<td data-th='Slug'><div>".strip_tags(htmlspecialchars_decode($data->slug, ENT_QUOTES))."</div></td>";
                                echo "<td data-th='Posted'><div>".($data->is_posted() == 1 ? "Yes" : "No")."</div></td>";
                                echo "<td data-th='Comments'><div>".($data->is_comment_enabled () == 1 ? "Yes" : "No")."</div></td>";
                                echo "<td data-th='Menu'>
                                     <div style='text-align: center'>
                                          <a href=\"". site_url('web/posts/view/'.$data->slug) ."\"><span class='glyphicon glyphicon-eye-open'></span></a>
                                          <a href=\"". site_url('admin/posts/edit/'.$data->slug) ."\"><span class='glyphicon glyphicon-pencil'></span></a>
                                          <a class='deletePost' href=\"". site_url('admin/posts/delete/'.$data->slug) ."\"><span class='glyphicon glyphicon-trash'></span></a>
                                     </div>
                                     </td>";
                                echo "</tr>";
                           }
                         }
                    ?>
               </table>
          </div>
     </div>
     <div class="row">
          <div class="col-md-3">
               <form name="pageMover" action="<?php echo site_url('admin/posts/index') ?>" method=GET>
                    <span>Rows : <input style="color: #333; width: 20%" type=number min=1 max=100 name='counter' value='<?php echo $paging['counter'] ?>'></span>
                    <span>Page : <input style="color: #333; width: 20%" type=number min=1 name='current' value='<?php echo $paging['current'] ?>'></span>
                    <button type=submit>Go</button>
               </form>
               <style>
                    .blockade {
                         position: fixed;
                         background: rgba(0,0,0,0.75);
                         left:0;
                         top: 0;
                         width: 100%;
                         height:100%;
                         z-index: 9875;
                    }
                    .blockade #msgBox {
                         position: absolute;
                         top: 50%;
                         left: 50%;
                         transform: translate(-50%, -50%);
                         max-height: 90%;
                         max-width: 90%;
                         overflow: auto;
                         background: #FFF;
                         color: #333;
                    }
                    .blockade .message {
                         padding: 1em;
                    }
                    .blockade .option {
                         float: right;
                         clear: both;
                    }
                    .blockade button {
                         border-radius: 0;
                         border: 0;
                         padding: 1em;
                         width: auto;
                    }
               </style>
               <script>
                    $("form[name=pageMover]").submit(function (event) {
                         event.preventDefault();
                         location.href = "<?php echo site_url('admin/posts/index') ?>/" + $("input[name=counter]").val() + "/" + $("input[name=current]").val();
                    });
                    function customAlert(msg, execute) {
                         $("body").prepend('<div class="blockade"><div id="msgBox"><div class="message">' + msg + '</div><div class="option"><button class="confirm">Yes</button><button class="cancel">No</button></div></div></div>');
                         var ok = $("#msgBox .confirm");
                         var no = $("#msgBox .cancel");
                         ok.click( function(event) {
                              event.preventDefault();
                              execute(true);
                         });

                         no.click( function(event) {
                              event.preventDefault();
                              execute(false);
                         });
                    }
                    $('.deletePost').each( function(i, e) {
                         $(e).click( function(event) {
                              event.preventDefault();
                              var a;
                              a = customAlert("Are you sure to delete this post? ", function(val) {
                                   if(val == true) {
                                        $.ajax( {
                                             url: $(e).attr('href'),
                                             method: "GET",
                                             timeout: 10000,
                                             datatype: "text",
                                        })
                                        .success( function(response) {
                                             if(Boolean(response) == true)
                                                  location.href = location.href;
                                             else
                                                  console.log(response);
                                             $('.blockade').remove();
                                        });
                                   } else {
                                        $('.blockade').remove();
                                   }
                              });
                         });
                    });
               </script>
          </div>
          <?php if($paging['current'] <= ceil($paging['total'] / $paging['counter'])) { ?>
          <div class="col-md-3 col-md-offset-6">
               <ul class="pagination" style='float:right'>
                    <?php
                         for($i = $paging['current'] - 2; $i < $paging['current']; $i++) {
                              if($i <= 0)
                                   continue;
                              echo "<li><a href='".site_url('admin/posts/index')."/{$i}/".$paging['counter']."'>".($i)."</a></li>";
                         }
                         echo "<li class=\"active\"><a>".($paging['current'])."</a></li>";
                         for($i = $paging['current'] + 1; $i <= $paging['current'] + 2; $i++) {
                              if($i >= ceil($paging['total'] / $paging['counter']))
                                   break;
                              echo "<li><a href='".site_url('admin/posts/index')."/{$i}/".$paging['counter']."'>".$i."</a></li>";
                         }
                    ?>
               </ul>
          </div>
          <?php } ?>
     </div>
</div>
