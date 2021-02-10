  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <div style="margin-left: 10px; margin-bottom: 10px;">
        <a href="/en/"><img src="http://www.gordum.net/theme/flags/en.png" style="width: 30px;"></a> <a href="/tr/"><img src="http://www.gordum.net/theme/flags/tr.png" style="width: 30px;"></a>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">CATEGORIES</li>
        <? $lang = isset($_GET['lang']) ? $_GET['lang'] : 'tr'; 
        $cats = $feeder->getCats($lang);
          foreach($cats as $cat) { ?>
        <li>
          <a href="/<?=$cat['lang']?>/<?=$cat['slug']?>">
            <i class="fa fa-th"></i> <span><?=$cat['title']?></span>
          </a>
        </li>
        <? } ?>

        <li class="header">POPULAR TODAY</li>
        <? $popNews = $feeder->popularNews('5', $lang);
        foreach($popNews as $pnews){ ?>
        <li style="white-space: initial;">
          <a href="/<?=$pnews['lang']?>/redirect/<?=$pnews['hash']?>" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <?=$pnews['title']?></a>
        </li>
        <? } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>