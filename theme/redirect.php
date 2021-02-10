  <div class="content-wrapper">
    <section class="content">
            <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Redirecting to news</h3>
            </div>
            <!-- /.box-header -->
            <? foreach($post as $item){ ?>
            <p>You will be redirected in <span id="counter">10</span> second(s).</p>
            <script type="text/javascript">
            function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                    location.href = '<?=$item['url']?>';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
            }
            setInterval(function(){ countdown(); },500);
            </script>

            <? } ?>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>