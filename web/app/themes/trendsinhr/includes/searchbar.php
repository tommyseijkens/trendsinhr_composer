<?php
    if (isset($_REQUEST['_sf_s'])) { $searchterms = $_REQUEST['_sf_s']; } else { $searchterms = ''; }
?>
<div class="searchbar">
    <div class="searchbar-container search theme-bg">
        <div class="container">
        <div class="row">
            <div class="col-12">
                <form data-sf-form-id="13218" data-is-rtl="0" data-maintain-state=""
                      data-results-url="<?php echo get_site_url();?>/?sfid=13218"
                      data-ajax-form-url="<?php echo get_site_url();?>/?sfid=13218&amp;sf_action=get_data&amp;sf_data=form"
                      data-display-result-method="archive" data-use-history-api="1" data-template-loaded="0"
                      data-lang-code="" data-ajax="0" data-init-paged="1" data-auto-update="" data-auto-count="1"
                      data-auto-count-refresh-mode="1" action="<?php echo get_site_url();?>/?sfid=13218" method="post"
                      class="searchandfilter" id="search-filter-form-13218" autocomplete="off" data-instance-count="1">
                    <ul>
                        <li class="sf-field-search" data-sf-field-name="search" data-sf-field-type="search"
                            data-sf-field-input-type="">
                            <label>
                                <?php if ($searchterms == '') { ?>
                                <input
                                        placeholder="Zoek hier op bijv. sector, vakgebied, onderwerp of auteur"
                                        name="_sf_search[]" class="sf-input-text" type="text" value="" title="">
                                <?php } else { ?>
                                <input
                                        placeholder="Zoek hier op bijv. sector, vakgebied, onderwerp of auteur"
                                        name="_sf_search[]" class="sf-input-text" type="text" value="<?php echo $searchterms; ?>" title="">
                                <?php }?>


                            </label>
                        </li>
                        <li class="sf-field-submit" data-sf-field-name="submit" data-sf-field-type="submit"
                            data-sf-field-input-type="">
                            <input type="submit" name="_sf_submit" value="ZOEKEN"></li>
                    </ul>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>