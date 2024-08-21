<?php get_header(); ?>

<main>
  <div class="section">
    <div class="section_inner">

      <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
          <article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
            <header class="section_header">
              <h1 class="heading heading-primary"><?php the_title(); ?></h1>
            </header>
            <div class="post_content">
              <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
              <div class="content">
                <?php the_content('あいうえお'); ?>
              </div>
            </div>
            <footer class="post_footer">
              <div class="category">
                <div class="category_list">
                  <div class="category_item"><a href="" class="btn btn-sm is-active">おしらせ</a></div>
                </div>
              </div>

              <div class="prevNext">
                <div class="prevNext_item prevNext_item-prev">
                  <a href="">
                    <svg width="20" height="38" viewBox="0 0 20 38">
                      <path d="M0,0,19,19,0,38" transform="translate(20 38) rotate(180)" fill="none" stroke="#224163" stroke-width="1" />
                    </svg>
                    <span>新メニューができました</span>
                  </a>
                </div>
                <div class="prevNext_item prevNext_item-next">
                  <a href="">
                    <span>次の店休日のお知らせ</span>
                    <svg width="20" height="38" viewBox="0 0 20 38">
                      <path d="M1832,1515l19,19L1832,1553" transform="translate(-1832 -1514)" fill="none" stroke="#224163" stroke-width="1" />
                    </svg>
                  </a>
                </div>
              </div>
            </footer>
          </article>
        <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </div>
</main>

<?php get_footer(); ?>