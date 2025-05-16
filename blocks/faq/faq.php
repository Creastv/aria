 <?php
    $tabs = get_field('tabs');
    $i = 1;
    $ii = 1;
    $iii = 1;

    ?>
 <!-- =================== Questions Area =================== -->
 <?php if (!empty($tabs)) : ?>
     <section class="faq-area">
         <div class="card">
             <?php if (count($tabs) > 1) : ?>
                 <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                         <?php foreach ($tabs as $tab) : ?>
                             <button class=" <?php echo $i == 1 ? 'active' : false; ?>" id="nav-home-tab" data-bs-toggle="tab"
                                 data-bs-target="#tab-<?php echo $i; ?>" type="button" role="tab"
                                 aria-controls="tab-<?php echo $i; ?>"
                                 aria-selected="true"><?php echo $tab['tytul_zakladki']; ?></button>
                         <?php $i++;
                            endforeach; ?>
                     </div>
                 </nav>
             <?php endif; ?>
             <div class="tab-content" id="nav-tabContent">
                 <?php foreach ($tabs as $tab) :
                        $czysty_tytul = my_custom_sanitize_title($tab['tytul_zakladki']);
                    ?>

                     <div class="tab-pane fade <?php echo $iii == 1 ? 'active show' : false; ?>" id="tab-<?php echo $ii; ?>"
                         role="tabpanel" aria-labelledby="nav-home-tab">
                         <div class="accordion" id="accordion-<?php echo $czysty_tytul; ?>">
                             <?php foreach ($tab['faq'] as $faq) : ?>
                                 <div class="accordion-item">
                                     <h2 class="accordion-header" id="heading-<?php echo $i; ?>">
                                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                             data-bs-target="#collapse-<?php echo $i; ?>"
                                             aria-expanded="<?php echo $iii == 1 ? 'true' : 'false'; ?>"
                                             aria-controls="collapse-<?php echo $i; ?>">
                                             <span><?php echo $faq['pytanie']; ?></span>
                                         </button>
                                     </h2>
                                     <div id="collapse-<?php echo $i; ?>"
                                         class="accordion-collapse collapse <?php echo $iii == 1 ? 'show' : ''; ?>"
                                         aria-labelledby="heading-<?php echo $i; ?>"
                                         data-bs-parent="#accordion-<?php echo $czysty_tytul; ?>">
                                         <div class="accordion-body">
                                             <?php echo $faq['odpowiedz']; ?>
                                         </div>
                                     </div>
                                 </div>
                             <?php $i++;
                                    $iii++;
                                endforeach; ?>
                         </div>

                     </div>
                 <?php $ii++;
                    endforeach; ?>
             </div>
         </div>

     </section><!-- /.faq-area -->

 <?php endif; ?>