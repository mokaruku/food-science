<?php get_header(); ?>

<main>
  <section class="section section-foodList">
    <div class="section_inner">
      <div class="section_header">
        <h2 class="heading heading-primary"><span>フード紹介</span>FOOD</h2>
      </div>

      <?php
      $menu_terms = get_terms(['taxonomy' => 'menu',]);
      if (!empty($menu_terms)):
      ?>
        <?php foreach ($menu_terms as $menu): ?>

          <section class="section_body">
            <h3 class="heading heading-secondary">
              <a href="<?php echo get_term_link($menu); ?>"><?php echo $menu->name; ?></a>
              <span><?php echo strtoupper($menu->slug); ?></span>
            </h3>

            <ul class="foodList">
              <?php
              //メニューの投稿タイプ
              $args = [
                'post_type' => 'food',
                'posts_per_page' => -1, //全件取得

                //[],[],[],...条件を配列で指定（複数ある場合は配列を必要数用意する
                //下記は先生のやり方
                // $args = [
                //   'post_type' => 'food',
                //   'posts_per_page' => -1,
                //   'tax_query' => [array(
                  
                
                // [
                //   'taxonomy' => 'menu',
                //   'terms' => $menu->slug,
                //   'field' => 'slug',
                // ]
              ];
              //メニューの種類で絞り込む
              $taxquerysp = ['relation' => 'AND'];
              $taxquerysp[] = [
                'taxonomy' => 'menu',
                'terms' => $menu->slug,
                'field' => 'slug',
              ];

              $args['tax_query'] = $taxquerysp;
              $the_query = new WP_Query($args);
              if ($the_query->have_posts()):
              ?>

                <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                  <li class="foodList_item">
                    <?php get_template_part('template-parts/loop', 'food'); ?>
                  </li>
                <?php endwhile; ?>
              <?php endif; ?>

            </ul>
          </section>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>