  <div class="content-wrapper">
    <section class="content">
            <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <? if(empty($news)) {
            echo "Something went wrong";
          } else { ?>
            <div class="box-header">
              <h3 class="box-title">Latest News</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th width="10px"></th>
                  <th>Title</th>
                  <th>Source</th>
                </tr>
                <? foreach($news as $item){ ?>
                <tr>
                  <td width="10px"><img src="/theme/flags/<?=$item['lang']?>.png" width="20px"></td>
                  <td><a href="/<?=$item['lang']?>/redirect/<?=$item['hash']?>" target="_blank"><?=$item['title']?></a> <span class="small"><?=$item['published']?></span></td>
                  <td><?=$item['source']?></td>
                </tr>
                <? } ?>
              </table>
            </div>
            <!-- /.box-body -->
            <? } ?>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>